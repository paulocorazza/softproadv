<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepositoryInterface;

class DistrictController extends ControllerStandard
{
    public function __construct(DistrictRepositoryInterface $district)
    {
        $this->model = $district;
        $this->title = 'Comarca';
        $this->view = 'tenants.districts';
        $this->route = 'districts';

        $this->middleware('can:districts');

        $this->middleware('can:create_district')->only(['create', 'store']);
        $this->middleware('can:update_district')->only(['edit', 'update']);
        $this->middleware('can:view_district')->only(['show']);
        $this->middleware('can:delete_district')->only(['delete']);
    }
}
