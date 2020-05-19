<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;


class UserController extends ControllerStandard
{
    private $typeAction;
    private $country;

    public function __construct(UserRepositoryInterface $user,
                                TypeActionRepositoryInterface $typeAction,
                                CountryRepositoryInterface $country)
    {
        $this->model = $user;
        $this->typeAction = $typeAction;
        $this->country = $country;

        $this->title = 'Usuario';
        $this->view = 'tenants.users';
        $this->route = 'users';
        $this->upload = [
            'name' => 'image',
            'patch' => 'users'
        ];

        $this->middleware('can:users');

        $this->middleware('can:create_user')->only(['create', 'store']);
        $this->middleware('can:update_user')->only(['edit', 'update']);
        $this->middleware('can:view_user')->only(['show']);
        $this->middleware('can:delete_user')->only(['delete']);
        $this->middleware('can:view_user_profile')->only(['profiles']);
    }


    public function create()
    {
        $title = "Cadastrar {$this->title}";

        $type_addresses = $this->typeAction->get();
        $countries = $this->country->get();

        return view("{$this->view}.create", compact('title', 'type_addresses', 'countries'));
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

        $type_addresses = $this->typeAction->get();
        $countries = $this->country->get();
        $contacts = $data->contacts;
        $addresses = $data->addresses;


        return view("{$this->view}.create", compact('title', 'data', 'type_addresses', 'countries', 'contacts', 'addresses'));
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            list($nameFile, $upload) = $this->upload($request);

            if (!$upload) {
                return redirect()->back()
                    ->with('error',  'Falha no upload do arquivo')
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        if (isset($dataForm['password'])) {
            $dataForm['password'] = bcrypt($dataForm['password']);
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

        if (isset($dataForm['password'])) {
            $dataForm['password'] = bcrypt($dataForm['password']);
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


    public function showProfile()
    {
        //recupera ao usuário
        $data = auth()->user();

        $title = 'Meu Perfil';

        return view('tenants.users.profile', compact('title', 'data'));
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate($this->model->rules($id));

        $dataForm = $request->all();

        $data = $this->model->find($id);

        if ($this->upload && $request->hasFile($this->upload['name'])) {
            $file = $data->{$this->upload['name']};

            list($nameFile, $upload) = $this->upload($request, $file);

            if (!$upload) {
                return redirect()->back()
                    ->withErrors('Falha no upload do arquivo')
                    ->withInput();
            }

            $dataForm[$this->upload['name']] = $nameFile;
        }

        unset($dataForm['email']);
        $dataForm['password'] = bcrypt($dataForm['password']);

        $dataForm['salary'] =


        $update = $data->update($dataForm);

        if (!$update) {
            return redirect()->back()
                ->withErrors('Falha ao atualizar')
                ->withInput();
        }

        return redirect()->route("profile")
            ->with(['success' => 'Perfil alterado com sucesso!']);
    }

    public function profiles($id)
    {
        if (request()->ajax()) {
            return $this->model->getProfiles($id);
        }

        $user = $this->model->find($id);

        $title = 'Perfis do usuário: ' . $user->name;

        return view('tenants.users.profiles', compact('title', 'user'));
    }

    public function userDeleteProfile($id, $profileId)
    {
        $user = $this->model->find($id);

        $profiles = $user->profiles()->detach($profileId);

        return redirect()->route('users.profiles', $user->id)
            ->with('success', 'Perfil removido com sucesso!');

    }

    public function listProfileAdd($id)
    {
        $user = $this->model->find($id);

        //$users = User::doesntHave('profiles')->get();
        $profiles = $this->model->getProfilesNotIn($user);

        $title = 'Vincular perfil ao usuário: ' . $user->name;

        return view('tenants.users.profiles-add', compact('profiles', 'user', 'title'));
    }


    public function userAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('profiles');

        $user = $this->model->find($id);

        $user->profiles()->attach($dataForm);

        return redirect()->route('users.profiles', $user->id);
    }

}
