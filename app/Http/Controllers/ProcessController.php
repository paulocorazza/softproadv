<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Contracts\ForumRepositoryInterface;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Contracts\StickRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class ProcessController extends ControllerStandard
{
    private $forums;
    private $sticks;
    private $districts;
    private $groupActions;
    private $users;

    public function __construct(ProcessRepositoryInterface $process,
                                ForumRepositoryInterface $forum,
                                StickRepositoryInterface $sticks,
                                DistrictRepositoryInterface $districts,
                                GroupActionRepositoryInterface $groupActions,
                                UserRepositoryInterface $users)
    {
        $this->model = $process;
        $this->forums = $forum;
        $this->sticks = $sticks;
        $this->districts = $districts;
        $this->groupActions = $groupActions;
        $this->users = $users;

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
        $forums = $this->forums->getForums();
        $sticks = $this->sticks->getSticks();
        $districts = $this->districts->getDistricts();
        $groupActions = $this->groupActions->getGroupActions();
        $typeActions = [];
        $phases = [];
        $stages = [];
        $users = $this->users->getAdvogados();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'person', 'counterpart', 'forums', 'sticks', 'districts', 'groupActions', 'typeActions', 'users', 'phases', 'stages'));
    }


    public function store(Request $request)
    {

        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        $return = $this->model->create($dataForm);

        if (!$return['status']) {
            return redirect()->back()
                ->withInput()
                ->withErrors($return['message']);
        }

        return redirect()->route("{$this->route}.index")
            ->with('success', 'Registro realizado com sucesso!');
    }

}
