<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Event;
use App\Models\EventUsers;
use App\Models\ProcessUsers;
use App\Models\Schedule;
use App\Models\User;
use App\Observers\EventObserver;
use App\Observers\EventUsersObserver;
use App\Observers\ProcessUsersObserver;
use App\Observers\ScheduleObserver;
use App\Observers\UserObserver;
use App\Tenant\ManagerTenant;
use Illuminate\Pagination\Paginator;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;


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
       Queue::failing(function (JobFailed $event) {
            echo $event->exception;
        });


        if (config('app.env') == 'production') {
            URL::forceScheme('https');
        }

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
        Event::observe(EventObserver::class);
        EventUsers::observe(EventUsersObserver::class);
        ProcessUsers::observe(ProcessUsersObserver::class);
    }
}
