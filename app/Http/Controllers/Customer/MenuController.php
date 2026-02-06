<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar semua kategori dan menu yang tersedia.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
    $query = Menu::where('is_available', true)->with('category');

    // Filter berdasarkan kategori jika ada di URL
    if ($request->has('category')) {
        $query->whereHas('category', function($q) use ($request) {
            $q->where('slug', $request->category);
        });
    }

    $menus = $query->get();
    return view('customer.menu', compact('categories', 'menus'));
    }

    public function show(Menu $menu)
{
    // Mengambil 2 menu rekomendasi dari kategori yang sama (selain menu ini)
    $recommendations = Menu::where('category_id', $menu->category_id)
        ->where('id', '!=', $menu->id)
        ->where('is_available', true)
        ->limit(2)
        ->get();

    return view('customer.menu_detail', compact('menu', 'recommendations'));
}
}