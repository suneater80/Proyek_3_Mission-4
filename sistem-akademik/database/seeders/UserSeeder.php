<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@polban.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Buat akun mahasiswa
        User::create([
            'name' => 'Mahasiswa Satu',
            'email' => 'mahasiswa@polban.ac.id',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa'
        ]);
    }
}