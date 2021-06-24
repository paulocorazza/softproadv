<?php

namespace App\Http\Controllers;


use App\Repositories\Contracts\FinancialAccountRepositoryInterface;
use Illuminate\Http\Request;

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

    public function create()
    {
        $title = "Cadastrar {$this->title}";
        $instructions = [];
        return view("{$this->view}.create", compact('title', 'instructions'));
    }


    public function edit($id)
    {
        $data = $this->model->relationships('instructions')->find($id);

        $title = "Editar {$this->title}: {$data->name}";
        $instructions = $data->instructions;

        return view("{$this->view}.create", compact('title', 'data', 'instructions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        $insert = $this->model->create($dataForm);

        if (!$insert['status']) {
            return redirect()->back()
                ->with('error', $insert['message'])
                ->withInput();
        }

        return redirect()->route("{$this->route}.index")
            ->with('success', 'Registro realizado com sucesso!');
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, $this->model->rules($id));

        $dataForm = $request->all();

        $update = $this->model->update($id, $dataForm);

        if (!$update['status']) {
            return redirect()->back()
                ->with('error', $update['message'])
                ->withInput();
        }

        return redirect()->route("{$this->route}.index")
            ->with('success', $update['message']);
    }
}
