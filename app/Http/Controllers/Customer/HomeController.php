<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RestaurantInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data informasi resto pertama dari tabel restaurant_info
        $info = RestaurantInfo::first(); 
        return view('customer.home', compact('info'));
    }
}
