<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Menampilkan halaman daftar tempat tersimpan (Tempat Tersimpan / Bookmark)
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $places = $user->bookmarkedPlaces;

        return view('bookmarks.index', compact('places'));
    }

    // Memasang atau menghapus bookmark secara otomatis (toggle)
    public function toggle($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $user->bookmarkedPlaces()->toggle($id);

        return back()->with('success', 'Daftar tempat tersimpan berhasil diperbarui!');
    }
}