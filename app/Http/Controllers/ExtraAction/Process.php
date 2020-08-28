<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PersonRepositoryInterface;
use Illuminate\Http\Request;

class Process extends Controller
{
    /**
     * @param PersonRepositoryInterface $person
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(PersonRepositoryInterface $person, Request $request)
     {
         if (request()->ajax()) {

             $return = $person->getPersonProcesses($request);

             if (!$return['status']) {
                 return  response()->json($return['message']);
             }

             return response()->json($return['data']);
         }

     }
}
