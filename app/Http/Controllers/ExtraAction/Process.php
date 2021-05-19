<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Process extends Controller
{
    public function __invoke(\App\Models\Process $people, Request $request)
    {
        if (request()->ajax()) {

            $data = [];

            if ($request->has('person_id') && !empty($request->person_id)) {

                $search = $request->q;
                $person_id = $request->person_id;

                $data = $people->Where('person_id',  $person_id)
                               ->orWhere('id', $search)
                               ->orWhere('number_process', 'LIKE', "%$search%")
                               ->get();
            }

            return response()->json($data);
        }
    }
}
