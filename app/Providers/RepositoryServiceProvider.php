<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // System \ Languages
        $this->app->bind(
            \App\Repositories\System\Contracts\SystemLanguageRepositoryInterface::class,
            \App\Repositories\System\SystemLanguageRepository::class
        );

        // System \ Currencies
        $this->app->bind(
            \App\Repositories\System\Contracts\CurrencyRepositoryInterface::class,
            \App\Repositories\System\CurrencyRepository::class
        );

        // System \ Exchange Rates
        $this->app->bind(
            \App\Repositories\System\Contracts\ExchangeRateRepositoryInterface::class,
            \App\Repositories\System\ExchangeRateRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
