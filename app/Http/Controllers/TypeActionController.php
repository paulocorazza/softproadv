<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TypeActionRepositoryInterface;

class TypeActionController extends ControllerStandard
{
    public function __construct(TypeActionRepositoryInterface $type)
    {
        $this->model = $type;
        $this->title = 'Tipo de Ação';
        $this->view = 'tenants.type-actions';
        $this->route = 'type-actions';

        $this->middleware('can:type_actions');

        $this->middleware('can:create_type_action')->only(['create', 'store']);
        $this->middleware('can:update_type_action')->only(['edit', 'update']);
        $this->middleware('can:view_type_action')->only(['show']);
        $this->middleware('can:delete_type_action')->only(['delete']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return $this->model
                ->dataTables('action', $this->view . '.partials.acoes');
        }

        $title = "Gestão de {$this->title}s";
        return view("{$this->view}.index", compact('title'));
    }


    public function create()
    {
        $groups = $this->model->getGroupActions();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'groups'));
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        $groups = $this->model->getGroupActions();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'groups'));
    }

}

