<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
{
    // Opsional: Hapus data user lama sebelum isi baru agar tidak double
    // DB::table('users')->truncate(); 

    DB::table('users')->updateOrInsert(
        ['email' => 'admin@resto.com'], // Cek berdasarkan email
        [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );

    DB::table('users')->updateOrInsert(
        ['email' => 'kasir@resto.com'],
        [
            'name' => 'Kasir',
            'password' => Hash::make('admin123'),
            'role' => 'kasir',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );
}
}