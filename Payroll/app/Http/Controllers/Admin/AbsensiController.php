<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function rekap(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Ambil semua karyawan beserta absensinya di bulan dan tahun tertentu
        $karyawans = Karyawan::with(['user', 'absensi' => function ($query) use ($bulan, $tahun) {
            $query->whereMonth('tanggal', $bulan)
                  ->whereYear('tanggal', $tahun)
                  ->orderBy('tanggal', 'asc');
        }])->get();

        // Anda mungkin ingin memformat data ini lebih lanjut atau mengagregat di sini
        // atau lakukan di view.

        // Untuk dropdown filter bulan dan tahun
        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->translatedFormat('F');
        }
        $listTahun = range(Carbon::now()->year, Carbon::now()->year - 5);


        return view('admin.absensi.rekap', compact('karyawans', 'bulan', 'tahun', 'listBulan', 'listTahun'));
        // Buat view: resources/views/admin/absensi/rekap.blade.php
    }
}
