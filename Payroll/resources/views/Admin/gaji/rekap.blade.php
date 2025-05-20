@extends('layouts.app')

@section('title', 'Rekap Gaji Karyawan')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Rekap Gaji Karyawan</h1>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form method="GET" action="{{ route('admin.gaji.rekap') }}" class="row g-3 align-items-center">
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
             <div class="col-auto ms-auto">
                <a href="{{ route('admin.gaji.form_hitung') }}" class="btn btn-success">Hitung Gaji Baru</a>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Bulan/Tahun</th>
                        <th>Gaji Pokok</th>
                        <th>Total Hadir</th>
                        <th>Potongan</th>
                        <th>Gaji Bersih</th>
                        <th>Tgl Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gajis as $gaji)
                    <tr>
                        <td>{{ $gaji->karyawan->user->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::create()->month($gaji->bulan)->translatedFormat('F') }} {{ $gaji->tahun }}</td>
                        <td class="text-end">Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $gaji->total_hadir }}</td>
                        <td class="text-end text-danger">Rp {{ number_format($gaji->potongan, 0, ',', '.') }}</td>
                        <td class="text-end fw-bold">Rp {{ number_format($gaji->gaji_bersih, 0, ',', '.') }}</td>
                        <td>{{ $gaji->tanggal_pembayaran ? $gaji->tanggal_pembayaran->format('d M Y') : 'Belum Dibayar' }}</td>
                        <td>
                            <a href="{{ route('admin.gaji.slip', $gaji->id) }}" class="btn btn-sm btn-info" title="Lihat Slip"><i class="bi bi-receipt"></i> Slip</a>
                            {{-- Tambah tombol Edit/Hapus jika diperlukan --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data gaji untuk periode terpilih. <a href="{{ route('admin.gaji.form_hitung', ['bulan' => $bulan, 'tahun' => $tahun]) }}">Hitung sekarang?</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($gajis->hasPages())
        <div class="mt-3">
            {{ $gajis->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush