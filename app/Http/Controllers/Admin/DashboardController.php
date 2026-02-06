<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Pendapatan Hari Ini (Hanya yang berstatus 'completed')
        $todayRevenue = Order::whereDate('created_at', Carbon::today())
                            ->where('status', 'completed')
                            ->sum('total_price');

        // 2. Hitung Statistik (Menu & Kategori)
        $totalMenus = Menu::count();
        $totalCategories = Category::count(); // Tambahkan baris ini agar tidak error

        // 3. Data tambahan lainnya (Opsional jika ingin dipakai nanti)
        $totalOrdersToday = Order::whereDate('created_at', Carbon::today())->count();
        $pendingOrders = Order::where('status', 'pending')->count();

        // Kirim semua variabel ke view
        return view('admin.dashboard', compact(
            'todayRevenue', 
            'totalMenus', 
            'totalCategories', 
            'totalOrdersToday', 
            'pendingOrders'
        ));
    }

    public function indexLaporan()
    {
        // Ambil data hari ini saja
        $orders = Order::whereDate('created_at', today())
                    ->where('status', 'completed')
                    ->get();

        return view('admin.laporan.laporan_pendapatan', compact('orders'));
    }
}