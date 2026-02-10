<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // User 1: Admin
            [
                'name' => 'Admin',
                'email' => 'admin@resto.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // User 2: Kasir
            [
                'name' => 'Kasir',
                'email' => 'kasir@resto.com',
                'password' => Hash::make('admin123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}