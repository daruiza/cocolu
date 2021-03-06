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

Route::get('invoice/purchaseorder', [
   'as' => 'product.purchaseorder', 'uses' => 'Web\InvoiceController@purchaseOrder'
]);

Route::get('invoice/purchase', [
   'as' => 'invoice.purchase', 'uses' => 'Web\InvoiceController@purchaseOrder'
]);

Route::get('/', 'HomeController@index')->name('home');
Route::post('locale',      'HomeController@postLocale')->name('locale');
Route::resource('rol',     'Web\RolController');
Route::resource('user',    'Web\UserController');
Route::resource('module',  'Web\ModuleController');
Route::resource('store',   'Web\StoreController');
Route::resource('category','Web\CategoryController');
Route::resource('product', 'Web\ProductController');
Route::resource('table',   'Web\TableController');
Route::resource('service', 'Web\ServiceController');
Route::resource('clousure','Web\ClousureController');
Route::resource('waiter',  'Web\WaiterController');
Route::resource('procuct', 'Web\ProductController');
Route::resource('order',   'Web\OrderController');
Route::resource('expense', 'Web\ExpenseController');
Route::resource('invoice', 'Web\InvoiceController');
Route::resource('provider','Web\ProviderController');
Route::resource('message', 'Web\MessageController');

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
Route::post('table/{id}/closeservice', [
   'as' => 'table.closeservice', 'uses' => 'Web\TableController@closeService'
]);
Route::post('waiter/changepassword', [
   'as' => 'waiter.changepassword', 'uses' => 'Web\WaiterController@showResetForm'
]);
Route::post('waiter/passwordrequest', [
   'as' => 'waiter.passwordrequest', 'uses' => 'Web\WaiterController@resetPassword'
]);
Route::get('product/{id}/editstock', [
   'as' => 'product.editstock', 'uses' => 'Web\ProductController@editStock'
]);
Route::post('product/{id}/addproduct', [
   'as' => 'product.addproduct', 'uses' => 'Web\ProductController@addProduct'
]);
Route::post('product/{id}/savestock', [
   'as' => 'product.savestock', 'uses' => 'Web\ProductController@saveStock'
]);
Route::post('table/{id}/saveorder', [
   'as' => 'table.saveorder', 'uses' => 'Web\TableController@saveOrder'
]);
Route::get('table/{id}/qrcode', [
   'as' => 'table.qrcode', 'uses' => 'Web\TableController@qrcode'
]);
Route::get('clousure/{id}/showclousures', [
   'as' => 'clousure.showclousures', 'uses' => 'Web\ClousureController@showClousures'
]);
Route::post('clousure/{id}/consultclousure', [
   'as' => 'clousure.consultclousure', 'uses' => 'Web\ClousureController@consultClousure'
])->middleware('auth');
Route::get('clousure/{id}/toexcel', [
   'as' => 'clousure.toexcel', 'uses' => 'Web\ClousureController@toExcel'
])->middleware('auth');
Route::post('provider/consultprovider', [
   'as' => 'provider.consultprovider', 'uses' => 'Web\ProviderController@consultProvider'
]);
Route::post('order/order_paid', [
   'as' => 'order.order_paid', 'uses' => 'Web\OrderController@orderPaid'
]);
/*
Route::post('order/order_print', [
   'as' => 'order.order_print', 'uses' => 'Web\OrderController@orderPrint'
]);
*/
Route::post('message/requeststore', [
   'as' => 'message.requeststore', 'uses' => 'Web\MessageController@requestStore'
]);
Route::get('message/{id_store}/{id_table}/request', [
   'as' => 'message.request', 'uses' => 'Web\MessageController@request'
]);
Route::get('message/{id_store}/letter', [
   'as' => 'message.letter', 'uses' => 'Web\MessageController@letter'
]);

Route::get('/{store}', [
   'as' => 'store.index', 'uses' => 'Web\StoreController@index'
]);
