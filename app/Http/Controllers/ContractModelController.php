<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ContractModelInterface;

class ContractModelController extends ControllerStandard
{
    public function __construct(ContractModelInterface $contract)
    {
        $this->model = $contract;
        $this->title = 'Modelo de Contrato';
        $this->view = 'tenants.contracts';
        $this->route = 'contracts';

        $this->middleware('can:contracts');

        $this->middleware('can:create_contract')->only(['create', 'store']);
        $this->middleware('can:update_contract')->only(['edit', 'update']);
        $this->middleware('can:view_contract')->only(['show']);
        $this->middleware('can:delete_contract')->only(['delete']);
    }
}
