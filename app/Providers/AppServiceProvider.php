<?php

namespace App\Providers;

use App\Http\Repositories\PaymentSources\Impl\PaymentSourceRepositoryImpl;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Http\Repositories\Riders\Impl\RiderRepositoryImpl;
use App\Http\Repositories\Riders\RiderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RiderRepository::class, RiderRepositoryImpl::class);
        $this->app->bind(PaymentSourceRepository::class, PaymentSourceRepositoryImpl::class);
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
