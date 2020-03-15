<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface StateRepositoryInterface
{
    public function getCitiesByName($id, Request $request);
    public function getCountries();
}
