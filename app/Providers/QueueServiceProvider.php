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
                'tenant_id' => session('company')['uuid']
            ] : [];
        });

        $this->app['events']->listen(\Illuminate\Queue\Events\JobProcessing::class, function($event){
            if (isset($event->job->payload()['tenant_id'])) {

                $manager = new ManagerTenant();

                $manager->setConnectionMain();
                $company = Company::where('uuid', $event->job->payload()['tenant_id'])->first();
                $manager->setConnection($company);
            }
        });

        Queue::failing(function (JobFailed $event) {
            echo $event->exception;
        });

    }
}
