<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends ControllerStandard
{
    public function __construct(CityRepositoryInterface $city)
    {
        $this->model = $city;
        $this->title = 'Cidade';
        $this->view = 'tenants.cities';
        $this->route = 'cities';

        $this->middleware('can:cities');

        $this->middleware('can:create_cities')->only(['create', 'store']);
        $this->middleware('can:update_cities')->only(['edit', 'update']);
        $this->middleware('can:view_cities')->only(['show']);
        $this->middleware('can:delete_cities')->only(['delete']);
    }
}
