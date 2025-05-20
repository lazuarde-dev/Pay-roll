<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GajiController extends Controller
{
    public function showFormHitung()
    {
        // Untuk dropdown filter bulan dan tahun
        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->translatedFormat('F');
        }
        $listTahun = range(Carbon::now()->year, Carbon::now()->year - 5);

        return view('admin.gaji.form_hitung', compact('listBulan', 'listTahun'));
        // Buat view: resources/views/admin/gaji/form_hitung.blade.php
    }

    public function prosesHitungGaji(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:'.(Carbon::now()->year - 10).'|max:'.Carbon::now()->year,
            // Tambahkan validasi untuk potongan jika ada inputan dari form
            'potongan_alpha' => 'required|numeric|min:0', // Contoh: potongan per hari alpha
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $potonganPerHariAlpha = $request->potongan_alpha; // Ambil dari request

        // Ambil semua karyawan aktif
        $karyawans = Karyawan::whereHas('user')->get(); // Pastikan user masih ada

        DB::beginTransaction();
        try {
            foreach ($karyawans as $karyawan) {
                // 1. Ambil data absensi karyawan untuk bulan dan tahun yang dipilih
                $absensiStats = Absensi::where('karyawan_id', $karyawan->id)
                    ->whereMonth('tanggal', $bulan)
                    ->whereYear('tanggal', $tahun)
                    ->selectRaw("
                        SUM(CASE WHEN status = 'hadir' THEN 1 ELSE 0 END) as total_hadir,
                        SUM(CASE WHEN status = 'izin' THEN 1 ELSE 0 END) as total_izin,
                        SUM(CASE WHEN status = 'sakit' THEN 1 ELSE 0 END) as total_sakit,
                        SUM(CASE WHEN status = 'tanpa keterangan' THEN 1 ELSE 0 END) as total_tanpa_keterangan
                    ")
                    ->first();

                $totalHadir = $absensiStats->total_hadir ?? 0;
                $totalIzin = $absensiStats->total_izin ?? 0;
                $totalSakit = $absensiStats->total_sakit ?? 0;
                $totalTanpaKeterangan = $absensiStats->total_tanpa_keterangan ?? 0;

                // 2. Hitung potongan
                // Contoh sederhana: potongan hanya untuk 'tanpa keterangan'
                // Anda bisa membuat ini lebih kompleks, misal potongan juga untuk izin tertentu, dll.
                // Atau bisa juga potongan berdasarkan persentase gaji pokok jika tidak masuk N hari.
                $potongan = $totalTanpaKeterangan * $potonganPerHariAlpha;

                // 3. Ambil gaji pokok
                $gajiPokok = $karyawan->gaji_pokok;

                // 4. Hitung gaji bersih
                $gajiBersih = $gajiPokok - $potongan;
                if ($gajiBersih < 0) {
                    $gajiBersih = 0; // Gaji tidak boleh minus
                }

                // 5. Simpan atau update data gaji
                Gaji::updateOrCreate(
                    [
                        'karyawan_id' => $karyawan->id,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                    ],
                    [
                        'total_hadir' => $totalHadir,
                        'total_izin' => $totalIzin,
                        'total_sakit' => $totalSakit,
                        'total_tanpa_keterangan' => $totalTanpaKeterangan,
                        'gaji_pokok' => $gajiPokok,
                        'potongan' => $potongan,
                        'gaji_bersih' => $gajiBersih,
                        'keterangan_gaji' => 'Gaji Bulan ' . Carbon::create()->month($bulan)->translatedFormat('F') . ' ' . $tahun,
                        // 'tanggal_pembayaran' bisa diisi nanti saat proses pembayaran aktual
                    ]
                );
            }
            DB::commit();
            return redirect()->route('admin.gaji.rekap', ['bulan' => $bulan, 'tahun' => $tahun])
                             ->with('success', 'Perhitungan gaji berhasil diselesaikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error $e->getMessage()
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menghitung gaji: ' . $e->getMessage());
        }
    }

    public function rekapGaji(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        $gajis = Gaji::with('karyawan.user')
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->latest()
                    ->paginate(10);

        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->translatedFormat('F');
        }
        $listTahun = range(Carbon::now()->year, Carbon::now()->year - 5);

        return view('admin.gaji.rekap', compact('gajis', 'bulan', 'tahun', 'listBulan', 'listTahun'));
        // Buat view: resources/views/admin/gaji/rekap.blade.php
    }

     public function showSlipGaji(Gaji $gaji) // Route model binding
    {
        $gaji->load('karyawan.user'); // Eager load relasi
        return view('admin.gaji.slip', compact('gaji'));
        // Buat view: resources/views/admin/gaji/slip.blade.php
    }
}
