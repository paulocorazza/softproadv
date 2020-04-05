<?php

namespace App\Providers;

use App\Helpers\Helper;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      // $this->registerPolicies();

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            Gate::define($permission->name , function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }

        Gate::define('companies', function (User $user) {
            $permission = Permission::where('name', 'companies')->first();
            return (Helper::domainIsMain()) && ($user->hasPermission($permission));
        });

        Gate::define('plans', function (User $user) {
            $permission = Permission::where('name', 'plans')->first();

            return (Helper::domainIsMain()) && ($user->hasPermission($permission));
        });


        Gate::before(function (User $user, $ability) {
            if ($user->hasProfile('Admin') &&  Helper::domainIsMain())  {
                return true;
            }
        });
    }
}
