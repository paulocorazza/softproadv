<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentUserRepository extends BaseEloquentRepository
                             implements UserRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return User::class;
    }


    public function getProfiles($id)
    {
        $user = $this->relationships('profiles')->find($id);

        $profiles = $user->profiles;


        return Datatables()->collection($profiles)->addColumn('action', function ($profiles) use ($id) {
            return '<a href="/users/' . $id . '/profile/' . $profiles->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    public function getProfilesNotIn($user)
    {
        return Profile::WhereNotIn('id', function ($query) use ($user) {
            $query->select('profile_user.profile_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.user_id = {$user->id}");
        })->get();
    }

    public function rules($id = '')
    {
        if (!empty($id) && isset($id)) {
            return $this->model->rulesUpdate($id);
        }

        return $this->model->rules();
    }
}
