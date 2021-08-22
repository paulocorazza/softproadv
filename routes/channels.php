<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notification-created.{id}', function ($user, $uuid) {
    return $user->uuid === $uuid;
});

Broadcast::channel('chat.{id}', function ($user, $uuid) {
    if (session()->has('company')) {
        return session('company')['uuid'] === $uuid;
    }

    return auth()->check();

});
