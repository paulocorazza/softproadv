<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CountryRepositoryInterface
{
   public function getStates($id);
   public function getCountries();

}
