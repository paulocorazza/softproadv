<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface StateRepositoryInterface
{
    public function getStates();
    public function getCities($id);
}
