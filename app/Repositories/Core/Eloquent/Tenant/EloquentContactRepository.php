<?php
namespace App\Repositories\Core\Eloquent\Tenant;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentContactRepository extends BaseEloquentRepository
    implements ContactRepositoryInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function model()
    {
        return Contact::class;
    }
}
