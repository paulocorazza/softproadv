<?php

namespace App\Queue\Jobs;

use App\Models\Company;
use App\Tenant\ManagerTenant;

class DatabaseJob extends \Illuminate\Queue\Jobs\DatabaseJob
{
    public function fire()
    {
        if ($this->job->company_uuid) {

            $manager = new ManagerTenant();

            $manager->setConnectionMain();

            $company = Company::where('uuid', $this->job->company_uuid)->first();

            $manager->setConnection($company);
        }

        parent::fire();
    }
}
