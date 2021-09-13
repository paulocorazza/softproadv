<?php


namespace App\Services\Contracts;


use App\Models\Financial;

interface Boleto
{
    public function generate(Financial $financial);
}
