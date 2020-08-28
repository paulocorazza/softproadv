<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends ControllerStandard
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(EventRepositoryInterface $event, UserRepositoryInterface $user)
    {
        $this->model = $event;
        $this->title = 'Atividades';
        $this->view = 'tenants.events';
        $this->route = 'events';
        $this->upload = [
            'name' => 'file',
            'patch' => 'events'
        ];

        $this->user = $user;

        $this->middleware('can:event');

        $this->middleware('can:create_event')->only(['create', 'store']);
        $this->middleware('can:update_event')->only(['edit', 'update']);
        $this->middleware('can:view_event')->only(['show']);
        $this->middleware('can:delete_event')->only(['delete']);
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
        $data = $this->model->relationships('process')
            ->find($id);

        $title = "{$this->title}: {$data->name}";

        $users = $this->user->getAdvogados();
        $processes = $data->process()->get()->pluck('process_person', 'id');

        return view("{$this->view}.create", compact('title', 'data', 'users', 'processes'));
    }


    public function store(Request $request)
    {
        $request = $this->defaultValues($request);

        $dataForm = $request->all();

        $validate = Validator::make($request->all(),  $this->model->rules());

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            list($nameFile, $upload) = $this->upload($request);

            if (!$upload) {
                return 'Falha no upload do arquivo';
            }

            $dataForm[$this->upload['name']] = $nameFile;
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
        $request = $this->defaultValues($request);

        $dataForm = $request->all();

        $validate = Validator::make($request->all(),  $this->model->rules($id));

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            list($nameFile, $upload) = $this->upload($request);

            if (!$upload) {
                return 'Falha no upload do arquivo';
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        $update = $this->model->update($id, $dataForm);

        if (!$update['status']) {
            return $update['message'];
        }

        session()->flash('success', 'Registro alterado com sucesso!');

        return '1';
    }



    /**
     * @param Request $request
     * @return Request
     */
    private function defaultValues(Request $request): Request
    {
        $request['user_id'] = auth()->user()->id;
        $request['schedule'] = (isset($request['schedule'])) ? true :false;
        return $request;
    }

}
