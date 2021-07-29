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

class RunMigrationsTenant
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
            //usuário será criado no momento em que for propagado o dns do subdominio
/*            $password = Str::random(8);

            $this->createUser($company, $password);*/

            $this->createLocations();

            //Mail::to($company->email)->send(new SendMailCompany($company, $password));
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
