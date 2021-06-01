<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\DatabaseCreated;
use App\Mail\SendMailCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

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
            $senha = uniqid(date('YmdHis'));

            $this->createUser($company, $senha);

            $this->createLocations();

            Mail::to($company->email)->send(new SendMailCompany($company, $senha));
        }


        return $migration === 0;
    }

    /**
     * @param Company $company
     * @param string $senha
     */
    private function createUser(Company $company, string $senha): void
    {
        User::create([
            'name' => $company->name,
            'email' => $company->email,
            'password' => bcrypt($senha)
        ]);
    }

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
