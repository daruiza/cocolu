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
Route::resource('table', 'Web\TableController');
Route::resource('service', 'Web\ServiceController');
Route::resource('clousure', 'Web\ClousureController');
Route::resource('waiter', 'Web\WaiterController');

Route::post('storecitytrait', 'Web\StoreController@consultarcity');
//Route::post('storecitytrait', 'Web\HomeController@consultarcity');

Route::post('user/changepassword', [
   'as' => 'user.changepassword', 'uses' => 'Web\UserController@showResetForm'
]);
Route::post('user/passwordrequest', [
   'as' => 'user.passwordrequest', 'uses' => 'Web\UserController@resetPassword'
]);

//Route::post('changepassword', 'Web\UserController@changepassword');

Route::get('table/{id}/drag', [
   'as' => 'table.drag', 'uses' => 'Web\TableController@drag'
]);
Route::post('table/{id}/savedrag', [
   'as' => 'table.savedrag', 'uses' => 'Web\TableController@saveDrag'
]);
Route::post('table/{id}/selectservice', [
   'as' => 'table.selectservice', 'uses' => 'Web\TableController@selectService'
]);
Route::get('table/{id}/service', [
   'as' => 'table.service', 'uses' => 'Web\TableController@service'
]);
Route::post('table/{id}/saveservice', [
   'as' => 'table.saveservice', 'uses' => 'Web\TableController@saveService'
]);

