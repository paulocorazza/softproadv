<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\FinancialAccount;
use App\Models\FinancialCategory;
use App\Repositories\Contracts\FinancialAccountRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentFinancialAccountRepository extends BaseEloquentRepository
    implements FinancialAccountRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return FinancialAccount::class;
    }
}
