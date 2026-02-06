<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantInfo extends Model
{
    // Beritahu Laravel agar menggunakan nama tabel tunggal sesuai migrasimu
    protected $table = 'restaurant_info'; // Pastikan ini ada agar tidak error plural lagi
    protected $fillable = ['name', 'address', 'open_time', 'close_time', 'logo', 'banner'];
}
