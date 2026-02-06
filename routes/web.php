<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\TableController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Kasir\DashboardController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Bridge (Aman untuk memicu redirect sesuai role)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    /** @var \App\Models\User|null $user */
    $user = \Illuminate\Support\Facades\Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'kasir') {
        return redirect()->route('kasir.dashboard');
    }
    
    return redirect()->route('customer.home');
})->middleware(['auth'])->name('dashboard');
Route::delete('/kasir/order/{id}', [DashboardController::class, 'destroy'])->name('kasir.order.destroy');
Route::get('/kasir/order/{id}/cetak', [App\Http\Controllers\Kasir\DashboardController::class, 'cetakStruk'])->name('kasir.order.cetak');

Route::get('/admin/laporan', [DashboardController::class, 'indexLaporan'])->name('admin.laporan.index');
Route::get('/admin/laporan/ekspor', [DashboardController::class, 'eksporLaporan'])->name('admin.laporan.ekspor');
Route::get('/admin/laporan/ekspor', [App\Http\Controllers\Kasir\DashboardController::class, 'eksporLaporan'])->name('admin.laporan.ekspor');

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('customer.home');
Route::get('/list-menu', [CustomerMenuController::class, 'index'])->name('customer.menu.index');
Route::get('/menu/{menu:slug}', [CustomerMenuController::class, 'show'])->name('customer.menu.show');

// Keranjang (Cart)
Route::controller(CartController::class)->prefix('cart')->name('customer.cart.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add/{menu}', 'add')->name('add');
    Route::patch('/update/{id}', 'update')->name('update');
    Route::delete('/remove/{id}', 'remove')->name('remove');
});

// Pilih Meja
Route::get('/pilih-meja', [TableController::class, 'index'])->name('customer.table.index');
Route::post('/pilih-meja', [TableController::class, 'store'])->name('customer.table.store');

// Order Processing
Route::prefix('customer')->name('customer.')->group(function () {
    Route::post('/order/process', [CustomerOrderController::class, 'process'])->name('order.process');
    Route::get('/order/success/{id}', [CustomerOrderController::class, 'success'])->name('order.success');
});