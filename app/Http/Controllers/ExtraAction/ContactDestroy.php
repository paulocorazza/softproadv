<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactDestroy extends Controller
{
    public function __invoke(ContactRepositoryInterface $contact, Request $request)
    {
        if (request()->ajax()) {
            $id = request()->get('id');

            if  ($delete =  $contact->delete($id)) {
                return response()->json(['result' => true]);
            }
        }
    }
}
