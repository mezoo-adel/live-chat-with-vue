<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'chat','middleware'=>'auth:sanctum'], function () {
    Route::get('/', function () {
        return view('chat');
    })->name('chat');
    Route::get('/rooms', [ChatController::class, 'getRooms'])->name('rooms');
    Route::get('/room/{roomId}/messages', [ChatController::class, 'getMessages'])->name('messages');
    Route::post('/room/{roomId}/messages', [ChatController::class, 'postMessage'])->name('new_message');

});
Route::post('/broadcasting/auth', function () {
    return Auth::check() ?  ['id'=>Auth::user()->id, 'name'=>Auth::user()->name] : abort(401);
});

