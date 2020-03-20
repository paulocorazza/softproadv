<?php

namespace App\Repositories\Core\SearchAddress;
use App\Repositories\Contracts\SearchAddressInterface;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class SearchAddress
{
    private $cep;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */



    /**
     * @param SearchAddressInterface $searchAddress
     * @param $cep
     * @return mixed
     */

    public function search(SearchAddressInterface $searchAddress, $cep)
    {
        return $searchAddress->search($cep);
    }

}
