<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RestaurantInfo::create([
        'name' => 'Resto YPKP',
        'address' => 'Jl. Khp Hasan Mustopa No.68, Cikutra, Kec. Cibeunying Kidul, Kota Bandung, Jawa Barat 40124',
        'open_time' => '08:00',
        'close_time' => '22:00',
    ]);
    }
}
