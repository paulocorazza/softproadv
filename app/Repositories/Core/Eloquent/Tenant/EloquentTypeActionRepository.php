<?php
namespace App\Repositories\Core\Eloquent\Tenant;


use App\Models\GroupAction;
use App\Models\TypeAction;
use App\Repositories\Contracts\TypeActionRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentTypeActionRepository extends BaseEloquentRepository
    implements TypeActionRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return TypeAction::class;
    }


    public function dataTables($column, $view)
    {
        $model = $this->model
            ->query()
            ->with('group_action');


        return Datatables()->eloquent($model)
            ->addColumn($column, $view)
            ->make(true);
    }

    public function getGroupActions()
    {
        return GroupAction::orderBy('name', 'ASC')
                          ->get()
                          ->pluck('name', 'id');
    }
}
