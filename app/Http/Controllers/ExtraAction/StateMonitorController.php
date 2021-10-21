<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\UserStateMonitor;
use Illuminate\Http\Request;

class StateMonitorController extends Controller
{
    public function __invoke(UserStateMonitor $userStateMonitor)
    {
        return response()->json($userStateMonitor->with(['user', 'state'])->get());
    }
}
