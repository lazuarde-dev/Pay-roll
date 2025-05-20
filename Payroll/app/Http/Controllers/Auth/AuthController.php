<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Karyawan; // Jika role karyawan langsung membuat entri karyawan
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered; // Untuk event setelah registrasi

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Buat view: resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard'); // Sesuaikan rute dashboard admin
            } elseif ($user->isKaryawan()) {
                return redirect()->intended('/karyawan/dashboard'); // Sesuaikan rute dashboard karyawan
            }
            // Default fallback jika role tidak terdefinisi (seharusnya tidak terjadi)
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Opsional: Tambahkan method untuk registrasi admin pertama kali jika diperlukan
    // atau gunakan Seeder.
    // Contoh membuat Admin pertama jika tabel user kosong (HATI-HATI PENGGUNAANNYA)
    // public function setupAdmin()
    // {
    //     if (User::count() == 0) {
    //         User::create([
    //             'name' => 'Admin Utama',
    //             'email' => 'admin@example.com',
    //             'password' => Hash::make('password'), // Ganti dengan password yang kuat
    //             'role' => 'admin',
    //         ]);
    //         return "Admin utama berhasil dibuat.";
    //     }
    //     return "Admin sudah ada.";
    // }
}
