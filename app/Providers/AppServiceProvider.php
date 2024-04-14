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
        // bind all inferfaces of eloquent orm.
        $orm = config('orm.default');
        $bindings = config("orm.{$orm}.bindings");

        foreach ($bindings as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }

        // bind all inferfaces of the selected api provider.
        $apiProvider = config('api.default');
        $bindings = config("api.{$apiProvider}.bindings");

        foreach ($bindings as $contract => $implementation) {
            $this->app->bind($contract, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
