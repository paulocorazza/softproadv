<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Helpers\Helper;
use App\Models\Process;
use App\Models\Stage;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentProcessRepository extends BaseEloquentRepository
    implements ProcessRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */
    private function getPercentProgress($model)
    {
        $countEvents = $model->events->count();
        $countEventsFinish = $model->events()->finish()->count();

        $countProgresses = $model->progresses->count();
        $countProgressesConcluded = $model->progresses()->concluded()->count();


        $totalProgressesEvents = $countProgresses + $countEvents;

        if ($totalProgressesEvents == 0) {
            return 0;
        }

        return  Helper::roundTo(($countProgressesConcluded + $countEventsFinish) / $totalProgressesEvents * 100);
    }


    private function saveProgresses(array $data, $process)
    {
        if (isset($data['progresses'])) {
            foreach ($data['progresses'] as $progress) {
                $id = ($progress['id'] > 0) ? $progress['id'] : 0;

                $progress['concluded'] = (isset($progress['concluded'])) ? true : false;

                $process->progresses()->updateOrCreate(['id' => $id], $progress);
            }
        }

        return true;
    }


    private function saveUsers(array $data, $process)
    {
        if (isset($data['users'])) {
            $process->users()->sync($data['users']);
        }

        return true;
    }


    private function saveFiles(array $data, $process)
    {
        $files = $data['files'];

        if ($files) {
            $filesUploaded = [];

            foreach ($files as $file) {
                if (isset($file['img']) && !empty($file['description'])) {

                    $ext = $file['img']->getClientOriginalExtension();

                    $path = $file['img']->store("files/process/{$process->id}");

                    $filesUploaded['description'] = $file['description'];
                    $filesUploaded['ext'] = $ext;
                    $filesUploaded['file'] =  isset(session('company')['uuid']) ? session('company')['uuid'] . '/' . $path : $path;

                    $insert = $process->files()->create($filesUploaded);

                    if (!$insert) {
                        throw new \Exception('Falha ao inserir o arquivo');
                    }
                }
            }
        }

        return true;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Process::class;
    }


    public function dataTables($column, $view)
    {

        $model = $this->model
            ->query()
            ->with([
                'person',
                'phase',
                'stage',
                'stages',
                'users',
            ]);


        return Datatables()
            ->eloquent($model)
            ->addColumn('listAdv', ' ')
            ->editColumn('listAdv', function ($model) {
                $users = $model->users()->get();
                return view('tenants.processes.partials.listAdv', compact('users'));
            })
            ->addColumn('progress', ' ')
            ->editColumn('progress', function ($model) {
                $percent = $this->getPercentProgress($model);
                return view('tenants.processes.partials.progress', compact('percent'));
            })

            ->editColumn('phase.name', function ($model) {
                return $model->phase->name ?? '';
            })
            ->editColumn('stage.name', function ($model) {
                return $model->stage->name ?? '';
            })
            ->addColumn($column, $view)

            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $data['user_id'] = auth()->user()->id;

            $process = parent::create($data);
            $users = $this->saveUsers($data, $process);
            $progresses = $this->saveProgresses($data, $process);
            $files = $this->saveFiles($data, $process);

            if (!$process || !$progresses || !$files || !$users) {
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
        if (!$process = parent::find($id)) {
            return [
                'status' => false,
                'message' => 'Registro não encontrado!'
            ];
        }


        DB::beginTransaction();

        try {
            $data['user_id'] = auth()->user()->id;

            $state = $this->saveStage($process, $data);

            $process->update($data);
            $users = $this->saveUsers($data, $process);
            $progresses = $this->saveProgresses($data, $process);
            $files = $this->saveFiles($data, $process);



            if (!$process || !$progresses || !$files || !$users || !$state) {
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

    private function saveStage(Process $process, array $data)
    {
        if ($this->isUpdateStage($process, $data)) {
            $process->stages()->attach([
                $process->stage_id => ['user_id' => Auth::user()->id]
            ]);
        }

        return true;
    }

    /**
     * @param Process $process
     * @param $data
     * @return bool
     */
    private function isUpdateStage(Process $process, $data): bool
    {
        return isset($process->stage_id) && !$process->stages()->find($process->stage_id) && ($process->stage_id !=  $data['stage_id'] || $data['status'] == 'Concluído');
    }

}
