<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class People extends Controller
{
    public function __invoke(Person $people, Request $request)
    {
        if (request()->ajax()) {

            $data = [];

            if ($request->has('q') && !empty($request->q)) {

                $search = $request->q;

                $id = (isset($request->id) && !empty($request->id)) ? $request->id : 0;

                $data = $people->Where('id', '<>',  $id)
                               ->StateActive()
                               ->Where('name', 'LIKE', "%$search%")
                               ->orWhere('cpf', 'LIKE', "%$search%")
                               ->get();
            }

            return response()->json($data);
        }
    }
}
