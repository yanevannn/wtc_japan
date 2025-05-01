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
            ['status' => 'belum_lengkap', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'menunggu_verifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'ditolak', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'diterima', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('tb_status_siswa')->insert([
            ['status' => 'pendaftaran', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'seleksi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'pelatihan', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'berhenti', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'lulus', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
