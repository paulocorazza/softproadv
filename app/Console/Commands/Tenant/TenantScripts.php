<?php

namespace App\Console\Commands\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TenantScripts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:scripts {id?} {--refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migrations Tenants';

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


    private function execCommand(Company $company) {

        $command = $this->option('refresh') ? 'migrate:refresh' : 'migrate';

        $this->tenant->setConnection($company);

        $this->info("Connecting Company {$company->name}");

        $run = Artisan::call($command, [
            '--force' => true,
            '--path' => '/database/migrations/tenant'
        ]);

        if ($run === 0) {
            $this->info("Migration Success {$company->name}");
        }

        $this->info("End Connecting Company {$company->name}");
        $this->info("----------------------------------------");
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

        $companies = Company::all();

        foreach ($companies as $company) {
            $this->execCommand($company);
        }
    }
}
