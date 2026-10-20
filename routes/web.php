<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController; // Tambahan untuk memanggil controller profil
use App\Models\TempatBelajar;
use Illuminate\Http\Request;

// Halaman utama diarahkan ke form login
Route::get('/', function () {
    return redirect()->route('login');
});

// Menampilkan form
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

// Memproses data form
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    // Halaman Dashboard dengan Filter & Pencarian
    Route::get('/dashboard', function (Request $request) {
        $category = $request->query('category', 'Semua');
        $search = $request->query('search');

        $query = TempatBelajar::query();

        // Filter berdasarkan Kategori jika bukan "Semua"
        if ($category && $category !== 'Semua') {
            if ($category === 'Buka sekarang') {
                // Menyaring tempat yang memiliki tag '24 Jam' di database
                $query->whereJsonContains('tags', '24 Jam');
            } else {
                $query->where('category', $category);
            }
        }

        // Filter berdasarkan kata kunci Pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $places = $query->get();

        return view('dashboard', compact('places', 'category', 'search'));
    })->name('dashboard');

    // Halaman Detail Tempat Belajar (TAMBAHAN RUTE DETAIL)
    Route::get('/tempat/{id}', function ($id) {
        $place = TempatBelajar::findOrFail($id);
        return view('detail', compact('place'));
    })->name('tempat.detail');

    // Halaman Profil & Pengaturan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
});