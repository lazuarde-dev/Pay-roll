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

    // ... (method showLoginForm, login, logout yang sudah ada) ...

    public function showRegistrationForm()
    {
        // Hanya izinkan registrasi jika tidak ada user sama sekali (untuk admin pertama)
        // atau jika registrasi terbuka untuk umum (sesuaikan logika ini)
        // if (User::count() > 0 && !config('auth.allow_registration', false)) {
        //     return redirect('/login')->with('error', 'Registrasi tidak diizinkan.');
        // }
        return view('auth.register'); // Buat view: resources/views/auth/register.blade.php
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,karyawan'], // Pastikan role valid
            'terms' => ['accepted'], // Harus dicentang
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Jika role adalah karyawan, Anda bisa langsung membuat entri Karyawan dasar
            // atau mengarahkannya ke halaman untuk melengkapi profil karyawan.
            // Contoh: membuat entri karyawan dasar (opsional)
            if ($request->role === 'karyawan') {
                // Anda perlu field minimal untuk Karyawan, sesuaikan
                // Misalnya, posisi dan tanggal_masuk bisa diisi default atau nanti oleh admin
                Karyawan::create([
                    'user_id' => $user->id,
                    'posisi' => 'Belum Ditentukan', // Default atau null jika nullable
                    'tanggal_masuk' => now(), // Default atau null jika nullable
                    'gaji_pokok' => 0, // Default atau null jika nullable
                    // tambahkan field lain yang required atau memiliki default
                ]);
            }

            DB::commit();

            event(new Registered($user)); // Kirim event jika perlu (misal untuk verifikasi email)

            Auth::login($user); // Langsung login setelah registrasi

            // Redirect berdasarkan role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
            } elseif ($user->isKaryawan()) {
                // Mungkin arahkan ke halaman lengkapi profil jika Karyawan baru
                return redirect()->route('karyawan.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');
            }

            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error: Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Registrasi gagal: ' . $e->getMessage());
        }
    }
}
