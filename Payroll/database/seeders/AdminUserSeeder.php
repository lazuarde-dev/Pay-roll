<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Kunci untuk cek apakah sudah ada
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'), // GANTI DENGAN PASSWORD YANG KUAT!
                'role' => 'admin',
            ]
        );
    }
}
