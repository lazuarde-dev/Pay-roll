<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk data dashboard admin (misal jumlah karyawan, dll)
        return view('admin.dashboard'); // Buat view: resources/views/admin/dashboard.blade.php
    }
}