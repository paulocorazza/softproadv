<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Process;
use App\Models\Stage;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
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
        $countStages = Stage::count();
        $countPivot = $model->stages()->count();
        return ($countPivot / $countStages) * 100;
    }



    private function saveProgresses(array $data, $process)
    {
        if (isset($data['progresses'])) {
            foreach ($data['progresses'] as $progress) {
                $id = ($progress['id'] > 0) ? $progress['id'] : 0;

                $progress['pending'] = (isset($progress['pending'])) ? true : false;

               $insert =  $process->progresses()->updateOrCreate(['id' => $id], $progress);

               if (!$insert)
                   return false;
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
                'users'
            ]);


        return Datatables()->eloquent($model)
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

            ->addColumn($column, $view)
            ->make(true);
    }


    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $data['user_id'] = auth()->user()->id;

            $process = parent::create($data);


            $progresses = $this->saveProgresses($data, $process);

            if (!$process || !$progresses) {
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


}
