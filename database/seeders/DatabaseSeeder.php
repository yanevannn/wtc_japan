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

        // Membuat user dengan role sensei
        User::create([
            'fname' => 'Sensei',
            'lname' => 'User',
            'email' => 'sensei@mail.com',
            'password' => bcrypt('sensei'), // Ganti dengan password yang lebih aman
            'email_verified_at' => now(),
            'role' => 'sensei',
        ]);
    }
}
