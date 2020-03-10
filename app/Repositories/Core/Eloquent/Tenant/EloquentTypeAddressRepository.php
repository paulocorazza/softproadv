<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\TypeAddress;
use App\Repositories\Contracts\TypeAddressRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentTypeAddressRepository extends BaseEloquentRepository
    implements TypeAddressRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return TypeAddress::class;
    }

}
