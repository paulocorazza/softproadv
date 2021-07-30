<?php

namespace App\Console\Commands\Tenant;

use App\Mail\SendMailCompany;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TenantCreateUserSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:email {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email User with DNS Available';

    private $tenant;

    /**
     * TenantMigrations constructor.
     * @param ManagerTenant $tenant
     */
    public function __construct(ManagerTenant $tenant)
    {
        parent::__construct();
        $this->tenant = $tenant;
    }


    private function execCommand(Company $company)
    {
        if ($this->hasDNSAvailable($company)) {
            $this->info("Creating User {$company->name}");

            //Connection Tenant
            $this->tenant->setConnection($company);

            /** send email user */
            $password = Str::random(8);
            $this->createUser($company, $password);
            $this->info("Send Email to User {$company->name}");

            $company->sendRegisterNotification($company, $password);

            //Connection Domain Mail
            $this->tenant->setConnectionMain();

            $this->info("Salvando status do dns {$company->name}");
            $company->dns_status = true;
            $company->save();

            $this->info("Email Send Successfully {$company->name}");

            $this->info("----------------------------------------");
        }
    }

    private function createUser(Company $company, string $password): void
    {
        $user = User::create([
            'name' => $company->name,
            'email' => $company->email,
            'password' => bcrypt($password),
            'nivel' => '1'
        ]);

        Profile::first()->users()->attach($user);
    }

    private function hasDNSAvailable(Company $company)
    {
        $response = Http::get('https://' . $company->subdomain . config('tenant.subdomain'));

        return $response->ok();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($id = $this->argument('id')) {
            $company = Company::findOrFail($id);

            return $this->execCommand($company);
        }

        $companies = Company::where('dns_status', false)->get();

        foreach ($companies as $company) {
            $this->execCommand($company);
        }
    }
}
