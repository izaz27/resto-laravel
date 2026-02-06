<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Perlu memanggil Model Category
use App\Models\Menu;
use Illuminate\Support\Str; // Perlu memanggil helper Str untuk slug

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID Kategori yang sudah ada
        $cemilanId = Category::where('name', 'Cemilan')->first()->id ?? 1;
        $mieId = Category::where('name', 'Mie')->first()->id ?? 2;
        $nasiId = Category::where('name', 'Nasi')->first()->id ?? 3;
        $minumanId = Category::where('name', 'Minuman')->first()->id ?? 4;

        $menus = [
            // Kategori Nasi
            [
                'name' => 'Nasi Goreng Spesial',
                'category_id' => $nasiId,
                'description' => 'Nasi yang digoreng dengan bumbu khas dan dilengkapi telur mata sapi serta ayam suwir.',
                'price' => 25000,
                'is_available' => true,
            ],
            [
                'name' => 'Ayam Geprek Sambal Matah',
                'category_id' => $nasiId,
                'description' => 'Ayam goreng tepung renyah disajikan dengan nasi hangat dan sambal matah segar.',
                'price' => 30000,
                'is_available' => true,
            ],

            // Kategori Mie
            [
                'name' => 'Mie Kuah Pedas',
                'category_id' => $mieId,
                'description' => 'Mie rebus dengan kuah kaldu pedas, bakso, dan sawi hijau.',
                'price' => 22000,
                'is_available' => true,
            ],

            // Kategori Cemilan
            [
                'name' => 'Kentang Goreng Keju',
                'category_id' => $cemilanId,
                'description' => 'Kentang goreng renyah dengan taburan bumbu keju manis dan gurih.',
                'price' => 18000,
                'is_available' => true,
            ],

            // Kategori Minuman
            [
                'name' => 'Es Teh Manis Jumbo',
                'category_id' => $minumanId,
                'description' => 'Es teh dengan takaran gula yang pas dan ukuran gelas besar.',
                'price' => 8000,
                'is_available' => true,
            ],
            [
                'name' => 'Kopi Susu Dingin',
                'category_id' => $minumanId,
                'description' => 'Campuran kopi pilihan, susu segar, dan sedikit gula aren.',
                'price' => 15000,
                'is_available' => true,
            ],
            [
                'name' => 'Jus Alpukat',
                'category_id' => $minumanId,
                'description' => 'Jus alpukat murni, kental, dan dingin, dilengkapi cokelat.',
                'price' => 28000,
                'is_available' => false, // Contoh menu yang tidak tersedia
            ],
        ];

        foreach ($menus as $menuData) {
            // Tambahkan slug secara otomatis
            $menuData['slug'] = Str::slug($menuData['name']);
            Menu::create($menuData);
        }
    }
}
