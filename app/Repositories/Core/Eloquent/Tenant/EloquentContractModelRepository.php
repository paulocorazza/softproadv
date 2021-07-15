<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\ContractModel;
use App\Repositories\Contracts\ContractModelInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentContractModelRepository extends BaseEloquentRepository
    implements ContractModelInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return ContractModel::class;
    }
}
