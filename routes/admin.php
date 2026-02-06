<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('category', CategoryController::class);
Route::resource('menu', AdminMenuController::class);

Route::get('/orders', [AdminOrderController::class, 'index'])->name('order.index');
Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('order.show');
Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('order.updateStatus');
Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('order.destroy');
Route::delete('/orders/clear/all', [AdminOrderController::class, 'clearHistory'])->name('order.clearHistory');