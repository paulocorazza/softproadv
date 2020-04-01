<?php
namespace App\Repositories\Core\Eloquent\Tenant;


use App\Models\GroupAction;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentGroupActionRepository extends BaseEloquentRepository
    implements GroupActionRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return GroupAction::class;
    }

}
