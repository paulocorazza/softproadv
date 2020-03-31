<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OriginRepositoryInterface;

class OriginController extends ControllerStandard
{
    public function __construct(OriginRepositoryInterface $origin)
    {
        $this->model = $origin;
        $this->title = 'Origem';
        $this->view = 'tenants.origins';
        $this->route = 'origins';

        $this->middleware('can:origins');

        $this->middleware('can:create_origin')->only(['create', 'store']);
        $this->middleware('can:update_origin')->only(['edit', 'update']);
        $this->middleware('can:view_origin')->only(['show']);
        $this->middleware('can:delete_origin')->only(['delete']);
    }
}
