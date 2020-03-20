<?php

namespace App\Repositories\Contracts;

interface SearchAddressInterface
{
    public function search($cep);
}
