<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Repositories\Contracts\ContractModelInterface;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessContractController extends Controller
{
    private ProcessRepositoryInterface $model;
    private ContractModelInterface $contractModel;

    public function __construct(
        ProcessRepositoryInterface $process,
        ContractModelInterface $contractModel,
    ) {
        $this->model = $process;
        $this->contractModel = $contractModel;
    }


    public function contract($id)
    {
        $data = $this->model->find($id);

        $contracts = $this->contractModel->get();

        $title = "Editar Contrato: {$data->name}";

        return view("tenants.processes.contract",
            compact('title', 'data', 'contracts'));
    }

    public function updateContract(Request $request, $id)
    {
        $dataForm = $request->all();

        $this->validate($request, [
            'contract' => 'required'
        ]);

        $update = $this->model->updateContract($id, $dataForm);

        if (!$update['status']) {
            return redirect()->back()
                ->with('error', 'Falha ao atualizar')
                ->withInput();
        }

        return redirect()->back()
            ->with('success', 'Registro alterado com sucesso!');
    }

    public function preview($id)
    {
        $process = $this->model->relationships('person', 'counterPart', 'forum', 'stick', 'users')->find($id);

        $contract = $this->model->replaceTags($process);

        return PDF::loadView('tenants.reports.processes.contract', compact('contract'))
            ->setPaper('a4')
            ->stream('contract.pdf');

    }
}
