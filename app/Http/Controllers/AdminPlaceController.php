<?php

namespace App\Http\Controllers;

use App\Models\TempatBelajar;
use Illuminate\Http\Request;

class AdminPlaceController extends Controller
{
    // Menampilkan daftar tempat belajar untuk admin
    public function index()
    {
        $places = TempatBelajar::latest()->get();
        return view('admin.index', compact('places'));
    }

    // Menampilkan form tambah tempat baru
    public function create()
    {
        return view('admin.create');
    }

    // Menyimpan data tempat baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'distance' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image_url' => 'nullable|url',
            'available_seats' => 'nullable|integer|min:0',
            'noise_level' => 'nullable|string|max:50',
            'wifi_speed' => 'nullable|string|max:50',
            'opening_time' => 'nullable|string|max:20',
            'closing_time' => 'nullable|string|max:20',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
        ]);

        // Ambil fasilitas yang dicentang dari form (default array kosong jika tidak ada yang dipilih)
        $validated['facilities'] = $request->input('facilities', []);

        // Sinkronisasi otomatis untuk tags & status_text agar tampilan kartu dashboard tetap rapi
        $wifi = $validated['wifi_speed'] ?? '4.5';
        $seats = $validated['available_seats'] ?? 0;
        $validated['tags'] = ["Wi-Fi ⭐ {$wifi}", "{$seats} Kursi"];

        if (!empty($validated['opening_time']) && !empty($validated['closing_time'])) {
            $validated['status_text'] = "Buka {$validated['opening_time']} - {$validated['closing_time']}";
        }

        TempatBelajar::create($validated);

        return redirect()->route('admin.places.index')->with('success', 'Tempat belajar berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $place = TempatBelajar::findOrFail($id);
        return view('admin.edit', compact('place'));
    }

    // Memperbarui data tempat belajar
    public function update(Request $request, $id)
    {
        $place = TempatBelajar::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'distance' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image_url' => 'nullable|url',
            'available_seats' => 'nullable|integer|min:0',
            'noise_level' => 'nullable|string|max:50',
            'wifi_speed' => 'nullable|string|max:50',
            'opening_time' => 'nullable|string|max:20',
            'closing_time' => 'nullable|string|max:20',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
        ]);

        // Pastikan jika semua checkbox fasilitas di-uncheck saat edit, database ikut ter-update menjadi []
        $validated['facilities'] = $request->input('facilities', []);

        // Perbarui tags & status_text agar sinkron dengan input terbaru
        $wifi = $validated['wifi_speed'] ?? $place->wifi_speed ?? '4.5';
        $seats = $validated['available_seats'] ?? $place->available_seats ?? 0;
        $validated['tags'] = ["Wi-Fi ⭐ {$wifi}", "{$seats} Kursi"];

        if (!empty($validated['opening_time']) && !empty($validated['closing_time'])) {
            $validated['status_text'] = "Buka {$validated['opening_time']} - {$validated['closing_time']}";
        }

        $place->update($validated);

        return redirect()->route('admin.places.index')->with('success', 'Data tempat belajar berhasil diperbarui!');
    }

    // Menghapus tempat belajar
    public function destroy($id)
    {
        $place = TempatBelajar::findOrFail($id);
        $place->delete();

        return redirect()->route('admin.places.index')->with('success', 'Tempat belajar berhasil dihapus!');
    }
}