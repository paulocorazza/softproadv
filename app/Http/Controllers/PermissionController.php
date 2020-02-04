<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends ControllerStandard
{
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->model = $permission;
        $this->title = 'Permissão';
        $this->view = 'tenants.permissions';
        $this->route = 'permissions';

             $this->middleware('can:permissions');

             $this->middleware('can:create_permission')->only(['create', 'store']);
             $this->middleware('can:update_permission')->only(['edit', 'update']);
             $this->middleware('can:view_permission')->only(['show']);
             $this->middleware('can:view_permission_profile')->only(['profiles']);
             $this->middleware('can:delete_permission')->only(['delete']);
    }


    public function profiles($id)
    {
        if (request()->ajax()) {
            return $this->model->getProfiles($id);
        }

        $permission = $this->model->find($id);

        $title = 'Perfis com a permissão: ' . $permission->name;

        return view('tenants.permissions.profiles', compact('permission', 'title'));
    }


    public function permissionDeleteProfile($id, $profileId)
    {
        $permission = $this->model->find($id);

        $permission->profiles()->detach($profileId);

        return redirect()->route('permissions.profiles', $id)
                         ->with('success', 'Perfil removido com sucesso!');
    }

    public function listProfileAdd($id)
    {
        $permission = $this->model->find($id);

        $profiles = $this->model->getProfilesNotIn($permission);

        $title = 'Vincular perfil a permissão: ' . $permission->name;

        return view('tenants.permissions.profiles-add', compact('permission', 'profiles', 'title'));

    }

    public function permissionAddProfile(Request $request, $id)
    {
        $dataForm = $request->get('profiles');

        $permission = $this->model->find($id);

        $permission->profiles()->attach($dataForm);

        return redirect()->route('permissions.profiles', $permission->id)
                        ->with('success', 'Perfil adicionado com sucesso!');
    }

}
