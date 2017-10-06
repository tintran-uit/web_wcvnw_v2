<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin'], 'namespace' => 'Admin'], function () {
    // Backpack\MenuCRUD
    CRUD::resource('menu-item', 'MenuItemCrudController');
    // Backpack\NewsCRUD (Refactored)
    CRUD::resource('article', 'ArticleCrudController');
    CRUD::resource('article-category', 'ArticleCategoryCrudController');
    CRUD::resource('article-tag', 'ArticleTagCrudController');
    //Products CRUD (Category, Brand, Product)
    CRUD::resource('product-category', 'ProductCategoryCrudController');
    CRUD::resource('product-item', 'ProductCrudController');
    CRUD::resource('product-brand', 'BrandCrudController');

    //Operation Management CRUD
    CRUD::resource('order', 'OrderCrudController');
    CRUD::resource('order-item', 'OrderItemCrudController');
    CRUD::resource('agent-item', 'AgentCrudController');
    CRUD::resource('customer-item', 'CustomerCrudController');
    CRUD::resource('farmer-item', 'FarmerCrudController');
    CRUD::resource('farmer-farming', 'FarmingCrudController');
    CRUD::resource('farmer-trading', 'TradingCrudController');
    CRUD::resource('shipper-item', 'ShipperCrudController');

});


Route::group(['prefix' => 'farmer', 'middleware' => ['web', 'farmer'], 'namespace' => 'Farmer'], function () {
    // Backpack\MenuCRUD
    CRUD::resource('farmer-acc-item', 'FarmerAccCrudController');
    CRUD::resource('farmer-acc-farming', 'FarmingAccCrudController');
    CRUD::resource('farmer-acc-trading', 'TradingAccCrudController');


});

// Route::get('/admin/order-item/additem/{order_id}', 'Admin\OrderCrudController@additem');
/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/

Route::get('language/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/kinh-nghiem-mua-thuc-pham-sach/post_id={post_id}', 'PageController@getPost');

Route::get('/kinh-nghiem-mua-thuc-pham-sach/blog_id={blog_id}', 'PageController@showBlog');

Route::get('/', 'PageController@index');

Route::get('/product/slug={slug}', 'PageController@getProduct');

Route::get('/add', 'PageController@testcart');

Route::get('{page}/{subs?}', ['uses' => 'PageController@page'])
    ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);





Route::get('/home', 'HomeController@index');
