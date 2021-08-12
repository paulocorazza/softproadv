<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $notifications = $request->user()->unReadNotifications;

        return response()->json(compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notification = $request->user()->notifications->where('id', $request->id)->first();

        $notification?->markAsRead();
    }

    public function markAllRead(Request $request)
    {
        $request->user()->unReadNotifications->markAsRead();
    }
}
