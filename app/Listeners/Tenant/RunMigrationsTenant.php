<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Mail\SendMailCompany;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RunMigrationsTenant implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param DatabaseCreated $event
     * @return void
     */
    public function handle(DatabaseCreated $event)
    {
        $company = $event->company();

        $migration = Artisan::call('tenants:migrations', [
            'id' => $company->id
        ]);


        if ($migration === 0) {
            $this->createLocations();
        }


        return $migration === 0;
    }

    /**
     * @param Company $company
     * @param string $password
     */
/*    private function createUser(Company $company, string $password): void
    {
        $user =  User::create([
            'name' => $company->name,
            'email' => $company->email,
            'password' => bcrypt($password),
            'nivel' => '1'
        ]);

        Profile::first()->users()->attach($user);
    }*/

    private function createLocations(): void
    {
        Artisan::call('db:seed', [
            '--force' => true,
            '--class' => 'CountryTableSeeder'
        ]);

        Artisan::call('db:seed', [
            '--force' => true,
            '--class' => 'StateTableSeeder'
        ]);

        Artisan::call('db:seed', [
            '--force' => true,
            '--class' => 'CityTableSeeder'
        ]);
    }
}
