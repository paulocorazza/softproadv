<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FinancialCategoryRepositoryInterface;
use Illuminate\Http\Request;

class FinancialCategoryController extends ControllerStandard
{
    public function __construct(FinancialCategoryRepositoryInterface $financial)
    {
        $this->model = $financial;
        $this->title = 'Categoria Financeira';
        $this->view = 'tenants.financial-category';
        $this->route = 'financial-category';

        $this->middleware('can:financialCategory');

        $this->middleware('can:create_financial_category')->only(['create', 'store']);
        $this->middleware('can:update_financial_category')->only(['edit', 'update']);
        $this->middleware('can:view_financial_category')->only(['show']);
        $this->middleware('can:delete_financial_category')->only(['delete']);
    }
}
