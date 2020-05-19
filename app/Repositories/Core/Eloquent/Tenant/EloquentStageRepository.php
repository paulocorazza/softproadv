<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Stage;
use App\Repositories\Contracts\StageRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentStageRepository extends BaseEloquentRepository
    implements StageRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Stage::class;
    }

    public function dataTables($column, $view)
    {
        $model = $this->model
            ->query()
            ->with('phase');


        return Datatables()->eloquent($model)
            ->addColumn($column, $view)
            ->make(true);
    }
}
