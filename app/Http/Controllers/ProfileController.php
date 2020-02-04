<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileController extends ControllerStandard
{
    public function __construct(ProfileRepositoryInterface $profile)
    {
        $this->model = $profile;
        $this->title = 'Perfil';
        $this->view = 'tenants.profiles';
        $this->route = 'profiles';

        $this->middleware('can:profiles');

        $this->middleware('can:create_profile')->only(['create', 'store']);
        $this->middleware('can:update_profile')->only(['edit', 'update']);
        $this->middleware('can:view_profile')->only(['show']);
        $this->middleware('can:view_profile_users')->only(['users']);
        $this->middleware('can:view_profile_permissions')->only(['permissions']);
        $this->middleware('can:delete_profile')->only(['delete']);
    }

    public function users($id)
    {
        if (request()->ajax()) {
            return $this->model->getUsers($id);
        }

        $profile = $this->model->find($id);

        $title = 'Usuários com o perfil: ' . $profile->name;

        return view('tenants.profiles.users', compact('profile', 'title'));
    }

    public function userDeleteProfile($id, $userId)
    {
        $profile = $this->model->find($id);

        $profile->users()->detach($userId);

        return redirect()->route('profiles.users', $profile->id)
            ->with('success', 'Usuário removido com sucesso!');
    }


    public function listUsersAdd($id)
    {
        $profile = $this->model->find($id);

        //$users = User::doesntHave('profiles')->get();
        $users = $this->model->getUserNotIn($profile);

        $title = 'Vincular usuário ao perfil: ' . $profile->name;

        return view('tenants.profiles.users-add', compact('profile', 'users', 'title'));
    }

    public function userAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('users');

        $profile = $this->model->find($id);

        $profile->users()->attach($dataForm);

        return redirect()->route('profiles.users', $profile->id)
            ->with('success', 'Usuário adicionado com sucesso!');;
    }


    public function permissions($id)
    {
        if (request()->ajax()) {
            return $this->model->getPermissions($id);
        }

        $profile = $this->model->find($id);

        $title = 'Permissões com o perfil: ' . $profile->name;

        return view('tenants.profiles.permissions', compact('profile', 'title'));
    }


    public function permissionDeleteProfile($id, $permissionId)
    {
        $profile = $this->model->find($id);

        $profile->permissions()->detach($permissionId);

        return redirect()->route('profiles.permissions', $profile->id)
            ->with('success', 'Permissão removida com sucesso!');
    }

    public function listPermissionAdd($id)
    {
        $profile = $this->model->find($id);

        $permissions = $this->model->getPermissionNotInt($profile);

        $title = 'Vincular permissão ao perfil: ' . $profile->name;

        return view('tenants.profiles.permissions-add', compact('profile', 'permissions', 'title'));
    }

    public function permissionAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('permissions');

        $profile = $this->model->find($id);

        $profile->permissions()->attach($dataForm);

        return redirect()->route('profiles.permissions', $profile->id)
            ->with('success', 'Permissão adicionada com sucesso!');;
    }


}
