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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('data')->group(function () {
    Route::get('/getCategory','DataController@getCategory');
    Route::post('/getTransactions','DataController@getTransactions');
    Route::get('/getYears','DataController@getYears');
});

Route::prefix('user')->group(function () {
    Route::get('/getUsers', 'UserController@getUser'); //get all user
    Route::post('/regis','UserController@register');
    Route::post('/login','UserController@login');
    Route::post('/logout','UserController@logout');
    Route::get('/getMailsUsers','UserController@getMailsUsers');
});
