@extends('layouts.app')

@section('title', 'Slip Gaji Karyawan')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Slip Gaji</h1>
        <button onclick="window.print()" class="btn btn-primary d-print-none"><i class="bi bi-printer"></i> Cetak Slip</button>
    </div>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-body p-4" id="slip-gaji-content">
        <div class="text-center mb-4">
            <h2 class="h4">{{ config('app.name', 'Perusahaan Anda') }}</h2>
            <p class="mb-0">Slip Gaji Karyawan</p>
            <p>Periode: {{ \Carbon\Carbon::create()->month($gaji->bulan)->translatedFormat('F') }} {{ $gaji->tahun }}</p>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="mb-1"><strong>Nama Karyawan:</strong> {{ $gaji->karyawan->user->name ?? 'N/A' }}</p>
                <p class="mb-1"><strong>NIK:</strong> {{ $gaji->karyawan->nik ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Posisi:</strong> {{ $gaji->karyawan->posisi ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-1"><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                @if($gaji->tanggal_pembayaran)
                <p class="mb-1"><strong>Tanggal Pembayaran:</strong> {{ $gaji->tanggal_pembayaran->format('d M Y') }}</p>
                @endif
            </div>
        </div>

        <h5 class="mt-4">Pendapatan:</h5>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td>Gaji Pokok</td>
                    <td class="text-end">Rp {{ number_format($gaji->gaji_pokok, 2, ',', '.') }}</td>
                </tr>
                {{-- Tambahkan komponen pendapatan lain jika ada --}}
            </tbody>
        </table>

        <h5 class="mt-4">Potongan:</h5>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td>Potongan Ketidakhadiran ({{ $gaji->total_tanpa_keterangan }} hari)</td>
                    <td class="text-end">Rp {{ number_format($gaji->potongan, 2, ',', '.') }}</td>
                </tr>
                 {{-- Tambahkan komponen potongan lain jika ada --}}
            </tbody>
        </table>
        <hr style="border-top: 2px dashed #333;">
        <div class="row mt-3">
            <div class="col-6">
                <h5 class="fw-bold">GAJI BERSIH (Take Home Pay)</h5>
            </div>
            <div class="col-6 text-end">
                <h5 class="fw-bold">Rp {{ number_format($gaji->gaji_bersih, 2, ',', '.') }}</h5>
            </div>
        </div>
        <hr>
        <p class="small text-muted"><em>{{ $gaji->keterangan_gaji }}</em></p>

        <div class="row mt-5 pt-5">
            <div class="col-6 text-center">
                <p>Disetujui Oleh,</p>
                <br><br><br>
                <p>(_________________________)</p>
                <p>Manajer HRD</p>
            </div>
            <div class="col-6 text-center">
                <p>Diterima Oleh,</p>
                <br><br><br>
                <p>( {{ $gaji->karyawan->user->name ?? 'N/A' }} )</p>
                <p>Karyawan</p>
            </div>
        </div>
    </div>
</div>
<div class="text-center d-print-none">
     <a href="{{ route('admin.gaji.rekap', ['bulan' => $gaji->bulan, 'tahun' => $gaji->tahun]) }}" class="btn btn-secondary">Kembali ke Rekap Gaji</a>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #slip-gaji-content, #slip-gaji-content * {
                visibility: visible;
            }
            #slip-gaji-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .d-print-none {
                display: none !important;
            }
        }
    </style>
@endpush