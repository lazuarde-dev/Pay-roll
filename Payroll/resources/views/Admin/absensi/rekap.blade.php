@extends('layouts.app')

@section('title', 'Rekap Absensi Karyawan')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Rekap Absensi Karyawan</h1>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form method="GET" action="{{ route('admin.absensi.rekap') }}" class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="bulan" class="col-form-label">Bulan:</label>
            </div>
            <div class="col-auto">
                <select name="bulan" id="bulan" class="form-select">
                    @foreach($listBulan as $key => $namaBulan)
                        <option value="{{ $key }}" {{ $key == $bulan ? 'selected' : '' }}>{{ $namaBulan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label for="tahun" class="col-form-label">Tahun:</label>
            </div>
            <div class="col-auto">
                <select name="tahun" id="tahun" class="form-select">
                    @foreach($listTahun as $thn)
                        <option value="{{ $thn }}" {{ $thn == $tahun ? 'selected' : '' }}>{{ $thn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        @if($karyawans->isEmpty())
            <p class="text-center">Tidak ada data absensi untuk periode {{ $listBulan[$bulan] }} {{ $tahun }}.</p>
        @else
            @foreach ($karyawans as $karyawan)
                @if($karyawan->absensi->isNotEmpty() || request()->has('bulan')) {{-- Tampilkan karyawan jika ada absensi atau jika filter aktif --}}
                <h5 class="mt-4 mb-3">Karyawan: {{ $karyawan->user->name ?? 'N/A' }} ({{ $karyawan->posisi }})</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($karyawan->absensi as $absen)
                            <tr>
                                <td>{{ $absen->tanggal->format('d M Y (D)') }}</td>
                                <td>{{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i:s') : '-' }}</td>
                                <td>{{ $absen->jam_pulang ? \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i:s') : '-' }}</td>
                                <td><span class="badge bg-{{ $absen->status == 'hadir' ? 'success' : ($absen->status == 'izin' || $absen->status == 'sakit' ? 'warning' : 'danger') }}">{{ ucfirst($absen->status) }}</span></td>
                                <td>{{ $absen->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data absensi untuk karyawan ini di periode terpilih.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
@endsection