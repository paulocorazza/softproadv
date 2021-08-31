<?php

namespace App\Providers;

use App\Events\CreateUpdateEvent;
use App\Listeners\IntegrationGoogleCalendar;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        CreateUpdateEvent::class => [
          IntegrationGoogleCalendar::class
        ],

        'App\Events\Tenant\CompanyCreated' => [
            'App\Listeners\Tenant\CreateCompanyDataBase'
        ],

        'App\Events\Tenant\DatabaseCreated' => [
            'App\Listeners\Tenant\RunMigrationsTenant'
        ],

        'App\Events\Tenant\UserLogin' => [
            'App\Listeners\Tenant\UserEventSubscriber'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
