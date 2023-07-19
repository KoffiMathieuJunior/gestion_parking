<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Exceptions\SanctumExceptionHandler;
// use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // Passport::ignoreRoutes();
        // Sanctum::ignoreMigrations();
        $this->app->bind(
            \Illuminate\Contracts\Debug\ExceptionHandler::class,
            SanctumExceptionHandler::class
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
        Schema::defaultStringLength(191);
    }
}
