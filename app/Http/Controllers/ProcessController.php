<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Contracts\ForumRepositoryInterface;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Contracts\PhaseRepositoryInterface;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Contracts\StickRepositoryInterface;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessController extends ControllerStandard
{

    /**
     * @var ProcessRepositoryInterface
     */
    private $process;
    /**
     * @var ForumRepositoryInterface
     */
    private $forum;
    /**
     * @var StickRepositoryInterface
     */
    private $sticks;
    /**
     * @var DistrictRepositoryInterface
     */
    private $districts;
    /**
     * @var GroupActionRepositoryInterface
     */
    private $groupActions;
    /**
     * @var UserRepositoryInterface
     */
    private $users;
    /**
     * @var TypeActionRepositoryInterface
     */
    private $typeAction;
    /**
     * @var PhaseRepositoryInterface
     */
    private $phase;

    public function __construct(
        ProcessRepositoryInterface $process,
        ForumRepositoryInterface $forum,
        StickRepositoryInterface $sticks,
        DistrictRepositoryInterface $districts,
        GroupActionRepositoryInterface $groupActions,
        UserRepositoryInterface $users,
        TypeActionRepositoryInterface $typeAction,
        PhaseRepositoryInterface $phase

    ) {
        $this->model = $process;
        $this->forum = $forum;
        $this->sticks = $sticks;
        $this->districts = $districts;
        $this->groupActions = $groupActions;
        $this->users = $users;
        $this->typeAction = $typeAction;
        $this->phase = $phase;

        $this->title = 'Processo';
        $this->view = 'tenants.processes';
        $this->route = 'processes';

        $this->middleware('can:processes');
        $this->middleware('can:create_process')->only(['create', 'store']);
        $this->middleware('can:update_process')->only(['edit', 'update']);
        $this->middleware('can:view_process')->only(['show']);
        $this->middleware('can:delete_process')->only(['delete']);
    }

    public function create()
    {
        $person = [];
        $counterpart = [];
        $forums = $this->forum->getForums();
        $sticks = $this->sticks->getSticks();
        $districts = $this->districts->getDistricts();
        $groupActions = $this->groupActions->getGroupActions();
        $typeActions = [];
        $phases = [];
        $stages = [];
        $users = $this->users->getAdvogados();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create",
            compact('title', 'person', 'counterpart', 'forums', 'sticks', 'districts', 'groupActions', 'typeActions',
                'users', 'phases', 'stages'));
    }


    public function edit($id)
    {
        $data = $this->model->relationships(
            [
                'person',
                'counterPart',
                'forum',
                'stick',
                'district',
                'groupAction',
                'typeAction',
                'phase',
                'stage',
                'users',
                'progresses',
                'files',

            ])->find($id);

        $progresses = $data->progresses;
        $files = $data->files;


        $person = $data->person()->pluck('name', 'id');
        $counterpart = $data->counterPart()->pluck('name', 'id');
        $forums = $this->forum->getForums();
        $sticks = $this->sticks->getSticks();
        $districts = $this->districts->getDistricts();
        $groupActions = $this->groupActions->getGroupActions();
        $typeActions = $this->typeAction->getTypeActionByGroupId($data->group_action_id);
        $phases = $this->typeAction->getPhasesByTypeAction($data->type_action_id);
        $stages = $this->phase->getStagesByPhase($data->phase_id);
        $users = $this->users->getAdvogados();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create",
            compact('title', 'data', 'person', 'counterpart', 'forums', 'sticks', 'districts', 'groupActions',
                'typeActions',
                'users', 'phases', 'stages', 'progresses', 'files'));
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


    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $validate = Validator::make($request->all(),  $this->model->rules());

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
