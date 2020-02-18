<?php

namespace App\Providers;

use App\Repositories\Contracts\AgreementRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\Core\DigitalPayments\AgreementPlanRepository;
use App\Repositories\Core\DigitalPayments\SubscriptionPlanRepository;

use App\Repositories\Core\Eloquent\Tenant\EloquentCityRepositoryRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentCompanyRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentCountryRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentPermissionRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentPlanRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentProfileRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentStateRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(
            CompanyRepositoryInterface::class,
            EloquentCompanyRepository::class
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            EloquentPlanRepository::class
        );

        $this->app->bind(
            AgreementRepositoryInterface::class,
            AgreementPlanRepository::class
        );

        $this->app->bind(
            SubscriptionRepositoryInterface::class,
            SubscriptionPlanRepository::class
        );


        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            ProfileRepositoryInterface::class,
                EloquentProfileRepository::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            EloquentPermissionRepository::class
        );

        $this->app->bind(
            CityRepositoryInterface::class,
            EloquentCityRepositoryRepository::class
        );

        $this->app->bind(
            StateRepositoryInterface::class,
            EloquentStateRepository::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            EloquentCountryRepository::class
        );

    }
}
