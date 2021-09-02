<?php

namespace App\Providers;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['queue']->createPayloadUsing(function () {
            return session()->has('company') ? [
                'tenant' => session('company')['uuid']
            ] : [];
        });

        $this->app['events']->listen(\Illuminate\Queue\Events\JobProcessing::class, function($event){
            if (isset($event->job->payload()['tenant'])) {
                $manager = app(ManagerTenant::class);
                $manager->setConnectionMain();
                $company = Company::where('uuid', $event->job->payload()['tenant'])->first();
                $manager->setConnection($company);
            }
        });

        Queue::failing(function (JobFailed $event) {
            echo $event->exception;
        });

    }
}
