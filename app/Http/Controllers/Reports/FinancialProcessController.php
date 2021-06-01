<?php

namespace App\Http\Controllers\Reports;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Repositories\Contracts\PersonRepositoryInterface;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class FinancialProcessController extends Controller
{
    public function __construct(private PersonRepositoryInterface $model)
    {
    }

    public function index()
    {
        $person = [];

        return view('tenants.reports.financial-process.index', compact('person'));
    }

    public function report(Request $request)
    {
        $rules = [
            'data_inicial' => 'required',
            'data_final'   => 'required',
            'date_for'     => 'required',
            'person_id'    => "nullable|exists:people,id"
        ];

        $this->validate($request, $rules);

        $datas = $this->model->getPersonProcessesFinancial($request);

        $data_ini =  Helper::formatDateTime($request->get('data_inicial'), 'd/m/Y');
        $data_end = Helper::formatDateTime($request->get('data_final'), 'd/m/Y');

        return PDF::loadView('tenants.reports.financial-process.report', compact('datas', 'data_ini', 'data_end'))
            ->stream();
    }
}
