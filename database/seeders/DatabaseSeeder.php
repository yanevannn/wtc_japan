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

        DB::table('tb_status_pendaftaran')->insert([
            ['status' => 'Belum Lengkap', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Menunggu Verifikasi', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Gagal Verifikasi', 'created_at' => now(), 'updated_at' => now()],
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

        DB::table('tb_gelombang')->insert([
            [
                'nama_gelombang' => 'Gelombang 1',
                'tahun' => 2025,
                'status' => 'open',
                'link_grup' => 'https://example.com/grup-gelombang-1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('tb_pengumuman')->insert([
            [
                'judul' => 'Pengumuman 1',
                'deskripsi' => 'Deskripsi Pengumuman 1',
                'file' => 'file1.pdf',
                'created_by' => 1,
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pengumuman 2',
                'deskripsi' => 'Deskripsi Pengumuman 2',
                'file' => 'file2.pdf',
                'created_by' => 1,
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
