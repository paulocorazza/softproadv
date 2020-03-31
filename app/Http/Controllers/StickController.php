<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StickRepositoryInterface;

class StickController extends ControllerStandard
{
    public function __construct(StickRepositoryInterface $stick)
    {
        $this->model = $stick;
        $this->title = 'Vara';
        $this->view = 'tenants.sticks';
        $this->route = 'sticks';

        $this->middleware('can:sticks');

        $this->middleware('can:create_stick')->only(['create', 'store']);
        $this->middleware('can:update_stick')->only(['edit', 'update']);
        $this->middleware('can:view_stick')->only(['show']);
        $this->middleware('can:delete_stick')->only(['delete']);
    }
}
