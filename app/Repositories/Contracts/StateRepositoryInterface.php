<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface StateRepositoryInterface
{
    public function getCities($id);
    public function getCountries();
}
