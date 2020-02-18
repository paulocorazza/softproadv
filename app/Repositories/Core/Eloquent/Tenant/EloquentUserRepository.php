<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;

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
    private function saveAddress(array $data, $user)
    {

        if (isset($data['address'])) {
            foreach ($data['address'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;

                /* $address['type_address_id'] = $item['type_address_id'];
                $address['street'] = $item['street'];
                $address['number'] = $item['number'];
                $address['district'] = $item['district'];
                $address['complement'] = $item['complement'];
                $address['cep'] = $item['cep'];
                $address['country_id'] = $item['country_id'];
                $address['state_id'] = $item['state_id'];
                $address['city_id'] = $item['city_id'];*/


                $user->addresses()->updateOrCreate(['id' => $id], $item);
            }

            return true;
        }

        return false;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return User::class;
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $user = parent::create($data);

            $addresses = $this->saveAddress($data, $user);

            if (!$user || !$addresses) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível salvar o registro'
                ];
            }

            DB::commit();

            return ['status' => true];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível salvar o registro.' . $e->getMessage()
            ];
        }
    }


    public function update($id, array $data)
    {
        if (!$user = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }

        DB::beginTransaction();
        try {
            $user->update($data);

            $description = $this->saveAddress($data, $user);

            if (!$user || !$description) {
                DB::rollBack();

                return [
                    'status' => false,
                    'message' => 'Não foi possível atualizar o registro'
                ];
            }


            DB::commit();

            return ['status' => true];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Não foi possível atualizar o registro.' . $e->getMessage()
            ];
        }

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
