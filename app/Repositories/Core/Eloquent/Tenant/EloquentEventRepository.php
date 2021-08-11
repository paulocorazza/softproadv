<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Event;
use App\Models\EventUsers;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\DB;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentEventRepository extends BaseEloquentRepository
    implements EventRepositoryInterface
{
    public function model()
    {
        return Event::class;
    }

    public function dataTables($column, $view, $request = null)
    {
        $model = $this->model
            ->query()
            ->with('process', 'users');

        $model->where(function ($query) use ($request) {
            if (!empty($request->get('status'))) {
                $request->get('status') == 'Finalizado' ? $query->whereNotNull('finish') : $query->whereNull('finish');
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
            ->editColumn('start', function ($model) {
                return $model->start_br;
            })
            ->editColumn('end', function ($model) {
                return $model->end_br;
            })
            ->editColumn('finish', function ($model) {
                return $model->finish ? 'Finalizado' : 'Aberto';
            })
            ->addColumn($column, $view)
            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            if (!$this->createEvent($data)) {
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
            $event = parent::find($id);

            if (!$this->updateEvent($data, $event)) {

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
     * @param $event
     * @return mixed
     */
    private function saveUsers(array $data, $event)
    {
        if ($this->hasUsers($data)) {
            $data = $this->checkTypeUser($data);

            $this->linkUsersEvent($data['users'], $event);
        }
    }

    /**
     * @param array $data
     * @param $event
     * @return array
     */
    private function finish(array $data, $event): array
    {
        if ($this->hasFinish($data)) {
            return $this->setDateFinish($event, $data);
        }

        return $this->unsetFinish($data);
    }

    /**
     * @param $event
     * @return bool
     */
    private function isFinish($event): bool
    {
        return !empty($event->finish);
    }

    /**
     * @param array $data
     * @return bool
     */
    private function hasFinish(array $data): bool
    {
        return isset($data['finish']);
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
     * @return array
     */
    private function unsetFinish(array $data): array
    {
        $data['finish'] = null;

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function setDateFinish($event, array $data): array
    {
        if (!$this->isFinish($event)) {
            $data['finish'] = date('Y-m-d H:i:s');

            return $data;
        }

        unset($data['finish']);

        return $data;
    }

    /**
     * @param array $data
     * @param $event
     * @return bool
     */
    private function updateEvent(array $data, $event): bool
    {
        $data = $this->finish($data, $event);
        $event->update($data);
        $this->saveUsers($data, $event);

        return true;
    }


    /**
     * @param array $data
     * @return bool
     */
    private function createEvent(array $data)
    {
        if ($this->hasFinish($data)) {
            $data['finish'] = date('Y-m-d H:i:s');
        }

        $event = parent::create($data);

        $this->saveUsers($data, $event);

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
     * @param $event
     */
    private function linkUsersEvent($users, $event): void
    {
        foreach ($users as $user) {
            EventUsers::updateOrCreate(['user_id' => $user, 'event_id' => $event->id],
                ['user_id' => $user, 'event_id' => $event->id]
            );
        }
    }

}


