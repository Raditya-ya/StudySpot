<?php

namespace App\Http\Controllers;

use App\Models\TempatBelajar;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        // Daftar seluruh kriteria yang tersedia untuk dipilih mahasiswa
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

        // Default 3 kriteria aktif saat halaman pertama kali dibuka
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

        $places = TempatBelajar::all()->map(function ($place) use ($selectedCriteria, $availableCriteria) {
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

            // Hitung persentase kecocokan (80% dari kriteria + 20% faktor pendukung kursi, Wi-Fi & kebisingan)
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

        return view('recommendations', compact(
            'places',
            'availableCriteria',
            'selectedCriteria'
        ));
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

        return $val <= 1000; // satuan meter
    }
}