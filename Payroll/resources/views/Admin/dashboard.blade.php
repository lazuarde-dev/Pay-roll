@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
    <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="mt-1 text-sm text-gray-600">Selamat datang kembali, lihat statistik terbaru hari ini</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center">
                <div class="relative">
                    <div class="flex items-center text-sm text-gray-500 mr-4">
                        <i data-lucide="calendar" class="h-4 w-4 mr-1"></i>
                        <span id="current-date">Loading...</span>
                    </div>
                </div>
                <button
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                    <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                    Unduh Laporan
                </button>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-emerald-100 rounded-full p-3">
                    <i data-lucide="user" class="h-6 w-6 text-emerald-600"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-medium text-gray-900">Selamat Datang, Admin Utama!</h2>
                    <p class="text-gray-600">Anda telah berhasil login sebagai Admin. Dari sini Anda dapat mengelola data
                        karyawan, melihat rekap absensi, dan melakukan proses penggajian.</p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                        <i data-lucide="users" class="h-5 w-5 text-blue-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Kelola Karyawan</h3>
                        <p class="text-xs text-gray-500">Tambah, edit, atau hapus data karyawan</p>
                    </div>
                </a>
                <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0 bg-amber-100 rounded-full p-2">
                        <i data-lucide="calendar-check" class="h-5 w-5 text-amber-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Rekap Absensi</h3>
                        <p class="text-xs text-gray-500">Lihat dan unduh laporan kehadiran</p>
                    </div>
                </a>
                <a href="#" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0 bg-purple-100 rounded-full p-2">
                        <i data-lucide="wallet" class="h-5 w-5 text-purple-600"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900">Penggajian</h3>
                        <p class="text-xs text-gray-500">Kelola dan proses gaji karyawan</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Karyawan</p>
                        <p class="text-2xl font-bold text-gray-900">248</p>
                    </div>
                    <div class="bg-emerald-100 rounded-full p-3">
                        <i data-lucide="users" class="h-6 w-6 text-emerald-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 flex items-center">
                        <i data-lucide="trending-up" class="h-4 w-4 mr-1"></i>
                        12%
                    </span>
                    <span class="text-gray-500 ml-2">dari bulan lalu</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Hadir Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">215</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <i data-lucide="check-circle" class="h-6 w-6 text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 flex items-center">
                        <i data-lucide="trending-up" class="h-4 w-4 mr-1"></i>
                        86.7%
                    </span>
                    <span class="text-gray-500 ml-2">tingkat kehadiran</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Terlambat</p>
                        <p class="text-2xl font-bold text-gray-900">24</p>
                    </div>
                    <div class="bg-amber-100 rounded-full p-3">
                        <i data-lucide="clock" class="h-6 w-6 text-amber-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-red-600 flex items-center">
                        <i data-lucide="trending-up" class="h-4 w-4 mr-1"></i>
                        5%
                    </span>
                    <span class="text-gray-500 ml-2">dari minggu lalu</span>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Tidak Hadir</p>
                        <p class="text-2xl font-bold text-gray-900">9</p>
                    </div>
                    <div class="bg-red-100 rounded-full p-3">
                        <i data-lucide="x-circle" class="h-6 w-6 text-red-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-600 flex items-center">
                        <i data-lucide="trending-down" class="h-4 w-4 mr-1"></i>
                        3%
                    </span>
                    <span class="text-gray-500 ml-2">dari minggu lalu</span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Attendance Chart -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Statistik Kehadiran Mingguan</h3>
                    <div class="flex items-center">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i data-lucide="more-horizontal" class="h-5 w-5"></i>
                        </button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>

            <!-- Department Distribution -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Distribusi Karyawan per Departemen</h3>
                    <div class="flex items-center">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i data-lucide="more-horizontal" class="h-5 w-5"></i>
                        </button>
                    </div>
                </div>
                <div class="h-80">
                    <div id="departmentChart"></div>
                </div>
            </div>
        </div>

        <!-- Recent Activity and Notifications -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
                        <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Lihat
                            Semua</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto scrollbar-hide">
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg"
                                    alt="User">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Siti Nurhaliza</p>
                                <p class="text-sm text-gray-500">Check-in pukul 08:02 WIB</p>
                                <p class="mt-1 text-xs text-gray-400">2 menit yang lalu</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Tepat Waktu
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/45.jpg"
                                    alt="User">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                                <p class="text-sm text-gray-500">Check-in pukul 08:15 WIB</p>
                                <p class="mt-1 text-xs text-gray-400">15 menit yang lalu</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    Terlambat
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                                    alt="User">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Dewi Lestari</p>
                                <p class="text-sm text-gray-500">Mengajukan cuti 3 hari</p>
                                <p class="mt-1 text-xs text-gray-400">45 menit yang lalu</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Menunggu Persetujuan
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg"
                                    alt="User">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Agus Purnomo</p>
                                <p class="text-sm text-gray-500">Check-out pukul 17:30 WIB</p>
                                <p class="mt-1 text-xs text-gray-400">1 jam yang lalu</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://randomuser.me/api/portraits/women/45.jpg"
                                    alt="User">
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Rina Wijaya</p>
                                <p class="text-sm text-gray-500">Mengirim laporan bulanan</p>
                                <p class="mt-1 text-xs text-gray-400">2 jam yang lalu</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Dokumen
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
                        <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Tandai Semua
                            Dibaca</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 max-h-96 overflow-y-auto scrollbar-hide">
                    <div class="px-6 py-4 bg-emerald-50">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-emerald-200 flex items-center justify-center">
                                    <i data-lucide="bell" class="h-4 w-4 text-emerald-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Pengajuan cuti baru</p>
                                <p class="text-xs text-gray-500">Dewi Lestari mengajukan cuti 3 hari</p>
                                <p class="mt-1 text-xs text-gray-400">45 menit yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-amber-200 flex items-center justify-center">
                                    <i data-lucide="alert-triangle" class="h-4 w-4 text-amber-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Tingkat keterlambatan meningkat</p>
                                <p class="text-xs text-gray-500">Keterlambatan minggu ini naik 5%</p>
                                <p class="mt-1 text-xs text-gray-400">2 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-blue-200 flex items-center justify-center">
                                    <i data-lucide="calendar" class="h-4 w-4 text-blue-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Rapat manajemen</p>
                                <p class="text-xs text-gray-500">Rapat dijadwalkan besok pukul 10:00</p>
                                <p class="mt-1 text-xs text-gray-400">5 jam yang lalu</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-purple-200 flex items-center justify-center">
                                    <i data-lucide="file-text" class="h-4 w-4 text-purple-600"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Laporan bulanan tersedia</p>
                                <p class="text-xs text-gray-500">Laporan absensi April telah selesai</p>
                                <p class="mt-1 text-xs text-gray-400">1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employee Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Karyawan Terbaru</h3>
                    <div class="mt-3 md:mt-0 flex items-center">
                        <div class="relative">
                            <input type="text" placeholder="Cari karyawan..."
                                class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="search" class="h-5 w-5 text-gray-400"></i>
                            </div>
                        </div>
                        <button
                            class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            <i data-lucide="filter" class="h-4 w-4 mr-2"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Karyawan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Departemen</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Bergabung</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/women/32.jpg" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Siti Nurhaliza</div>
                                        <div class="text-sm text-gray-500">siti@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">EMP-001</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Marketing</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                12 Jan 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/men/45.jpg" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                        <div class="text-sm text-gray-500">budi@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">EMP-002</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Keuangan</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                15 Feb 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Dewi Lestari</div>
                                        <div class="text-sm text-gray-500">dewi@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">EMP-003</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">SDM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                    Cuti
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                3 Mar 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/men/22.jpg" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Agus Purnomo</div>
                                        <div class="text-sm text-gray-500">agus@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">EMP-004</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">IT</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                20 Apr 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="https://randomuser.me/api/portraits/women/45.jpg" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Rina Wijaya</div>
                                        <div class="text-sm text-gray-500">rina@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">EMP-005</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Operasional</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                5 May 2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-emerald-600 hover:text-emerald-900 mr-3">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">5</span> dari
                        <span class="font-medium">42</span> karyawan
                    </div>
                    <div class="flex-1 flex justify-end">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i data-lucide="chevron-left" class="h-5 w-5"></i>
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-emerald-50 text-sm font-medium text-emerald-600 hover:bg-emerald-100">
                                1
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                2
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                3
                            </a>
                            <span
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                ...
                            </span>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                8
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                9
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i data-lucide="chevron-right" class="h-5 w-5"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#"
                    class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="bg-emerald-100 rounded-full p-3 mb-3">
                        <i data-lucide="user-plus" class="h-6 w-6 text-emerald-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Tambah Karyawan</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="bg-blue-100 rounded-full p-3 mb-3">
                        <i data-lucide="file-text" class="h-6 w-6 text-blue-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Buat Laporan</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="bg-amber-100 rounded-full p-3 mb-3">
                        <i data-lucide="calendar" class="h-6 w-6 text-amber-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Kelola Jadwal</span>
                </a>
                <a href="#"
                    class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="bg-purple-100 rounded-full p-3 mb-3">
                        <i data-lucide="settings" class="h-6 w-6 text-purple-600"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-900">Pengaturan</span>
                </a>
            </div>
        </div>
    </div>
@endsection
