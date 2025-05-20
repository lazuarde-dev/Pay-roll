@extends('layouts.app')

@section('title', 'Detail Karyawan')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Detail Karyawan: {{ $karyawan->user->name ?? 'N/A' }}</h1>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nama:</strong> {{ $karyawan->user->name ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $karyawan->user->email ?? 'N/A' }}</p>
                <p><strong>Role:</strong> <span class="badge bg-info text-capitalize">{{ $karyawan->user->role ?? 'N/A' }}</span></p>
            </div>
            <div class="col-md-6">
                <p><strong>User ID:</strong> {{ $karyawan->user_id }}</p>
                <p><strong>Akun Dibuat:</strong> {{ $karyawan->user ? $karyawan->user->created_at->format('d M Y, H:i') : 'N/A' }}</p>
                <p><strong>Terakhir Diupdate:</strong> {{ $karyawan->user ? $karyawan->user->updated_at->format('d M Y, H:i') : 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Karyawan ID:</strong> {{ $karyawan->id }}</p>
                <p><strong>NIK:</strong> {{ $karyawan->nik ?? 'N/A' }}</p>
                <p><strong>No. Telepon:</strong> {{ $karyawan->no_telepon ?? 'N/A' }}</p>
                <p><strong>Alamat:</strong> {{ $karyawan->alamat ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Posisi:</strong> {{ $karyawan->posisi }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $karyawan->tanggal_masuk->format('d M Y') }}</p>
                <p><strong>Gaji Pokok:</strong> Rp {{ number_format($karyawan->gaji_pokok, 2, ',', '.') }}</p>
                <p><strong>Data Dibuat:</strong> {{ $karyawan->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Terakhir Diupdate:</strong> {{ $karyawan->updated_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <hr>
        <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-warning">Edit Karyawan</a>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>
</div>

{{-- Opsional: Tampilkan Riwayat Absensi atau Gaji Terkait --}}
{{--
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Absensi Terakhir</h6>
    </div>
    <div class="card-body">
        @if($karyawan->absensi()->exists())
            <ul>
            @foreach($karyawan->absensi()->latest()->take(5)->get() as $absen)
                <li>{{ $absen->tanggal->format('d M Y') }}: {{ $absen->status }} (Masuk: {{ $absen->jam_masuk ?? '-' }}, Pulang: {{ $absen->jam_pulang ?? '-' }})</li>
            @endforeach
            </ul>
        @else
            <p>Belum ada data absensi.</p>
        @endif
    </div>
</div>
--}}
@endsection