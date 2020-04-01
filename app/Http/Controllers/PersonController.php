<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Origin;
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
        $origins = Origin::get()->pluck('name', 'id');


        return view("{$this->view}.create", compact('title', 'type_addresses', 'countries', 'origins'));
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            list($nameFile, $upload) = $this->upload($request);

            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha no upload do arquivo')
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        $insert = $this->model->create($dataForm);

        if (!$insert['status']) {
            return redirect()->back()
                ->with('error', $insert['message'])
                ->withInput();
        }

        return redirect()->route("{$this->route}.index")
            ->with('success', 'Registro realizado com sucesso!');
    }


    public function edit($id)
    {
        $data = $this->model->relationships([
            'addresses.type_address',
            'addresses.city',
            'addresses.state',
            'contacts'
        ])->find($id);


        $title = "Editar {$this->title}: {$data->name}";

        $origins = Origin::get()->pluck('name', 'id');
        $type_addresses = TypeAddress::all();
        $countries = Country::all();
        $contacts = $data->contacts;
        $addresses = $data->addresses;

        return view("{$this->view}.create", compact('title', 'data', 'type_addresses', 'countries', 'origins', 'contacts', 'addresses'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, $this->model->rules($id));

        $dataForm = $request->all();

        $data = $this->model->find($id);

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            $file = $data->{$this->upload['name']};

            list($nameFile, $upload) = $this->upload($request, $file);

            if (!$upload) {
                return redirect()->back()
                    ->withErrors(['errors' => 'Falha no upload do arquivo'])
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        $update = $this->model->update($id, $dataForm);

        if (!$update['status']) {
            return redirect()->back()
                ->withInput()
                ->withErrors($update['message']);
        }

        return redirect()->route("{$this->route}.index")
            ->with(['success' => 'Registro alterado com sucesso!']);
    }


}
