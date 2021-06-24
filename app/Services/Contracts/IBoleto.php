<?php


namespace App\Services\Contracts;


use App\Models\Financial;

interface IBoleto
{
    public function generate(Financial $financial);
}
