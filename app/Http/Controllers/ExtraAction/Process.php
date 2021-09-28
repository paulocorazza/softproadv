<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Process extends Controller
{
    public function __invoke(\App\Models\Process $process, Request $request)
    {
        if (request()->ajax()) {

            $data = [];

            if ($request->has('person_id') && !empty($request->person_id)) {
                $search = $request->q;
                $person_id = $request->person_id;

                $data = $process->where(function ($query) use ($person_id, $search) {
                    $query->where('person_id', $person_id);

                    if ($search) {
                        $query->orWhere('id', $search)
                              ->orWhere('number_process', 'LIKE', "%$search%");
                    }
                })->get();
            }



            if ($request->has('searchPending')) {
                $search = $request->searchPending;

                $data = $process->with('counterPart')
                ->whereHas('person', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                        ->orWhere('cpf', 'like', "%$search%")
                        ->orWhere('cnpj', 'like', "%$search%");
                })->whereNull('number_process')
                  ->paginate();
            }

            return response()->json($data);
        }
    }
}
