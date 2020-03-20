<?php

namespace App\Http\Controllers;

use App\Repositories\Core\SearchAddress\SearchAddress;
use App\Repositories\Core\SearchAddress\SearchViaCep;


class SearchAddressController extends Controller
{
    public function search($cep,  SearchAddress $search)
    {
       $retorno = $search->search(new SearchViaCep(), $cep);

        return $retorno;
    }
}
