<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Meet;
use App\Models\MeetUsers;
use App\Repositories\Contracts\MeetRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentMeetRepository extends BaseEloquentRepository
    implements MeetRepositoryInterface
{
    public function model()
    {
        return Meet::class;
    }

    public function dataTables($column, $view, $request = null)
    {
        $model = $this->model
            ->query()
            ->with('process', 'users');

        $model->where(function ($query) use ($request) {
            if (!empty($request->get('concluded_at'))) {
                $request->get('concluded_at') == 'Concluído' ? $query->whereNotNull('concluded_at') : $query->whereNull('concluded_at');
            }

            if (!empty($request->get('users'))) {
                $users = $request->get('users');

                $query->whereHas('users', function ($query) use ($users) {
                    $query->whereIn('users.id', $users);
                });
            }
        });

        return Datatables()
            ->eloquent($model)
            ->addColumn('listAdv', ' ')
            ->editColumn('listAdv', function ($model) {
                $users = $model->users;
                return view('tenants.processes.partials.listAdv', compact('users'));
            })
            ->editColumn('concluded_at', function ($model) {
                return $model->concluded_at ? 'Concluído' : 'Pendente';
            })
            ->addColumn($column, $view)
            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            if (!$this->createMeet($data)) {
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
        DB::beginTransaction();


        try {
            $meet = parent::find($id);

            if (!$this->updateMeet($data, $meet)) {

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
                'message' => 'Não foi possível salvar o registro. ' . $e->getMessage()
            ];
        }
    }

    /**
     * @param array $data
     * @param $meet
     * @return mixed
     */
    private function saveUsers(array $data, $meet)
    {
        if ($this->hasUsers($data)) {
            $data = $this->checkTypeUser($data);

            $this->linkUsers($data['users'], $meet);
        }
    }



    /**
     * @param array $data
     * @return bool
     */
    private function hasUsers(array $data): bool
    {
        return isset($data['users']);
    }


    /**
     * @param array $data
     * @param $meet
     * @return bool
     */
    private function updateMeet(array $data, $meet): bool
    {
        $data = $this->concluded($data);
        $meet->update($data);
        $this->saveUsers($data, $meet);

        return true;
    }


    /**
     * @param array $data
     * @return bool
     */
    private function createMeet(array $data)
    {
        $data = $this->concluded($data);

        $meet = parent::create($data);

        $this->saveUsers($data, $meet);

        return true;
    }

    /**
     * @param array $data
     * @return array
     */
    private function checkTypeUser(array $data): array
    {
        if (is_string($data['users'])) {
            $data['users'] = explode(',', $data['users']);
        }

        return $data;
    }

    /**
     * @param $users
     * @param $meet
     */
    private function linkUsers($users, $meet): void
    {
        foreach ($users as $user) {
            MeetUsers::updateOrCreate(['user_id' => $user, 'meet_id' => $meet->id],
                ['user_id' => $user, 'meet_id' => $meet->id]
            );
        }
    }

    private function isConcluded(array $data)
    {
        return isset($data['concluded_at']);
    }

    /**
     * @param array $data
     * @return array
     */
    private function concluded(array $data): array
    {
        if ($this->isConcluded($data)) {
            $data['concluded_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }

}


