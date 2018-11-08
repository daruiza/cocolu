<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('locale', 'HomeController@postLocale')->name('locale');
Route::resource('rol', 'Web\RolController');
Route::resource('user', 'Web\UserController');
Route::resource('module', 'Web\ModuleController');
Route::resource('store', 'Web\StoreController');
Route::post('storecity', 'Web\StoreController@postConsultarcity');
Route::post('storecitytrait', 'Web\StoreController@consultarcity');

