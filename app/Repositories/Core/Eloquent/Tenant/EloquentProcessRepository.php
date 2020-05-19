<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Process;
use App\Models\Stage;
use App\Repositories\Contracts\ProcessRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


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

}
