<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 'image_path', 'is_available'
    ];
        
    // Relasi: Menu dimiliki oleh satu Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    // Relasi: Menu ada di banyak OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class);
    }
}