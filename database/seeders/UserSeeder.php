<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // DITAMBAHKAN
use Illuminate\Support\Facades\Hash; // DITAMBAHKAN
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'kasir utama',
            'email' => 'kasir@resto.com',
            'password' => Hash::make('admin123'), // Ini akan otomatis menggunakan algoritma aplikasi Anda
            'role' => 'kasir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
