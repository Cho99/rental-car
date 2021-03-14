<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Feature\FeatureRepository;
use App\Repositories\Feature\FeatureRepositoryInterface;
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
        $this->app->singleton(
            AddressRepositoryInterface::class,
            AddressRepository::class,
        );

        $this->app->singleton(
            FeatureRepositoryInterface::class,
            FeatureRepository::class,
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
