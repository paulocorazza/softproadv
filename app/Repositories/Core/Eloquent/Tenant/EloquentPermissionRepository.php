<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Permission;
use App\Models\Profile;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentPermissionRepository extends BaseEloquentRepository
                                   implements PermissionRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Permission::class;
    }


    public function getProfiles($id)
    {
        $permission = $this->relationships('profiles')->find($id);

        $profiles = $permission->profiles;


        return Datatables()->collection($profiles)->addColumn('action', function ($profiles) use ($id) {
            return '<a href="/permissions/' . $id . '/profile/' . $profiles->id . '/delete"' . 'class="badge bg-danger j_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getProfilesNotIn($permission)
    {
        return Profile::WhereNotIn('id', function ($query) use ($permission) {
            $query->select('permission_profile.profile_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.permission_id = {$permission->id}");
        })->get();
    }
}
