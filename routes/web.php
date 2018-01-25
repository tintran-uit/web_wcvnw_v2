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

// Route::group(['prefix' => 'password', 'namespace' => 'Auth'], function () {
//     Route::post('email', 'ResetPasswordController');
// });

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
    CRUD::resource('product-brand', 'BrandCrudController');
    CRUD::resource('product-item', 'ProductCrudController');

    CRUD::resource('product-trading', 'TradingController@index');

    //Operation Management CRUD
    CRUD::resource('order', 'OrderCrudController');
    // CRUD::resource('order-item', 'OrderItemCrudController');
    Route::get('order-item', 'OrderItemController@index');
    Route::get('audit-item', 'AuditItemController@index');
    CRUD::resource('order-print', 'OrderPrintCrudController');
    // CRUD::resource('set-delivery-date/order-id={order_id}&date={delivery_date}', 'OrderCrudController@setDelivery');
    Route::get('order-stats/date={date}', 'StatsController@statsByDate');
    CRUD::resource('order-stats', 'StatsController@stats');
    CRUD::resource('package', 'PackageCrudController');
    Route::get('package-item', 'PackageItemController@index');
    CRUD::resource('agent-item', 'AgentCrudController');
    CRUD::resource('customer-item', 'CustomerCrudController');
    CRUD::resource('farmer-item', 'FarmerCrudController');
    CRUD::resource('farmer-farming', 'FarmingCrudController');
    CRUD::resource('farmer-trading', 'TradingCrudController');
    CRUD::resource('shipper-item', 'ShipperCrudController');

});


Route::group(['prefix' => 'farmer', 'middleware' => ['web', 'farmer'], 'namespace' => 'Farmer'], function () {
    // Backpack\MenuCRUD
    CRUD::resource('dashboard', 'PageController@dashboard');
    CRUD::resource('sell', 'PageController@sell');
    Route::post('sell-update', 'PageController@sellUpdate');
    CRUD::resource('farmer-acc-item', 'FarmerAccCrudController');
    CRUD::resource('farmer-acc-farming', 'FarmingAccCrudController');
    CRUD::resource('farmer-acc-trading', 'TradingAccCrudController');


});

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/

Route::get('language/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('s', function () {
    // Session::flush();
    $id = DB::select('SELECT id FROM products WHERE 1');
    $product_id = [];
    foreach ($id as $key) {
        array_push($product_id, $key->id);
    }
    $product_id = implode(',', $product_id);
    // return $product_id;
    $total = DB::select('SELECT * FROM m_orders WHERE `order_id`>1000176 AND `order_id`<1000202 AND `product_id` IN ('.$product_id.') ');
    $price = 0;
    foreach ($total as $key) {
        $price += $key->price;
    }
    return $price;
});

Route::get('admin/set-delivery-date/order-id={order_id}&date={delivery_date}', 'OrderController@moveOrder');

Route::get('/kinh-nghiem-mua-thuc-pham-sach/post_id={post_id}', 'PageController@getPost');

Route::get('/kinh-nghiem-mua-thuc-pham-sach/blog_id={blog_id}', 'PageController@showBlog');

Route::get('/nong-trai-sach/farmer_id={farmer_id}', 'PageController@showFarmer');

Route::get('/', 'PageController@index');

Route::get('/product/slug={slug}', 'PageController@getProduct');

Route::get('/add', 'PageController@testcart');

Route::get('/user/edit', 'CustomerController@editProfile');
Route::get('/user/rate', 'CustomerController@getRate');
Route::get('/user/account', 'CustomerController@getAccount');
Route::get('/layhang/{id}', 'CustomerController@layhang2');

Route::get('{page}/{subs?}', ['uses' => 'PageController@page'])
    ->where(['page' => '^((?!admin).)*$', 'subs' => '.*']);





Route::get('/home', 'HomeController@index');

Route::get('/home', 'HomeController@index');
