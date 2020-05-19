<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentCityRepository extends BaseEloquentRepository
    implements CityRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return City::class;
    }

    public function dataTables($column, $view)
    {
        $model = $this->model
            ->query()
            ->with('state');


        return Datatables()->eloquent($model)
            ->addColumn($column, $view)
            ->make(true);
    }
}
