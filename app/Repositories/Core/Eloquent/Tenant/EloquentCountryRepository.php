<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentCountryRepository extends BaseEloquentRepository
    implements CountryRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Country::class;
    }

}
