<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Origin;
use App\Repositories\Contracts\OriginRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentOriginRepository extends BaseEloquentRepository
    implements OriginRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return  Origin::class;
    }

    public function getOrigins()
    {
        return $this->model->get()->pluck('name', 'id');
    }
}
