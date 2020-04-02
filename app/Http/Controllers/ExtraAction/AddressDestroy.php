<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AddressRepositoryInterface;
use Illuminate\Http\Request;

class AddressDestroy extends Controller
{
    public function __invoke(AddressRepositoryInterface $address, Request $request)
    {
        if (request()->ajax()) {
            $id = request()->get('id');

            if  ($delete =  $address->delete($id)) {
                return response()->json(['result' => true]);
            }
        }
    }
}
