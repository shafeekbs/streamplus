<?php

namespace App\Providers;

use App\Services\Payment\PaymentProcessor;
use App\Services\Payment\PaymentProcessorInterface;
use Illuminate\Support\ServiceProvider;

class PaymentProcessorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(PaymentProcessorInterface::class, PaymentProcessor::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
