@extends('layouts.app')

@section('title', 'Riwayat Absensi Saya')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Riwayat Absensi Saya</h1>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form method="GET" action="{{ route('karyawan.absensi.riwayat') }}" class="row g-3 align-items-center">
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
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
                    @forelse ($riwayatAbsensi as $absen)
                    <tr>
                        <td>{{ $absen->tanggal->format('d M Y (D)') }}</td>
                        <td>{{ $absen->jam_masuk ? \Carbon\Carbon::parse($absen->jam_masuk)->format('H:i:s') : '-' }}</td>
                        <td>{{ $absen->jam_pulang ? \Carbon\Carbon::parse($absen->jam_pulang)->format('H:i:s') : '-' }}</td>
                        <td><span class="badge bg-{{ $absen->status == 'hadir' ? 'success' : ($absen->status == 'izin' || $absen->status == 'sakit' ? 'warning' : 'danger') }}">{{ ucfirst($absen->status) }}</span></td>
                        <td>{{ $absen->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data absensi untuk periode terpilih.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if($riwayatAbsensi->hasPages())
        <div class="mt-3">
            {{ $riwayatAbsensi->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection