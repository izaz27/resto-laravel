<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'menu_id', 
        'qty', 
        'price', 
        'note'
    ];

    /**
     * Relasi balik ke Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke Menu untuk mengambil nama makanan, gambar, dll
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}