<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kasir extends User // Mewarisi dari User
{
    use HasFactory;

    protected $table = 'users'; 

    protected static function booted()
    {
        static::addGlobalScope('kasir', function (Builder $builder) {
            $builder->where('role', 'kasir');
        });
    }
}