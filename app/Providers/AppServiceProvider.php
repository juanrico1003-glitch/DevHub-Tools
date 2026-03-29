<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Forzar que todos los assets (CSS/JS) y rutas 
         * se generen con HTTPS cuando la app está en producción.
         * Esto arregla el problema de "Mixed Content" en Railway.
         */
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}