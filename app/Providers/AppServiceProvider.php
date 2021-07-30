<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');

        Schema::defaultStringLength('191');
        Paginator::useBootstrap();

        /**
         * Diretivas
         */

        Blade::if('tenant', function () {
            return (request()->getHost() != config('tenant.domain_main'));
        });

        Blade::if('tenantmain', function () {
            return (request()->getHost() == config('tenant.domain_main'));
        });



        /**
         * Observers
         */
        User::observe(UserObserver::class);

    }
}
