<?php

namespace App\Providers;

use App\Repository\Exchange\FcmExchangeRateRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\ExchangeRateRepositoryInterface',
            function () {
                return new FcmExchangeRateRepository(config('exchange.fcm.url'));
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
