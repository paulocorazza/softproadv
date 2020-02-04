<?php

namespace App\Repositories\Contracts;

use App\Models\Company;

interface AgreementRepositoryInterface
{
    public function create($id);
    public function executeAgreement($token, Company $company);
    public function detailAgreement($id);
    public function updateCompany(Company $company, $id);
}


