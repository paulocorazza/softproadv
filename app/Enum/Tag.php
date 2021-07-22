<?php


namespace App\Enum;


class Tag
{
    public static function Tags()
    {
        return [
            'name' => 'Nome do Cliente',
            'cpf' => 'CPF do Cliente',
            'cnpj' => 'CNPJ do Cliente',
            'rg' => 'RG do Cliente',
            'street' => 'Endereço do Cliente',
            'number' => 'Número do Cliente',
            'district' => 'Bairro do Cliente',
            'complement' => 'Complemento do Cliente',
            'city' => 'Cidade do Cliente',
            'letter' => 'UF do Cliente',
            'country' => 'País do Cliente',
            'counterPart' => 'Nome da Parte Contrária',
            'forum' => 'Fórum',
            'vara' => 'Vara',
            'comarca' => 'Comarca',
            'number_process' => 'Número do Processo',
            'protocol' => 'Número do Protocolo',
            'folder' => 'Número da Pasta',
            'date_request' => 'Data do Requerimento',
            'expectancy' => 'Expectativa / Valor da causa',
            'price' => 'Valor dos honorários',
            'percent_fees' => 'Honorários %',
            'advs' => 'Advogados',
            'advs-oab' => 'Advogados/OAB'
        ];
    }
}
