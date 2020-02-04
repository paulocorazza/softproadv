<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;


class UserController extends ControllerStandard
{
    public function __construct(UserRepositoryInterface $user)
    {
        $this->model = $user;
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

        $dataForm['salary']  =


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
