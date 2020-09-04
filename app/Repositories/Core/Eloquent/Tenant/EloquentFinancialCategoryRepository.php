<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Contact;
use App\Models\FinancialCategory;
use App\Repositories\Contracts\FinancialCategoryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentFinancialCategoryRepository extends BaseEloquentRepository
    implements FinancialCategoryRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return FinancialCategory::class;
    }
}
