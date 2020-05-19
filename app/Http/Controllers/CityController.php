<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;

class CityController extends ControllerStandard
{
    private $states;

    public function __construct(CityRepositoryInterface $city,
                                StateRepositoryInterface $states)
    {
        $this->model = $city;
        $this->states = $states;
        $this->title = 'Cidade';
        $this->view = 'tenants.cities';
        $this->route = 'cities';

        $this->middleware('can:cities');

        $this->middleware('can:create_city')->only(['create', 'store']);
        $this->middleware('can:update_city')->only(['edit', 'update']);
        $this->middleware('can:view_city')->only(['show']);
        $this->middleware('can:delete_city')->only(['delete']);
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
        $states = $this->states->getStates();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'states'));
    }


    public function edit($id)
    {
        $data = $this->model->find($id);

        $states = $this->states->getStates();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'states'));
    }

}
