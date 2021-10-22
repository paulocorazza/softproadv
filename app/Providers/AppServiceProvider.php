<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Event;
use App\Models\EventUsers;
use App\Models\Meet;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\ProcessUsers;
use App\Models\User;
use App\Models\UserStateMonitor;
use App\Observers\CompanyObserver;
use App\Observers\EventObserver;
use App\Observers\EventUsersObserver;
use App\Observers\MeetObserver;
use App\Observers\ProcessObserver;
use App\Observers\ProcessUsersObserver;
use App\Observers\ProgressObserver;
use App\Observers\UserObserver;
use App\Observers\UserStateMonitorObserver;
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
        Company::observe(CompanyObserver::class);
        User::observe(UserObserver::class);
        Event::observe(EventObserver::class);
        EventUsers::observe(EventUsersObserver::class);
        Process::observe(ProcessObserver::class);
        ProcessUsers::observe(ProcessUsersObserver::class);
        ProcessProgress::observe(ProgressObserver::class);
        Meet::observe(MeetObserver::class);
       // UserStateMonitor::observe(UserStateMonitorObserver::class);
    }
}
