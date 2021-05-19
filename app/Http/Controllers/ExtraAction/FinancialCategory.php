<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialCategory extends Controller
{
    public function __invoke(\App\Models\FinancialCategory $category, Request $request)
    {
        if (request()->ajax()) {

            $data = [];

            if ($request->has('type') && !empty($request->type)) {
                $search = $request->q;
                $type = $request->type;

                $data = $category->where('type',  $type)
                                 ->where('name', 'LIKE', "%$search%")
                                 ->get();
            }

            return response()->json($data);
        }
    }
}
