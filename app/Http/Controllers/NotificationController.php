<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $notifications = $request->user()
                                 ->unReadNotifications
                                 ->whereIn('type', [
                                     'App\Notifications\UserLinkedEvent',
                                     'App\Notifications\UserLinkedProcess'
                                 ]);

        return NotificationResource::collection($notifications);
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
