<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Advogados extends Controller
{
    public function __invoke(User $users)
    {
        $data = $users::select('id', 'name')
                      ->advogados()
                      ->nivel1()
                      ->get();

        return response()->json($data);
    }
}
