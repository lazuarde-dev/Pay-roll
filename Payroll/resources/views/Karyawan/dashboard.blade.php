@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Selamat Datang, {{ $karyawan->user->name ?? '' }}!</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Presensi Hari Ini ({{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }})</h6>
            </div>
            <div class="card-body text-center">
                <h3 id="clock" class="display-4 mb-4"></h3>

                @if ($absensiHariIni && $absensiHariIni->status && !in_array($absensiHariIni->status, ['hadir']))
                    <div class="alert alert-info">
                        Status absensi Anda hari ini: <strong>{{ ucfirst($absensiHariIni->status) }}</strong>.
                        @if($absensiHariIni->keterangan)
                        <br>Keterangan: {{ $absensiHariIni->keterangan }}
                        @endif
                    </div>
                @elseif ($sudahMasuk && $sudahPulang)
                    <div class="alert alert-success">
                        <h5 class="alert-heading">Presensi Selesai!</h5>
                        Anda sudah melakukan presensi masuk pukul <strong>{{ \Carbon\Carbon::parse($absensiHariIni->jam_masuk)->format('H:i:s') }}</strong>
                        dan presensi pulang pukul <strong>{{ \Carbon\Carbon::parse($absensiHariIni->jam_pulang)->format('H:i:s') }}</strong> hari ini.
                    </div>
                @elseif ($sudahMasuk)
                    <div class="alert alert-warning mb-3">
                        Anda sudah melakukan presensi masuk pukul <strong>{{ \Carbon\Carbon::parse($absensiHariIni->jam_masuk)->format('H:i:s') }}</strong>.
                        Jangan lupa presensi pulang.
                    </div>
                    <form action="{{ route('karyawan.absensi.pulang') }}" method="POST">
                        @csrf
                        {{-- Tambahkan input keterangan jika perlu --}}
                        {{-- <div class="mb-3">
                            <label for="keterangan_pulang" class="form-label">Keterangan Pulang (Opsional):</label>
                            <textarea name="keterangan_pulang" id="keterangan_pulang" class="form-control" rows="2"></textarea>
                        </div> --}}
                        <button type="submit" class="btn btn-danger btn-lg px-5">Presensi Pulang</button>
                    </form>
                @else
                     <div class="alert alert-info mb-3">
                        Anda belum melakukan presensi masuk hari ini.
                    </div>
                    <form action="{{ route('karyawan.absensi.masuk') }}" method="POST">
                        @csrf
                         {{-- Tambahkan input keterangan jika perlu --}}
                        {{-- <div class="mb-3">
                            <label for="keterangan_masuk" class="form-label">Keterangan Masuk (Opsional):</label>
                            <textarea name="keterangan_masuk" id="keterangan_masuk" class="form-control" rows="2"></textarea>
                        </div> --}}
                        <button type="submit" class="btn btn-success btn-lg px-5">Presensi Masuk</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-5">
         <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Karyawan</h6>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $karyawan->user->name ?? 'N/A' }}</p>
                <p><strong>NIK:</strong> {{ $karyawan->nik ?? 'N/A' }}</p>
                <p><strong>Posisi:</strong> {{ $karyawan->posisi }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $karyawan->tanggal_masuk->format('d M Y') }}</p>
                <hr>
                <a href="{{ route('karyawan.absensi.riwayat') }}" class="btn btn-outline-primary w-100">Lihat Riwayat Absensi Saya</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);
    updateClock(); // Initial call
</script>
@endpush