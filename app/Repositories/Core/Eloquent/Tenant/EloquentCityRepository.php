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
class EloquentCityRepositoryRepository extends BaseEloquentRepository
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

}
