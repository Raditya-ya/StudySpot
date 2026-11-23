<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\TempatBelajar;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPlaceController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\AdminReportController;

// Halaman utama diarahkan ke form login
Route::get('/', function () {
    return redirect()->route('login');
});

// Menampilkan form autentikasi
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

// Memproses data form autentikasi
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    
    // Halaman Dashboard dengan Filter & Pencarian
    Route::get('/dashboard', function (Request $request) {
        $category = $request->query('category', 'Semua');
        $search = $request->query('search');

        $query = TempatBelajar::query();

        if ($category && $category !== 'Semua') {
            if ($category === 'Buka sekarang') {
                $query->whereJsonContains('tags', '24 Jam');
            } else {
                $query->where('category', $category);
            }
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $places = $query->latest()->get();

        return view('dashboard', compact('places', 'category', 'search'));
    })->name('dashboard');

    // Halaman Rekomendasi Berdasarkan Kriteria
    Route::get('/rekomendasi', [RecommendationController::class, 'index'])->name('recommendations.index');

    // Rute Bookmark Tempat
    Route::post('/places/{id}/bookmark', [BookmarkController::class, 'toggle'])->name('places.bookmark');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    // Halaman Detail Tempat Belajar
    Route::get('/tempat/{id}', function ($id) {
        $place = TempatBelajar::findOrFail($id);
        return view('detail', compact('place'));
    })->name('places.show');

    // Kirim Catatan & Rating Mahasiswa (Bisa diakses User/Mahasiswa & Admin)
    Route::post('/places/{id}/reviews', [AdminReportController::class, 'storeReview'])->name('places.reviews.store');

    // Halaman Profil & Pengaturan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Kelompok Rute Panel Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/places', [AdminPlaceController::class, 'index'])->name('places.index');
        Route::get('/places/create', [AdminPlaceController::class, 'create'])->name('places.create');
        Route::post('/places', [AdminPlaceController::class, 'store'])->name('places.store');
        Route::get('/places/{id}/edit', [AdminPlaceController::class, 'edit'])->name('places.edit');
        Route::put('/places/{id}', [AdminPlaceController::class, 'update'])->name('places.update');
        Route::delete('/places/{id}', [AdminPlaceController::class, 'destroy'])->name('places.destroy');

        // Laporan Admin (Rata-rata Rating, Daftar Pemberi Rating & Hapus Rating)
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::delete('/reports/reviews/{id}', [AdminReportController::class, 'destroyReview'])->name('reports.reviews.destroy');
    });

});