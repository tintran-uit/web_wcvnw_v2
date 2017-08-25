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

//gio hang
Route::post('cart/update-cart', 'CartProductController@addCart');
Route::post('cart/delete-item', 'CartProductController@deleteItem');
Route::post('cart/add-item', 'CartProductController@addItem');
