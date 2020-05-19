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
    /**
     * @param array $data
     * @param $user
     * @return bool
     */
    private function saveAddress(array $data, $user)
    {
        if (isset($data['address'])) {
            foreach ($data['address'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;

                $insert = $user->addresses()->updateOrCreate(['id' => $id], $item);

                if (!$insert) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }

    /**
     * @param array $data
     * @param $user
     * @return bool
     */
    private function saveContacts(array $data, $user)
    {
        if (isset($data['contacts'])) {
            foreach ($data['contacts'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;

                $insert = $user->contacts()->updateOrCreate(['id' => $id], $item);

                if (!$insert) {
                    return false;
                }
            }

            return true;
        }

        return true;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return User::class;
    }


    /**
     * @param array $data
     * @return array|mixed
     */
    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $user = parent::create($data);

            $addresses = $this->saveAddress($data, $user);
            $contacts = $this->saveContacts($data, $user);


            if (!$user || !$addresses || !$contacts) {
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

    /**
     * @param $id
     * @param array $data
     * @return array|mixed
     */
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

            $addresses = $this->saveAddress($data, $user);
            $contacts = $this->saveContacts($data, $user);

            if (!$user || !$addresses || !$contacts) {
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfiles($id)
    {
        $user = $this->relationships('profiles')->find($id);

        $profiles = $user->profiles;


        return Datatables()->collection($profiles)->addColumn('action', function ($profiles) use ($id) {
            return '<a href="/users/' . $id . '/profile/' . $profiles->id . '/delete"' . 'class="badge bg-danger j_link_delete">Deletar</a>';
        })
            ->make(true);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getProfilesNotIn($user)
    {
        return Profile::WhereNotIn('id', function ($query) use ($user) {
            $query->select('profile_user.profile_id');
            $query->from('profile_user');
            $query->whereRaw("profile_user.user_id = {$user->id}");
        })->get();
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function rules($id = '')
    {
        if (!empty($id) && isset($id)) {
            return $this->model->rulesUpdate($id);
        }

        return $this->model->rules();
    }

    public function getAdvogados()
    {
        return $this->model->Advogados()
                           ->get()
                           ->pluck('name', 'id');
    }
}
