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

Broadcast::channel('chat-app', function ($user) {
    $token = DB::table('personal_access_tokens')->where('tokenable_id',$user->id)->get('token')->first()->token ;
    return Auth::check() ? ['id' => $user->id, 'name' => $user->name, 'email'=> $user->email, 'auth'=>"Bearer ".$token] : false;
});
