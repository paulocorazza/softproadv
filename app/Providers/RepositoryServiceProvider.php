<?php

namespace App\Providers;

use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Contracts\AgreementRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Contracts\ForumRepositoryInterface;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Contracts\OriginRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\PersonRepositoryInterface;
use App\Repositories\Contracts\PlanRepositoryInterface;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use App\Repositories\Contracts\StickRepositoryInterface;
use App\Repositories\Contracts\SubscriptionRepositoryInterface;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Contracts\TypeAddressRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

use App\Repositories\Core\DigitalPayments\AgreementPlanRepository;
use App\Repositories\Core\DigitalPayments\SubscriptionPlanRepository;

use App\Repositories\Core\Eloquent\Tenant\EloquentAddressRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentCityRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentCompanyRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentContactRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentCountryRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentDistrictRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentForumRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentGroupActionRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentOriginRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentPermissionRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentPersonRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentPlanRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentProfileRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentStateRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentStickRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentTypeActionRepository;
use App\Repositories\Core\Eloquent\Tenant\EloquentTypeAddressRepository;
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
            EloquentCityRepository::class
        );

        $this->app->bind(
            StateRepositoryInterface::class,
            EloquentStateRepository::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            EloquentCountryRepository::class
        );

        $this->app->bind(
            TypeAddressRepositoryInterface::class,
            EloquentTypeAddressRepository::class
        );

        $this->app->bind(
             OriginRepositoryInterface::class,
            EloquentOriginRepository::class
        );

        $this->app->bind(
            ForumRepositoryInterface::class,
            EloquentForumRepository::class
        );

        $this->app->bind(
            StickRepositoryInterface::class,
            EloquentStickRepository::class
        );

        $this->app->bind(
            DistrictRepositoryInterface::class,
            EloquentDistrictRepository::class
        );

        $this->app->bind(
          PersonRepositoryInterface::class,
          EloquentPersonRepository::class
        );

        $this->app->bind(
            GroupActionRepositoryInterface::class,
            EloquentGroupActionRepository::class
        );

        $this->app->bind(
            TypeActionRepositoryInterface::class,
            EloquentTypeActionRepository::class
        );

        $this->app->bind(
            AddressRepositoryInterface::class,
            EloquentAddressRepository::class
        );

        $this->app->bind(
            ContactRepositoryInterface::class,
            EloquentContactRepository::class
        );


    }
}
