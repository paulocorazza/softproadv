<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Event;
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

    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            if (!$this->createEvent($data) ) {
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

          if (!$this->updateEvent($data, $event) ) {

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
            $event->users()->sync($data['users']);
        }
    }

    /**
     * @param array $data
     * @param $event
     * @return array
     */
    private function finish(array $data, $event): array
    {
        if (!$this->isFinish($event) && $this->hasFinish($data)) {
            return $this->setDateFinish($data);
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
        unset($data['finish']);

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    private function setDateFinish(array $data): array
    {
        $data['finish'] = date('Y-m-d H:i:s');

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
     * @return mixed
     */
    private function createEvent(array $data): mixed
    {
        $event = parent::create($data);

        $this->saveUsers($data, $event);

        return $event;
    }

}


