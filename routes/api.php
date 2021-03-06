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
    Route::get('pub', 'Api\WelcomeController@index');
    Route::get('table/{id}/serviceopen', 'Api\TableController@tableServiceOpen');
    Route::post('table/servicesave', 'Api\TableController@tableServiceSave');
    Route::post('table/serviceclose', 'Api\TableController@tableServiceClose');
    Route::post('order/products', 'Api\OrderController@products');
    Route::post('order/store', 'Api\OrderController@store');
    Route::post('order/index', 'Api\OrderController@index');    
    Route::post('order/statusorder', 'Api\OrderController@statusOrder');
    Route::post('order/cancelorder', 'Api\OrderController@cancelOrder');
    Route::post('order/statuspayproduct', 'Api\OrderController@statusPayProduct');
    Route::post('order/cancelproduct', 'Api\OrderController@cancelProduct');
    Route::post('order/cancelorders', 'Api\OrderController@cancelOrders');
    Route::post('order/payorders', 'Api\OrderController@payOrders');
    Route::post('closure/index', 'Api\ClosureController@index');
    Route::post('closure/open', 'Api\ClosureController@open');
    Route::post('closure/close', 'Api\ClosureController@close');
    Route::post('closure/create', 'Api\ClosureController@create');
});
