<?php

namespace App\Providers;

use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Core\Eloquent\Tenant\EloquentCompanyRepository;
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
    }
}
