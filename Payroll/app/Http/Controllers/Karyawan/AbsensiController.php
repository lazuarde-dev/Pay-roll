<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function presensiMasuk(Request $request)
    {
        $karyawan = Auth::user()->karyawan;
        $today = Carbon::today();

        // Cek apakah sudah absen masuk atau statusnya selain 'hadir' (misal sudah diinput izin oleh admin)
        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        if ($absensiHariIni && !is_null($absensiHariIni->jam_masuk)) {
            return redirect()->route('karyawan.dashboard')->with('warning', 'Anda sudah melakukan presensi masuk hari ini.');
        }

        // Jika absensi ada tapi statusnya bukan hadir (misal izin/sakit dari admin), jangan timpa
        if ($absensiHariIni && $absensiHariIni->status !== 'hadir' && !is_null($absensiHariIni->status)) {
             return redirect()->route('karyawan.dashboard')->with('info', 'Status absensi Anda hari ini adalah: ' . ucfirst($absensiHariIni->status) . '. Tidak dapat melakukan presensi masuk.');
        }


        // Batas waktu presensi masuk, misalnya jam 09:00
        // $batasMasuk = Carbon::createFromTime(9, 0, 0);
        // if (Carbon::now()->gt($batasMasuk)) {
        //     return redirect()->route('karyawan.dashboard')->with('error', 'Waktu presensi masuk sudah berakhir.');
        // }

        Absensi::updateOrCreate(
            [
                'karyawan_id' => $karyawan->id,
                'tanggal' => $today,
            ],
            [
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'status' => 'hadir', // Otomatis 'hadir' saat presensi masuk
                'keterangan' => $request->input('keterangan_masuk'), // Opsional dari form
            ]
        );

        return redirect()->route('karyawan.dashboard')->with('success', 'Presensi masuk berhasil dicatat pukul ' . Carbon::now()->format('H:i:s'));
    }

    public function presensiPulang(Request $request)
    {
        $karyawan = Auth::user()->karyawan;
        $today = Carbon::today();

        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        if (!$absensiHariIni || is_null($absensiHariIni->jam_masuk)) {
            return redirect()->route('karyawan.dashboard')->with('error', 'Anda belum melakukan presensi masuk hari ini.');
        }

        if (!is_null($absensiHariIni->jam_pulang)) {
            return redirect()->route('karyawan.dashboard')->with('warning', 'Anda sudah melakukan presensi pulang hari ini.');
        }

        // Batas waktu presensi pulang, misalnya jam 17:00
        // $batasPulang = Carbon::createFromTime(17, 0, 0);
        // if (Carbon::now()->lt($batasPulang)) { // Jika belum waktunya pulang
        //     return redirect()->route('karyawan.dashboard')->with('error', 'Belum waktunya presensi pulang.');
        // }

        $absensiHariIni->update([
            'jam_pulang' => Carbon::now()->format('H:i:s'),
            'keterangan' => $absensiHariIni->keterangan . ($request->filled('keterangan_pulang') ? ' | Pulang: ' . $request->input('keterangan_pulang') : ''), // Tambahkan keterangan jika ada
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Presensi pulang berhasil dicatat pukul ' . Carbon::now()->format('H:i:s'));
    }

    public function riwayat(Request $request)
    {
        $karyawan = Auth::user()->karyawan;

        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        $riwayatAbsensi = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereMonth('tanggal', $bulan)
                                ->whereYear('tanggal', $tahun)
                                ->orderBy('tanggal', 'desc')
                                ->paginate(15); // Paginasi

        // Untuk dropdown filter bulan dan tahun
        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->translatedFormat('F');
        }
        $listTahun = range(Carbon::now()->year, $karyawan->created_at->year); // Dari tahun ini sampai tahun karyawan dibuat


        return view('karyawan.absensi.riwayat', compact('riwayatAbsensi', 'bulan', 'tahun', 'listBulan', 'listTahun'));
        // Buat view: resources/views/karyawan/absensi/riwayat.blade.php
    }
}
