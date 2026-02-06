<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'order_code', 
        'table_numbers', 
        'total_price', 
        'payment_method', 
        'status'
    ];

    /**
     * Relasi ke OrderDetail (Satu Order memiliki banyak Detail/Items)
     */
    public function details()
    {
        // Jika nama tabel detail kamu 'order_details', gunakan OrderDetail::class
        // Jika nama tabel detail kamu 'orders_item', pastikan model OrderItem juga sudah dibuat
        return $this->hasMany(OrderDetail::class);
    }
}