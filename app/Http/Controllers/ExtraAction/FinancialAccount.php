<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FinancialAccount extends Controller
{
    public function __invoke(\App\Models\FinancialAccount $account, Request $request)
    {
        if (request()->ajax()) {

            $data = [];

            if ($request->has('q') && !empty($request->q)) {

                $search = $request->q;

                $data = $account->where('description', 'LIKE', "%$search%")
                               ->get();
            }

            return response()->json($data);
        }
    }
}
