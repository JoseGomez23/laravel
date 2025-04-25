<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

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
    public function boot()
    {
        // Extender el comportamiento de Socialite para Google y deshabilitar la verificación SSL
        Socialite::extend('google', function ($app) {
            $config = $app['config']['services.google'];

            return Socialite::buildProvider(\Laravel\Socialite\Two\GoogleProvider::class, $config)
                ->setHttpClient(
                    new Client([
                        'verify' => false,  // Deshabilitar la verificación SSL
                    ])
                );
        });
    }
}
