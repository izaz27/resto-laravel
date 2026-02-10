<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\MenuRepositoryInterface; 
use App\Repositories\MenuRepository;
use Illuminate\Support\Facades\URL;     

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Mengikat MenuRepositoryInterface ke MenuRepository
        $this->app->bind(
            MenuRepositoryInterface::class, 
            MenuRepository::class
        );

        if (config('app.env') === 'production') {
        $this->app->bind('path.public', function () {
            return base_path('public');
        });
    }
    }

    public function boot(): void
{
    // Paksa HTTPS jika aplikasi berjalan di server (Production)
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}
}