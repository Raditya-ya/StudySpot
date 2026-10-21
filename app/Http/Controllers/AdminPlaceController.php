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
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'distance' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        // Default tags & facilities dasar
        $data = $request->all();
        $data['tags'] = ['Wi-Fi ⭐ 4.0', 'Tersedia'];
        $data['facilities'] = ['Banyak colokan', 'AC', 'Parkir'];

        TempatBelajar::create($data);

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

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'distance' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $place->update($request->all());

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