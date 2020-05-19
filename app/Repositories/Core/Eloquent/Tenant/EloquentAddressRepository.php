<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Address;
use App\Repositories\Contracts\AddressRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentAddressRepository extends BaseEloquentRepository
    implements AddressRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Address::class;
    }
}
