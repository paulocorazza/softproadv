<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CityRepositoryInterface;

class CityController extends ControllerStandard
{
    public function __construct(CityRepositoryInterface $city)
    {
        $this->model = $city;
        $this->title = 'Cidade';
        $this->view = 'tenants.cities';
        $this->route = 'cities';

        $this->middleware('can:cities');

        $this->middleware('can:create_cities')->only(['create', 'store']);
        $this->middleware('can:update_cities')->only(['edit', 'update']);
        $this->middleware('can:view_cities')->only(['show']);
        $this->middleware('can:delete_cities')->only(['delete']);
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
        $states = $this->model->getStates();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'states'));
    }


    public function edit($id)
    {
        $data = $this->model->find($id);

        $states = $this->model->getStates();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'states'));
    }

}
