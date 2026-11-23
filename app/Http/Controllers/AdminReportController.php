<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\TempatBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengakses halaman laporan.');
        }

        // 1. Data Feedback, Rating & Identitas Pemberi Ulasan
        $allPlaces = TempatBelajar::orderBy('name')->get();
        $reviews = Review::with(['user', 'tempatBelajar'])->latest()->get();

        $rawAverage = $reviews->avg('rating') ?? 0;
        $averageRating = $reviews->count() > 0
            ? number_format($rawAverage, 1, ',', '.')
            : '0,0';

        $reviewedPlacesCount = $reviews->pluck('tempat_belajar_id')->unique()->count();

        // 2. Data Peringkat Rekomendasi Berdasarkan Kriteria
        $availableCriteria = [
            'hening' => 'Hening',
            'wifi_cepat' => 'Wi-Fi cepat',
            'stopkontak' => 'Stopkontak',
            'kursi_banyak' => 'Kursi banyak',
            'indoor' => 'Ruangan indoor',
            'outdoor' => 'Ruangan outdoor',
            'mushola' => 'Mushola',
            'parkir' => 'Parkir',
            'dekat_kampus' => 'Dekat kampus',
        ];

        if ($request->has('empty')) {
            $selectedCriteria = [];
        } elseif ($request->has('criteria')) {
            $selectedCriteria = array_values(array_intersect(
                (array) $request->input('criteria', []),
                array_keys($availableCriteria)
            ));
        } else {
            $selectedCriteria = ['hening', 'wifi_cepat', 'stopkontak'];
        }

        $rankedPlaces = $allPlaces->map(function ($place) use ($selectedCriteria, $availableCriteria) {
            $facilities = is_array($place->facilities)
                ? $place->facilities
                : (json_decode($place->facilities ?? '[]', true) ?: []);

            $matchedCount = 0;
            $matchedLabels = [];

            foreach ($selectedCriteria as $key) {
                $isMatch = match ($key) {
                    'hening' => strtolower($place->noise_level ?? '') === 'rendah',
                    'wifi_cepat' => in_array(strtolower($place->wifi_speed ?? ''), ['cepat', 'sangat cepat', '4,5', '4.5'])
                        || in_array('Wifi gratis', $facilities),
                    'stopkontak' => in_array('Stop kontak', $facilities),
                    'kursi_banyak' => ($place->available_seats ?? 0) >= 20,
                    'indoor' => in_array('Ruangan indoor', $facilities),
                    'outdoor' => in_array('Ruangan outdoor', $facilities),
                    'mushola' => in_array('Mushola', $facilities),
                    'parkir' => in_array('Parkir', $facilities),
                    'dekat_kampus' => $this->isNearCampus($place->distance),
                    default => false,
                };

                if ($isMatch) {
                    $matchedCount++;
                    $matchedLabels[] = $availableCriteria[$key];
                }
            }

            $totalSelected = count($selectedCriteria);

            $seatsBonus = min(8, (int) round((($place->available_seats ?? 0) / 50) * 8));
            $noiseBonus = match (strtolower($place->noise_level ?? '')) {
                'rendah' => 6,
                'sedang' => 3,
                default => 1,
            };
            $wifiBonus = in_array(strtolower($place->wifi_speed ?? ''), ['sangat cepat', '4,5', '4.5']) ? 5 : 3;
            $supportBonus = $seatsBonus + $noiseBonus + $wifiBonus;

            if ($totalSelected > 0) {
                $criteriaScore = ($matchedCount / $totalSelected) * 80;
                $percentage = (int) min(99, max(15, round($criteriaScore + $supportBonus)));
            } else {
                $percentage = (int) min(99, max(40, round(60 + ($supportBonus * 1.8))));
            }

            $place->matched_count = $matchedCount;
            $place->total_criteria = $totalSelected;
            $place->matched_labels = $matchedLabels;
            $place->match_percentage = $percentage;

            return $place;
        })->sortByDesc('match_percentage')->values();

        return view('admin.reports', compact(
            'allPlaces',
            'reviews',
            'averageRating',
            'reviewedPlacesCount',
            'rankedPlaces',
            'availableCriteria',
            'selectedCriteria'
        ));
    }

    public function storeReview(Request $request, $id)
    {
        $place = TempatBelajar::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:600',
        ], [
            'rating.required' => 'Silakan pilih rating bintang terlebih dahulu.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.required' => 'Catatan atau ulasan tidak boleh kosong.',
            'comment.min' => 'Catatan minimal terdiri dari 5 karakter.',
            'comment.max' => 'Catatan maksimal 600 karakter.',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'tempat_belajar_id' => $place->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $this->syncPlaceRating($place->id);

        return redirect()->route('places.show', $place->id)
            ->withFragment('catatan-mahasiswa')
            ->with('note_success', 'Catatan dan rating berhasil dikirim!');
    }

    public function destroyReview($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus rating.');
        }

        $review = Review::findOrFail($id);
        $placeId = $review->tempat_belajar_id;
        $review->delete();

        $this->syncPlaceRating($placeId);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Rating dan ulasan berhasil dihapus.');
    }

    private function syncPlaceRating($placeId): void
    {
        $place = TempatBelajar::find($placeId);
        if (!$place) {
            return;
        }

        $count = Review::where('tempat_belajar_id', $placeId)->count();
        $avg = $count > 0 ? round(Review::where('tempat_belajar_id', $placeId)->avg('rating'), 1) : null;

        $place->update([
            'rating' => $avg,
            'total_reviews' => $count,
        ]);
    }

    private function isNearCampus(?string $distance): bool
    {
        if (!$distance) {
            return false;
        }

        $lower = strtolower($distance);
        preg_match('/(\d+(?:[.,]\d+)?)/', $lower, $matches);

        if (empty($matches[1])) {
            return false;
        }

        $val = (float) str_replace(',', '.', $matches[1]);

        if (str_contains($lower, 'km')) {
            return $val <= 1.2;
        }

        if (str_contains($lower, 'menit')) {
            return $val <= 10;
        }

        return $val <= 1000;
    }
}