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

Route::get('/orderitems/order_id={order_id}', 'OrderController@orderItems');
Route::get('/orders/customer_id={customer_id}', 'CustomerController@getOrders');

Route::post('/customer/rate', 'CustomerController@rate');

Route::get('/getProductDetail/{product_id}', 'ProductController@getProductDetail');
Route::get('/farmer/farmer_id={farmer_id}', 'FarmerController@getFarmerProfile');
Route::get('/farmer/trading/farmer_id={farmer_id}', 'FarmerController@farmerOrderList');
Route::get('/farmers', 'FarmerController@farmers');


//gio hang
Route::post('cart/update-cart', 'CartProductController@updateCart');
Route::post('cart/delete-item', 'CartProductController@deleteItem');
Route::post('cart/add-item', 'CartProductController@addItem');

//payment
Route::get('payment/checkMa={ma}', 'CartProductController@checkMaGiamGia');
Route::post('payment/add', 'OrderController@addOrder');

//customer
Route::get('customer/addEmailCus={emailCus}&receiveEmailCus={receiveEmailCus}', 'CustomerController@addEmaiVister');

