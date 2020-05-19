<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PhaseRepositoryInterface;
use App\Repositories\Contracts\StageRepositoryInterface;


class StageController extends ControllerStandard
{
    private $phases;

    public function __construct(StageRepositoryInterface $stage,
                                PhaseRepositoryInterface $phases)
    {
        $this->model = $stage;
        $this->phases = $phases;
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
        $phases = $this->phases->getPhases();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'phases'));
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        $phases = $this->phases->getPhases();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'phases'));
    }

}
