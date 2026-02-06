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
    }

    public function boot(): void
    {
        if (str_contains(request()->header('host'), 'ngrok-free')) {
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}