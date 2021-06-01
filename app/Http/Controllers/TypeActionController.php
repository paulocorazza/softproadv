<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use Illuminate\Http\Request;

class TypeActionController extends ControllerStandard
{
    private $groupAction;

    public function __construct(TypeActionRepositoryInterface $type,
                                GroupActionRepositoryInterface $groupAction)
    {
        $this->model = $type;
        $this->groupAction = $groupAction;
        $this->title = 'Tipo de Ação';
        $this->view = 'tenants.type-actions';
        $this->route = 'type-actions';

        $this->middleware('can:type_actions');

        $this->middleware('can:create_type_action')->only(['create', 'store']);
        $this->middleware('can:update_type_action')->only(['edit', 'update']);
        $this->middleware('can:view_type_action')->only(['show']);
        $this->middleware('can:view_type_action_phases')->only(['phases']);
        $this->middleware('can:delete_type_action')->only(['delete']);

    }

    public function create()
    {
        $groups = $this->groupAction->getGroupActions();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'groups'));
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        $groups = $this->groupAction->getGroupActions();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'groups'));
    }

    public function phases($id)
    {
        if (request()->ajax()) {
            return $this->model->getPhases($id);
        }

        $typeAction = $this->model->find($id);

        $title = 'Fases com o Tipo de Ação: ' . $typeAction->name;

        return view('tenants.type-actions.phases', compact('typeAction', 'title'));
    }

    public function typeActionDeletePhase($id, $phaseId)
    {
        $typeAction = $this->model->find($id);

        $typeAction->phases()->detach($phaseId);

        return redirect()->route('type-actions.phases', $id)
            ->with('success', 'Fase removida com sucesso!');
    }

    public function listPhaseAdd($id)
    {
        $typeAction = $this->model->find($id);

        $phases = $this->model->getPhasesNotIn($typeAction);

        $title = 'Vincular fases ao Tipo de Ação: ' . $typeAction->name;

        return view('tenants.type-actions.phases-add', compact('typeAction', 'phases', 'title'));
    }

    public function typeActionAddPhase(Request $request, $id)
    {
        $dataForm = $request->get('phases');

        $typeAction = $this->model->find($id);

        $typeAction->phases()->attach($dataForm);

        return redirect()->route('type-actions.phases', $typeAction->id)
            ->with('success', 'Fase(s) adicionada(s) com sucesso!');
    }

    public function phasesSelect($id)
    {
        if (request()->ajax()) {

            $return = $this->model->getPhasesSelect($id);

            if (!$return['status']) {
                return  response()->json($return['message']);
            }

            return response()->json($return['data']);
        }
    }

}

