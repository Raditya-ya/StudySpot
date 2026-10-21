<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi untuk memproses Login
    public function login(Request $request)
    {
        // 1. Validasi inputan form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek ke database, apakah email & password cocok?
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika berhasil, arahkan ke halaman dashboard
            return redirect()->intended('/dashboard');
        }

        // 3. Jika gagal, kembalikan ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // Fungsi untuk memproses Pendaftaran (Register)
    public function register(Request $request)
    {
        // 1. Validasi inputan form pendaftaran (DITAMBAH VALIDASI ROLE)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:user,admin'], // <--- Mencegah input selain 'user' atau 'admin'
        ]);

        // 2. Simpan user baru ke database (DITAMBAH SIMPAN ROLE)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // <--- Mengambil pilihan dropdown dari form
        ]);

        // 3. Langsung login-kan user tersebut setelah daftar
        Auth::login($user);

        // 4. Arahkan ke dashboard
        return redirect('/dashboard');
    }

    // Fungsi untuk memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Menghapus dan memperbarui sesi untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Kembalikan ke halaman login
        return redirect('/');
    }
}