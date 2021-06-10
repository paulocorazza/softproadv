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

                $type = [];

                if ($request->has('type')) {
                    $type = explode(',', $request->type);
                }

                $data = $people->where(function ($query) use ($type) {
                    if (count($type) > 0) {
                        array_map(function ($item) use ($query) {
                            $query->orWhereJsonContains('type_person', $item);
                        }, $type);
                    }
                })
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('cpf', 'LIKE', "%$search%")
                ->active()
                ->get();
            }

            return response()->json($data);
        }
    }
}
