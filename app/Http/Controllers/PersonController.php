<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\TypeAddress;
use App\Repositories\Contracts\PersonRepositoryInterface;
use Illuminate\Http\Request;

class PersonController extends ControllerStandard
{
    public function __construct(PersonRepositoryInterface $person)
    {
        $this->model = $person;
        $this->title = 'Pessoa';
        $this->view = 'tenants.people';
        $this->route = 'people';
        $this->upload = [
            'name' => 'image',
            'patch' => 'people'
        ];

        $this->middleware('can:people');

        $this->middleware('can:create_person')->only(['create', 'store']);
        $this->middleware('can:update_person')->only(['edit', 'update']);
        $this->middleware('can:view_person')->only(['show']);
        $this->middleware('can:delete_person')->only(['delete']);
    }

    public function create()
    {
        $title = "Cadastrar {$this->title}";

        $type_addresses = TypeAddress::all();
        $countries = Country::all();


        return view("{$this->view}.create", compact('title', 'type_addresses', 'countries'));
    }

}
