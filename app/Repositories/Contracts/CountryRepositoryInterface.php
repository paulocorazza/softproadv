<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface CountryRepositoryInterface
{
   public function getStatesByName($id, Request $request);
}
