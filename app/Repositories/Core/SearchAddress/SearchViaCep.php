<?php

namespace App\Repositories\Core\SearchAddress;

use App\Repositories\Contracts\SearchAddressInterface;
use Canducci\Cep\Facades\Cep;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class SearchViaCep implements SearchAddressInterface
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
    public function search($cep)
    {

        $cepResponse = Cep::find($cep);

        if (!$cepResponse->isOk()) {
            return [
                'result' => false,
                'message' => 'Falha ao consultar endereço'];
        }

        $data = $cepResponse->getCepModel();

        return [
            'result' => true,
            'data' => response()->json($data),
        ];
    }
}
