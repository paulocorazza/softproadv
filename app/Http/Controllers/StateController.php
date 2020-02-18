<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\StateRepositoryInterface;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(StateRepositoryInterface $state)
    {
        $this->model = $state;
        $this->title = 'Estado';
        $this->view = 'tenants.states';
        $this->route = 'states';

        $this->middleware('can:states');

        $this->middleware('can:create_states')->only(['create', 'store']);
        $this->middleware('can:update_states')->only(['edit', 'update']);
        $this->middleware('can:view_states')->only(['show']);
        $this->middleware('can:delete_states')->only(['delete']);
    }

    public function cities($id, Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;

            $state = $this->model->relationships([
                'cities' => function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                }
            ])->find($id);

            $data = $state->cities;
        }

        return response()->json($data);


    }
}
