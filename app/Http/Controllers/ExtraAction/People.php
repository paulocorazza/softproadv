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

                $type =  explode(',', $request->type);

                $data = $people->whereJsonContains('type_person', $type )
                               ->where('name', 'LIKE', "%$search%")
                               ->orWhere('cpf', 'LIKE', "%$search%")
                               ->active()
                               ->get();
            }

            return response()->json($data);
        }
    }
}
