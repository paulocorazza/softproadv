<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MeetRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetController extends ControllerStandard
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(MeetRepositoryInterface $meet, UserRepositoryInterface $user)
    {
        $this->model = $meet;
        $this->title = 'Atendimentos';
        $this->view = 'tenants.meets';
        $this->route = 'meets';

        $this->user = $user;

/*        $this->middleware('can:meets');
        $this->middleware('can:create_meet')->only(['create', 'store']);
        $this->middleware('can:update_meet')->only(['edit', 'update']);
        $this->middleware('can:view_meet')->only(['show']);
        $this->middleware('can:delete_meet')->only(['delete']);*/
    }


    public function index(Request $request)
    {
        if (request()->ajax()) {
            return $this->model->dataTables('action', $this->view . '.partials.acoes', $request);
        }

        $users = $this->user->getAdvogados();

        $title = "Gestão de {$this->title}s";
        return view("{$this->view}.index", compact('title', 'users'));
    }

    public function create()
    {
        $title = "Cadastrar {$this->title}";

        $users = $this->user->getAdvogados();
        $processes = [];

        return view("{$this->view}.create", compact('title', 'users', 'processes'));
    }

    public function edit($id)
    {
        $data = $this->model->relationships(['process.person', 'users'])
            ->find($id);

        $title = "{$this->title}: {$data->name}";

        $users = $this->user->getAdvogados();
        $processes = $data->process()->get()->pluck('process_person', 'id');


        if (\request()->ajax()) {
            return response()->json($data);
        }

        return view("{$this->view}.create", compact('title', 'data', 'users', 'processes'));
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
