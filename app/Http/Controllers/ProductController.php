<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;


class ProductController extends Controller
{

	// Create the function, so you can use it
	function isMobile() {
    	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
		// // If the user is on a mobile device, redirect them
		// if(isMobile()){
		//     header("Location: http://m.yoursite.com/");
		// }    
	/**
	 *getProducts
	 *
	 * Retrieve all available products in system into different categories
	 * @param No
	 * @return array of products in its categories 
	 */
    public function getProducts()
	{
		$categories = DB::select('SELECT `id`, `name` FROM `categories` ORDER BY `id` ASC');
		foreach($categories as $cat)
		{
		 	$products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = tr.`farmer_id` AND p.`category` = ? ORDER BY tr.`priority` ASC', [$cat->id]);

		 	// $products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", p.`unit` "unit"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = tr.`farmer_id` AND tr.`status` = 1 AND p.`category` = ? ', [$cat->id]);
		}
	        return $products_list;
	}

	public function getPackages()
	{
		$packages = DB::select('SELECT `id`, `name` FROM `products` WHERE `category` = 0');
		return $packages;
	}

	/**
	 *getProductDetail
	 *
	 * Retrieve all available products in system into different categories
	 * @param No
	 * @return array of products in its categories 
	 */
    public function getProductDetail($product_id)
	{
		$product_detail = DB::select('SELECT f.`id` "id", f.`name` "name", f.`rating` "rating", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` "unit" FROM `farmers` f, `trading` tr, `products` p WHERE p.`id` = tr.`product_id` AND tr.`product_id` = ? AND tr.`farmer_id` = f.`id` ', [$product_id]);

		return $product_detail;
	}

	/**
	 *getSuppliers
	 *
	 * Retrieve all available products in system into different categories
	 * @param No
	 * @return array of products in its categories 
	 */
    public function getSuppliers($product_id)
	{
		$product_detail = DB::select('SELECT f.`id` "id", f.`name` "name", ROUND(f.`rating`/100, 2)  "rating", tr.`capacity`, IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` FROM `farmers` f, `trading` tr, `products` p WHERE p.`id` = tr.`product_id` AND tr.`product_id` = ? AND tr.`farmer_id` = f.`id`', [$product_id]);

		return $product_detail;
	}

	public function addInterest($id)
	{
		return response()->json([
		            'status' => 'Vui lòng Đăng nhập để sử dụng tính năng!',
		            'error' => '1',
		        ]);
		if(Auth::check()){

			return response()->json([
		            'status' => 'Cảm ơn bạn đã quan tâm sản phẩm.',
		            'error' => '0',
		        ]);
		}else{
			return response()->json([
		            'status' => 'Vui lòng Đăng nhập để sử dụng tính năng!',
		            'error' => '1',
		        ]);
		}
	}
}