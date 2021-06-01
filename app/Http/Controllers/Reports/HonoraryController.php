<?php

namespace App\Http\Controllers\Reports;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\FinancialRepositoryInterface;
use App\Repositories\Core\Eloquent\Tenant\EloquentFinancialRepository;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class HonoraryController extends Controller
{
    public function index()
    {
        $person = [];

        return view('tenants.reports.honorary.index', compact('person'));
    }

    public function report(Request $request, FinancialRepositoryInterface $financial)
    {
        $rules = [
          'data_inicial' => 'required',
          'data_final'   => 'required',
          'date_for'     => 'required',
          'person_id'    => "nullable|exists:people,id"
        ];

        $this->validate($request, $rules);


        $honorarys = $financial->honorarys($request);

        $data_ini =  Helper::formatDateTime($request->get('data_inicial'), 'd/m/Y');
        $data_end = Helper::formatDateTime($request->get('data_final'), 'd/m/Y');


        return \PDF::loadView('tenants.reports.honorary.report', compact('honorarys', 'data_end', 'data_ini'))
            ->setPaper('a4')
            ->stream('honorarys.pdf');
    }
}
