<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\District;
use App\Repositories\Contracts\DistrictRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentDistrictRepository extends BaseEloquentRepository
    implements DistrictRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return District::class;
    }

    public function getDistricts()
    {
        return $this->model->orderBy('name')
                           ->get()
                           ->pluck('name', 'id');
    }
}
