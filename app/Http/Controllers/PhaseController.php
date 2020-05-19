<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PhaseRepositoryInterface;

class PhaseController extends ControllerStandard
{
    public function __construct(PhaseRepositoryInterface $phase)
    {
        $this->model = $phase;
        $this->title = 'Fase';
        $this->view = 'tenants.phases';
        $this->route = 'phases';

        $this->middleware('can:phases');

        $this->middleware('can:create_phase')->only(['create', 'store']);
        $this->middleware('can:update_phase')->only(['edit', 'update']);
        $this->middleware('can:view_phase')->only(['show']);
        $this->middleware('can:delete_phase')->only(['delete']);
    }

    public function stagesSelect($id)
    {
        if (request()->ajax()) {

            $return = $this->model->getStagesSelect($id);

            if (!$return['status']) {
                return  response()->json($return['message']);
            }

            return response()->json($return['data']);
        }
    }
}
