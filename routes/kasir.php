<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kasir\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::patch('/order/{order}/status', [DashboardController::class, 'updateStatus'])->name('order.updateStatus');