<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Stick;
use App\Repositories\Contracts\StickRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentStickRepository extends BaseEloquentRepository
    implements StickRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return  Stick::class;
    }

}
