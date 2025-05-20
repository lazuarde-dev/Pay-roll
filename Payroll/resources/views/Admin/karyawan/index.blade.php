@extends('layouts.app')

@section('title', 'Kelola Karyawan')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">Tambah Karyawan Baru</a>
    </div>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTableKaryawan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Tgl Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->id }}</td>
                        <td>{{ $karyawan->user->name ?? 'N/A' }}</td>
                        <td>{{ $karyawan->user->email ?? 'N/A' }}</td>
                        <td>{{ $karyawan->posisi }}</td>
                        <td>{{ $karyawan->tanggal_masuk->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.karyawan.show', $karyawan->id) }}" class="btn btn-sm btn-info" title="Lihat"><i class="bi bi-eye"></i> Lihat</a>
                            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i> Edit</a>
                            <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus karyawan ini? Ini akan menghapus data user, absensi, dan gaji terkait.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data karyawan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($karyawans->hasPages())
        <div class="mt-3">
            {{ $karyawans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush