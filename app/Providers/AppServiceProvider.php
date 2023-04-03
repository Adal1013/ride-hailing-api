<?php

namespace App\Providers;

use App\Http\Repositories\Drivers\Impl\DriverRepositoryImpl;
use App\Http\Repositories\Drivers\DriverRepository;
use App\Http\Repositories\PaymentSources\Impl\PaymentSourceRepositoryImpl;
use App\Http\Repositories\PaymentSources\PaymentSourceRepository;
use App\Http\Repositories\Riders\Impl\RiderRepositoryImpl;
use App\Http\Repositories\Riders\RiderRepository;
use App\Http\Repositories\Transactions\Impl\TransactionRepositoryImpl;
use App\Http\Repositories\Transactions\TransactionRepository;
use App\Http\Repositories\Trips\Impl\TripRepositoryImpl;
use App\Http\Repositories\Trips\TripRepository;
use App\Http\Services\PaymentSources\Impl\PaymentSourceServiceImpl;
use App\Http\Services\PaymentSources\PaymentSourceService;
use App\Http\Services\Transactions\Impl\TransactionServiceImpl;
use App\Http\Services\Transactions\TransactionService;
use App\Http\Services\Trips\Impl\TripServiceImpl;
use App\Http\Services\Trips\TripService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      // Repositories
      $this->app->bind(DriverRepository::class, DriverRepositoryImpl::class);
      $this->app->bind(PaymentSourceRepository::class, PaymentSourceRepositoryImpl::class);
      $this->app->bind(RiderRepository::class, RiderRepositoryImpl::class);
      $this->app->bind(TransactionRepository::class, TransactionRepositoryImpl::class);
      $this->app->bind(TripRepository::class, TripRepositoryImpl::class);

      // Services
      $this->app->bind(PaymentSourceService::class, PaymentSourceServiceImpl::class);
      $this->app->bind(TripService::class, TripServiceImpl::class);
      $this->app->bind(TransactionService::class, TransactionServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
