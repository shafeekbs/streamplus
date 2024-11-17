<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CountryConfig\CountryConfigInterface;
use App\Services\CountryConfig\CountryConfigService;

class CountryConfigProvider extends ServiceProvider
{
    /**
     * Register services for country Config.
     */
    public function register(): void
    {
        $this->app->bind(CountryConfigInterface::class, CountryConfigService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
