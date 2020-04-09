<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Phase;
use App\Repositories\Contracts\PhaseRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentPhaseRepository extends BaseEloquentRepository
    implements PhaseRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return  Phase::class;
    }

}
