<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/apis', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    $json = '{"hello": "Test API"}';
    return response($json, 200)->header('Content-Type', 'application/json');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('signup', 'Auth\AuthController@signup');    

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Auth\AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'Api\UserController@index');
    Route::get('table', 'Api\TableController@index');
    Route::get('pub', 'Api\WelcomeController@index');
});
