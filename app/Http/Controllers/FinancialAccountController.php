<?php

namespace App\Http\Controllers;


use App\Repositories\Contracts\FinancialAccountRepositoryInterface;

class FinancialAccountController extends ControllerStandard
{
    public function __construct(FinancialAccountRepositoryInterface $financial)
    {
        $this->model = $financial;
        $this->title = 'Conta Financeira';
        $this->view = 'tenants.financial-account';
        $this->route = 'financial-account';

        $this->middleware('can:financial-account');

        $this->middleware('can:create_financial_account')->only(['create', 'store']);
        $this->middleware('can:update_financial_account')->only(['edit', 'update']);
        $this->middleware('can:view_financial_account')->only(['show']);
        $this->middleware('can:delete_financial_account')->only(['delete']);
    }
}
