<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController as AdminKaryawanController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\GajiController as AdminGajiController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\AbsensiController as KaryawanAbsensiController;

// Rute Autentikasi Manual
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('register.post')->middleware('guest');


// Route::get('/setup-admin-first-time', [AuthController::class, 'setupAdmin']); // Hati-hati

// Rute Landing Page (jika ada) atau redirect ke login jika belum auth
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isKaryawan()) {
            return redirect()->route('karyawan.dashboard');
        }
    }
    return redirect()->route('login');
});

// Grup Rute untuk Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // CRUD Karyawan
    Route::resource('karyawan', AdminKaryawanController::class);

    // Rekap Absensi
    Route::get('/absensi/rekap', [AdminAbsensiController::class, 'rekap'])->name('absensi.rekap');

    // Gaji
    Route::get('/gaji/form-hitung', [AdminGajiController::class, 'showFormHitung'])->name('gaji.form_hitung');
    Route::post('/gaji/proses-hitung', [AdminGajiController::class, 'prosesHitungGaji'])->name('gaji.proses_hitung');
    Route::get('/gaji/rekap', [AdminGajiController::class, 'rekapGaji'])->name('gaji.rekap');
    Route::get('/gaji/{gaji}/slip', [AdminGajiController::class, 'showSlipGaji'])->name('gaji.slip'); // {gaji} akan di-resolve ke model Gaji
});

// Grup Rute untuk Karyawan
Route::middleware(['auth', 'karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
    Route::get('/dashboard', [KaryawanDashboardController::class, 'index'])->name('dashboard');

    // Presensi
    Route::post('/absensi/masuk', [KaryawanAbsensiController::class, 'presensiMasuk'])->name('absensi.masuk');
    Route::post('/absensi/pulang', [KaryawanAbsensiController::class, 'presensiPulang'])->name('absensi.pulang');

    // Riwayat Absensi Pribadi
    Route::get('/absensi/riwayat', [KaryawanAbsensiController::class, 'riwayat'])->name('absensi.riwayat');
});

// routes/web.php
// ... (route login dan logout yang sudah ada)

