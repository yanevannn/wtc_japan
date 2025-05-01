<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat user dengan role admin
        User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'), // Ganti dengan password yang lebih aman
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Membuat user dengan role user
        User::create([
            'fname' => 'Regular',
            'lname' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('user'), // Ganti dengan password yang lebih aman
            'email_verified_at' => now(),
            'role' => 'user',
        ]);

        DB::table('tb_status_pendaftaran')->insert([
            ['status' => 'Belum Lengkao', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Menunggu Verifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Ditolak', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Diterima', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('tb_status_siswa')->insert([
            ['status' => 'Pendaftaran', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Seleksi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Pelatihan', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Berhenti', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Lulus', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
