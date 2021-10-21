<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Contracts\TypeAddressRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;


class UserController extends ControllerStandard
{
    private $country;
    private $typeAddress;

    public function __construct(UserRepositoryInterface        $user,
                                TypeAddressRepositoryInterface $typeAddress,
                                CountryRepositoryInterface     $country)
    {
        $this->model = $user;
        $this->country = $country;
        $this->typeAddress = $typeAddress;

        $this->title = 'Usuário';
        $this->view = 'tenants.users';
        $this->route = 'users';
        $this->upload = [
            [
                'name' => 'image',
                'patch' => 'users'
            ],

            [
                'name' => 'google_service_account_credentials',
                'patch' => 'users'
            ],

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

        $type_addresses = $this->typeAddress->get();
        $countries = $this->country->get();

        $user_id = auth()->user()->id;
        $userViews = $this->model->getUsersViewNotIn($user_id);

        return view("{$this->view}.create", compact('title', 'type_addresses', 'countries', 'userViews'));
    }


    public function edit($id)
    {
        $userViews = $this->model->getUsersViewNotIn($id);

        $data = $this->model->relationships([
            'addresses.type_address',
            'addresses.city',
            'addresses.state',
            'contacts',
            'userViews.userView'
        ])->find($id);

        $usersSelected = $data->userViews->pluck('userView.id');

        $title = "Editar {$this->title}: {$data->name}";

        $type_addresses = $this->typeAddress->get();
        $countries = $this->country->get();
        $contacts = $data->contacts;
        $addresses = $data->addresses;

        return view("{$this->view}.create", compact('title', 'data', 'type_addresses', 'countries', 'contacts', 'addresses', 'userViews', 'usersSelected'));
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        $dataForm = $this->uploadFiles($request, $dataForm);

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

        $dataForm = $this->uploadFiles($request, $dataForm);

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
        $request->validate($this->model->rulesProfile($id));

        $dataForm = $request->all();

        $data = $this->model->find($id);

        $dataForm = $this->uploadFiles($request, $dataForm);

        unset($dataForm['email']);

        $update = $data->update($dataForm);

        if (!$update) {
            return redirect()->back()
                ->withErrors('Falha ao atualizar')
                ->withInput();
        }

        return redirect()->route("profile")
            ->with(['success' => 'Perfil alterado com sucesso!']);
    }

    public function resetPassword(Request $request, $id)
    {
        $rules = [
            'password' => 'required|min:3|max:20|confirmed',
        ];

        $this->validate($request, $rules);

        $dataForm = $request->all();

        $data = $this->model->find($id);

        if (isset($dataForm['password'])) {
            $dataForm['password'] = bcrypt($dataForm['password']);
        }

        $update = $data->update($dataForm);

        if (!$update) {
            return redirect()->back()
                ->withInput()
                ->withErrors($update['message']);
        }

        return redirect()->back()
            ->with(['success' => 'Registro alterado com sucesso!']);
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

    public function monitors($id)
    {
        if (request()->ajax()) {
            return $this->model->getStatesMonitors($id);
        }

        $user = $this->model->find($id);

        $title = 'Estados Monitorados: ' . $user->name;

        return view('tenants.users.states', compact('title', 'user'));
    }

    public function userDeleteMonitor($id, $monitorId)
    {
        $user = $this->model->find($id);

        $user->userStateMonitors()->detach($monitorId);

        return redirect()->route('users.monitors', $user->id)
            ->with('success', 'Monitoramento removido com sucesso!');
    }

    public function listStatesAdd($id)
    {
        $user = $this->model->find($id);

        $states = $this->model->getStatesNotIn($user);

        $title = 'Vincular estados ao usuário: ' . $user->name;

        return view('tenants.users.states-add', compact('states', 'user', 'title'));
    }

    public function userAddStates(Request $request, $id)
    {
        $dataForm = $request->get('states');

        $user = $this->model->find($id);

        $this->model->saveStates($user, $dataForm);

        return redirect()->route('users.monitors', $user->id);
    }


}
