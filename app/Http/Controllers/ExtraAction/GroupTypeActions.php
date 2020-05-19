<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GroupActionRepositoryInterface;
use Illuminate\Http\Request;

class GroupTypeActions extends Controller
{
    public function __invoke(GroupActionRepositoryInterface $groupAction, $id)
    {
        if (request()->ajax()) {

            $return = $groupAction->getTypeActions($id);

            if (!$return['status']) {
                return  response()->json($return['message']);
            }

            return response()->json($return['data']);
        }
    }
}
