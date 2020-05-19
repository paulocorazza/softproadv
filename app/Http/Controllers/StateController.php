<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\StateRepositoryInterface;
use Illuminate\Http\Request;

class StateController extends ControllerStandard
{
    private $country;

    public function __construct(StateRepositoryInterface $state,
                                CountryRepositoryInterface $country)
    {
        $this->model = $state;
        $this->country = $country;
        $this->title = 'Estado';
        $this->view = 'tenants.states';
        $this->route = 'states';

        $this->middleware('can:states');

        $this->middleware('can:create_state')->only(['create', 'store']);
        $this->middleware('can:update_state')->only(['edit', 'update']);
        $this->middleware('can:view_state')->only(['show']);
        $this->middleware('can:delete_state')->only(['delete']);
    }


    public function create()
    {
        $countries = $this->country->getCountries();

        $title = "Cadastrar {$this->title}";
        return view("{$this->view}.create", compact('title', 'countries'));
    }

    public function edit($id)
    {
        $data = $this->model->find($id);

        $countries = $this->country->getCountries();

        $title = "Editar {$this->title}: {$data->name}";

        return view("{$this->view}.create", compact('title', 'data', 'countries'));
    }


    public function getCities($id)
    {
        $return = $this->model->getCities($id);

        if (!$return['status']) {
            return redirect()->back()
                ->withErrors($return['message']);
        }

        return response()->json($return['data']);
    }
}
