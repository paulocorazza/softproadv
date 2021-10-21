<?php

namespace App\Observers;

use App\Jobs\CreateApiKeyJuzBrazil;
use App\Models\Company;


class CompanyObserver
{
    public function created(Company $company)
    {
        dispatch(new CreateApiKeyJuzBrazil($company));
    }
}
