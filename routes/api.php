<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::post('/login','User\LoginController@login');
Route::post('/register','User\RegisterController@register');

Route::group([ 'middleware' => 'auth:sanctum'], function()
{
    Route::apiResource('message','User\MessageController');
    Route::apiResource('friend','User\FriendController');
});