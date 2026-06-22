<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Admin
        User::create([
            'nama' => 'Admin Koperasi Dua',
    'email' => 'admin2@koperasi.com', // Ganti dengan email lain
    'password' => bcrypt('password123'),
    'role' => 'admin',
        ]);

        // 2. Buat User Anggota
        $user = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
        ]);

        // 3. Masukkan ke tabel Anggota
        Anggota::create([
            'user_id' => $user->id,
            'kode_anggota' => 'A-0001',
            'nik' => '3201234567890001',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Jl. Merdeka No 1',
            'no_hp' => '08123456789',
            'pekerjaan' => 'Wiraswasta'
        ]);
    }
}