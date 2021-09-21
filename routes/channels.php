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

Broadcast::channel('progresses.{uuid}', function ($user, $uuid) {
    $companyUuid = session()->has('company') ? session('company')['uuid'] : '';
    return $companyUuid === $uuid;
});

