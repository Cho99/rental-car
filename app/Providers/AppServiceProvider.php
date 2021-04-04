<?php

namespace App\Providers;

use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Repositories\Feature\FeatureRepository;
use App\Repositories\Feature\FeatureRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Car\CarRepository;
use App\Repositories\Car\CarRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Rule\RuleRepository;
use App\Repositories\Rule\RuleRepositoryInterface;
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

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->singleton(
            RuleRepositoryInterface::class,
            RuleRepository::class,
        );

        $this->app->singleton(
            CarRepositoryInterface::class,
            CarRepository::class,
        );

        $this->app->singleton(
            ImageRepositoryInterface::class,
            ImageRepository::class,
        );

        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
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
