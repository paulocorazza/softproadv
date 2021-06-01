<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FinancialRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinancialController extends ControllerStandard
{
    public function __construct(FinancialRepositoryInterface $financial)
    {
        $this->model = $financial;
        $this->title = 'Financeiro';
        $this->view = 'tenants.financial';
        $this->route = 'financial';

        $this->middleware('can:financials');

        $this->middleware('can:create_financial')->only(['create', 'store']);
        $this->middleware('can:update_financial')->only(['edit', 'update']);
        $this->middleware('can:view_financial')->only(['show']);
        $this->middleware('can:delete_financial')->only(['delete']);
    }

    public function create()
    {
        $person = [];
        $category = [];
        $account = [];
        $process = [];

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create",
            compact('title', 'person', 'category', 'account', 'process'));
    }

    public function show($id)
    {
        $data = $this->model->relationships(
            ['person', 'process', 'financialCategory', 'financialAccount'])->find($id);


        $title = "{$this->title}: {$data->name}";

        return view("{$this->view}.show", compact('title', 'data'));

    }

    public function store(Request $request)
    {
        $dataForm = $request->all();

        $validate = Validator::make($request->all(),  $this->model->rules());

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        $insert = $this->model->create($dataForm);


        if (!$insert['status']) {
            return $insert['message'];
        }

        session()->flash('success', 'Registro realizado com sucesso!');

        return '1';
    }


    public function edit($id)
    {
        $data = $this->model->relationships(
            ['person', 'process', 'financialCategory', 'financialAccount'])->find($id);

        $person = $data->person()->get()->pluck('name', 'id');
        $category = $data->financialCategory()->get()->pluck('name', 'id');
        $account = $data->financialAccount()->get()->pluck('description', 'id');
        $process = $data->process()->get()->pluck('number_process', 'id');

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create",
            compact('title', 'data', 'person', 'category', 'account', 'process'));
    }


    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $validate = Validator::make($request->all(),  $this->model->rules($id));

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        $update = $this->model->update($id, $dataForm);

        if (!$update['status']) {
            return $update['message'];
        }

        session()->flash('success', 'Registro alterado com sucesso!');

        return '1';
    }

}
