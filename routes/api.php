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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/products', 'ProductController@getproducts');
Route::get('/packages', 'ProductController@getPackages');
Route::get('/products/suppliers/product_id={product_id}', 'ProductController@getSuppliers');
Route::get('/products/interest/product_id={product_id}', 'ProductController@addInterest');

Route::get('/cancelorder/order_id={order_id}', 'OrderController@cancelOrder');
Route::get('/moveorder/order_id={order_id}/week_num={week_num}', 'OrderController@moveOrder');
Route::get('/orderitems/order_id={order_id}', 'OrderController@orderItems');
Route::get('/orders', 'CustomerController@getOrders');
Route::get('/orderstats/date={date}', 'OrderController@itemStats');
Route::get('/orderrm/order_id={order_id}/product_id={product_id}/farmer_id={farmer_id}', 'OrderController@removeItemAdmin');

Route::post('/customer/rate', 'CustomerController@rating');

Route::get('/getProductDetail/{product_id}', 'ProductController@getProductDetail');
Route::get('/farmer/farmer_id={farmer_id}', 'FarmerController@getFarmerProfile');
Route::get('/farmer/trading/farmer_id={farmer_id}', 'FarmerController@farmerOrderList');
Route::get('/farmers', 'FarmerController@farmers');

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
	Route::get('product-trading/items', 'TradingController@getItems');
	Route::post('product-trading/items', 'TradingController@editItem');
});
	Route::post('admin/update-cart', 'OrderController@addItemAdmin');


//gio hang
Route::post('cart/update-cart', 'CartProductController@updateCart');
Route::post('cart/delete-item', 'CartProductController@deleteItem');
Route::post('cart/add-item', 'CartProductController@addItem');

//payment
Route::get('payment/checkMa={ma}', 'CartProductController@checkMaGiamGia');
Route::post('payment/add', 'OrderController@addOrder');

//customer
Route::get('customer/addEmailCus={emailCus}&receiveEmailCus={receiveEmailCus}', 'CustomerController@addEmaiVister');

