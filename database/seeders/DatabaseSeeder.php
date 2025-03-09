<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang lebih aman
            'role' => 'admin', // Pastikan ada kolom 'role' di tabel users
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Sensei User',
            'email' => 'sensei@example.com',
            'password' => bcrypt('password'),
            'role' => 'sensei',
        ]);
    }
}
