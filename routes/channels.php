<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
//channel name must be as Event without any prefix
Broadcast::channel('chat-app', function ($user) {
    return Auth::check() ? ['id' => $user->id, 'name' => $user->name, 'email'=> $user->email] : abort(401);
});

