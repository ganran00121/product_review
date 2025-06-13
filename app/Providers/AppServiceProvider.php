<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\User\UserRepositoryInterface::class,\App\Repositories\User\UserRepository::class);
        $this->app->bind(\App\Repositories\Product\ProductRepositoryInterface::class,\App\Repositories\Product\ProductRepository::class);
        $this->app->bind(\App\Repositories\Review\ReviewRepositoryInterface::class,\App\Repositories\Review\ReviewRepository::class
    );
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
