@extends('layouts.app')

@section('title', 'Hitung Gaji Karyawan')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Form Perhitungan Gaji Bulanan</h1>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.gaji.proses_hitung') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="bulan" class="form-label">Bulan Perhitungan <span class="text-danger">*</span></label>
                    <select name="bulan" id="bulan" class="form-select @error('bulan') is-invalid @enderror" required>
                        @foreach($listBulan as $key => $namaBulan)
                            <option value="{{ $key }}" {{ old('bulan', date('m')) == $key ? 'selected' : '' }}>{{ $namaBulan }}</option>
                        @endforeach
                    </select>
                    @error('bulan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tahun" class="form-label">Tahun Perhitungan <span class="text-danger">*</span></label>
                    <select name="tahun" id="tahun" class="form-select @error('tahun') is-invalid @enderror" required>
                        @foreach($listTahun as $thn)
                            <option value="{{ $thn }}" {{ old('tahun', date('Y')) == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                        @endforeach
                    </select>
                    @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="potongan_alpha" class="form-label">Potongan per Hari (Tanpa Keterangan) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control @error('potongan_alpha') is-invalid @enderror" id="potongan_alpha" name="potongan_alpha" value="{{ old('potongan_alpha', 50000) }}" required>
                    @error('potongan_alpha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="recalculate" id="recalculate" value="1">
                <label class="form-check-label" for="recalculate">
                    Hitung Ulang Gaji (Jika sudah ada data gaji untuk periode ini, akan ditimpa)
                </label>
            </div>

            <p class="text-muted">Perhitungan akan dilakukan untuk semua karyawan aktif berdasarkan absensi pada bulan dan tahun yang dipilih.</p>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Proses Hitung Gaji</button>
            </div>
        </form>
    </div>
</div>
@endsection