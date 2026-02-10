<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php', // Default web route
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            // Memuat rute utama (Login, Customer, dll)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Memuat rute Admin
            if (file_exists(base_path('routes/admin.php'))) {
                Route::middleware(['web', 'auth', 'role:admin'])
                    ->prefix('admin')
                    ->name('admin.')
                    ->group(base_path('routes/admin.php'));
            }

            // Memuat rute Kasir
            if (file_exists(base_path('routes/kasir.php'))) {
                Route::middleware(['web', 'auth', 'role:kasir'])
                    ->prefix('kasir')
                    ->name('kasir.')
                    ->group(base_path('routes/kasir.php'));
            }
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
    // TAMBAHKAN INI: Agar Laravel mengenali SSL dari Railway/Vercel
    $middleware->trustProxies(at: '*'); 

    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);

    $middleware->redirectTo(
        guests: '/login',
        users: function () {
            /** @var \App\Models\User|null $user */
            $user = \Illuminate\Support\Facades\Auth::user(); 
            
            if ($user?->role === 'admin') return route('admin.dashboard');
            if ($user?->role === 'kasir') return route('kasir.dashboard');
            
            return route('customer.home');
        }
    );
})
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();