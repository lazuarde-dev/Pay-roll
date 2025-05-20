<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user()->karyawan; // Middleware sudah memastikan ini ada
        $today = Carbon::today();

        // Cek status absensi hari ini
        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        $sudahMasuk = false;
        $sudahPulang = false;
        $statusAbsen = null;

        if ($absensiHariIni) {
            $sudahMasuk = !is_null($absensiHariIni->jam_masuk);
            $sudahPulang = !is_null($absensiHariIni->jam_pulang);
            $statusAbsen = $absensiHariIni->status;
        }

        return view('karyawan.dashboard', compact('karyawan', 'absensiHariIni', 'sudahMasuk', 'sudahPulang', 'statusAbsen'));
        // Buat view: resources/views/karyawan/dashboard.blade.php
    }
}
