@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang, {{ Auth::user()->name }}!</h6>
                </div>
                <div class="card-body">
                    <p>Anda telah berhasil login sebagai Admin. Dari sini Anda dapat mengelola data karyawan, melihat rekap absensi, dan melakukan proses penggajian.</p>
                    <p>Gunakan navigasi di atas untuk mengakses fitur-fitur yang tersedia.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Tambahkan widget atau ringkasan data di sini jika perlu --}}
    {{-- Contoh:
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ \App\Models\Karyawan::count() }} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i> <!-- Butuh FontAwesome -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
@endsection