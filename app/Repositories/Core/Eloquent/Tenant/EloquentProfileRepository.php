<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\ProfileRepositoryInterface;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentProfileRepository extends BaseEloquentRepository
    implements ProfileRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Profile::class;
    }


    public function getUsers($id)
    {
        $profiles = $this->relationships('users')->find($id);

        $users = $profiles->users;

        return Datatables()->collection($users)->addColumn('action', function ($users) use ($id) {
            return '<a href="/profiles/' . $id . '/user/' . $users->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getUserNotIn($profile)
    {
        return User::WhereNotIn('id', function ($query) use ($profile) {
            $query->select('profile_user.user_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.profile_id = {$profile->id}");
        })->get();
    }

    public function getPermissions($id)
    {
        $profiles = $this->relationships('users')->find($id);

        $permissions = $profiles->permissions;

        return Datatables()->collection($permissions)->addColumn('action', function ($permissions) use ($id) {
            return '<a href="/profiles/' . $id . '/permission/' . $permissions->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getPermissionNotInt($profile)
    {
        return Permission::WhereNotIn('id', function ($query) use ($profile) {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = {$profile->id}");
        })->get();
    }
}
