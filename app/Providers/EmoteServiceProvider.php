<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EmoteService;

class EmoteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EmoteService::class, function ($app) {
            return new EmoteService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
