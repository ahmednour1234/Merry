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
        $this->app->bind(
            \App\Repositories\System\Contracts\UserRepositoryInterface::class,
            \App\Repositories\System\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Contracts\InsuranceCompanyRepositoryInterface::class,
            \App\Repositories\System\InsuranceCompanyRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Contracts\CityRepositoryInterface::class,
            \App\Repositories\System\CityRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Subscriptions\Contracts\PlanRepositoryInterface::class,
            \App\Repositories\System\Subscriptions\PlanRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Subscriptions\Contracts\SubscriptionRepositoryInterface::class,
            \App\Repositories\System\Subscriptions\SubscriptionRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Subscriptions\Contracts\CouponRepositoryInterface::class,
            \App\Repositories\System\Subscriptions\CouponRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Subscriptions\Contracts\PromotionRepositoryInterface::class,
            \App\Repositories\System\Subscriptions\PromotionRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Contracts\NationalityRepositoryInterface::class,
            \App\Repositories\System\NationalityRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Contracts\CategoryRepositoryInterface::class,
            \App\Repositories\System\CategoryRepository::class
        );
        $this->app->bind(
            \App\Repositories\System\Cv\Contracts\CvRepositoryInterface::class,
            \App\Repositories\System\Cv\CvRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
