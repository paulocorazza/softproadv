<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StageRepositoryInterface;


class StageController extends ControllerStandard
{
    public function __construct(StageRepositoryInterface $stage)
    {
        $this->model = $stage;
        $this->title = 'Etapa';
        $this->view = 'tenants.stages';
        $this->route = 'stages';

        $this->middleware('can:stages');

        $this->middleware('can:create_state')->only(['create', 'store']);
        $this->middleware('can:update_state')->only(['edit', 'update']);
        $this->middleware('can:view_state')->only(['show']);
        $this->middleware('can:delete_state')->only(['delete']);
    }

    public function create()
    {
        $phases = $this->model->getPhases();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'phases'));
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        $phases = $this->model->getPhases();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'phases'));
    }

}
