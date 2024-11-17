<?php

namespace App\Providers;

use App\Services\FormProcessor\FormProcessorInterface;
use App\Services\FormProcessor\FormProcessor;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FormProcessorInterface::class, FormProcessor::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
