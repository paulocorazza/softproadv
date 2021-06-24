<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\City;
use App\Models\Profile;
use App\Models\State;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Arr;
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

        if (isset($data['addresses'])) {
            foreach ($data['addresses'] as $item) {

                $id = ($item['id'] > 0) ? $item['id'] : 0;
                $item['state_id'] = State::where('iso', $item['iso'])->first()->id;
                $item['city_id'] = City::where('iso', $item['city_iso'])->first()->id;

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


    /**
     * @param array $data
     * @param $user
     * @return bool
     */
    private function saveUsers(array $data, $user)
    {
         if (isset($data['userViews'])) {

           foreach ($data['userViews'] as $userView)
            $user->userViews()->updateOrCreate(['user_id_view' => $userView], [
                'user_id' => $user->id,
                'user_id_view' => $userView
            ]);
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

    public function dataTables($column, $view)
    {

        $model = $this->model->query();

        return Datatables()
            ->eloquent($model->nivel1())
            ->addColumn($column, $view)
            ->make(true);
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
            $users = $this->saveUsers($data, $user);


            if (!$user || !$addresses || !$contacts || !$users) {
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
            $users = $this->saveUsers($data, $user);

            if (!$user || !$addresses || !$contacts || !$users) {
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

    public function rulesProfile($id = '')
    {
        if (!empty($id) && isset($id)) {
            return $this->model->rulesProfile($id);
        }

        return $this->model->rules();
    }


    public function getAdvogados()
    {
        return $this->model->advogados()
                           ->nivel1()
                           ->get()
                           ->pluck('name', 'id');
    }

    public function getUsersView($id)
    {
        $user = $this->relationships('userViews.userView')->find($id);

        $user_views = $user->userViews()->get()->pluck('userView.name', 'userView.id');

        $user_views = Arr::add($user_views, $user->id, $user->name);

        return $user_views;
    }

    public function getUsersViewNotIn($id)
    {
        return $this->model->where('id', '<>', $id)
                           ->get()
                           ->pluck('name', 'id');
    }
}
