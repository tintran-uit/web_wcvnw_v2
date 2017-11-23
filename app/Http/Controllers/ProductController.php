<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;
use App;


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
		$locale = 'vi';
		if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

		if (strcmp($locale, 'en') == 0) {
			$categories = DB::select('SELECT `id`, `en_name` as "name" FROM `categories` ORDER BY `id` ASC');
			foreach($categories as $cat)
			{
			 	$products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`en_name` "farmer_name", 
			 													 p.`id` "id" ,p.`en_name` "name", p.`slug` "slug", p.`price_old` "price_old" ,p.`image` "image", p.`thumbnail` "thumbnail", tr.`price` "price", tr.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - tr.`unit_quantity` < 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", p.`en_unit` "unit", p.`brand_id` "label"  
			 												FROM `products` p, `trading` tr, `farmers` f 
			 											   WHERE tr.`product_id` = p.`id` 
			 											     AND tr.`status` = 1 
			 											     AND f.`id` = tr.`farmer_id` 
			 											     AND p.`category` = ? 
			 											ORDER BY tr.`priority` ASC', [$cat->id]);
			}		    
		}
		else {
			$categories = DB::select('SELECT `id`, `name` FROM `categories` ORDER BY `id` ASC');
			foreach($categories as $cat)
			{
			 	$products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", 
			 													 p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`price_old` "price_old" ,p.`image` "image", p.`thumbnail` "thumbnail", tr.`price` "price", tr.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - tr.`unit_quantity` < 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", p.`unit` "unit", p.`brand_id` "label"  
			 											 	FROM `products` p, `trading` tr, `farmers` f 
			 											   WHERE tr.`product_id` = p.`id` 
			 											     AND tr.`status` = 1 
			 											     AND f.`id` = tr.`farmer_id` 
			 											     AND p.`category` = ? 
			 											ORDER BY tr.`priority` ASC', [$cat->id]
			   );
			}
		}
	    return $products_list;
	}

	public function getPackages()
	{
		$packages = DB::select('SELECT `id`, `name` FROM `products` WHERE `category` = 0');
		return $packages;
	}

	public function setupPackages()
	{
		$packages = DB::select('SELECT `id`, `name` FROM `products` WHERE `category` = 0');
		return $packages;
	}

	public function setupTrading(Request $request)
    {
        if(Auth::check() && strcmp(Auth::user()->account_type, "Admin") == 0){
            $data = $request->data;
            $order_id = $data["order_id"];

            $m_orders = $data["ItemsUpload"];
			$date = "2017-11-18";
			$packages = DB::select('SELECT f.`name` "farmer_name", p.`name` "product_name", ROUND(tr.`capacity`, 2) "capacity"
										  , ROUND(p.`unit_quantity`, 2) "unit_quantity", p.`unit` "unit", p.`price` "price", tr.`price_farmer` "price_farmer", tr.`delivery_date` "delivery_date", p.`category` "category", 1 as "status"
									  FROM `trading` tr, `products` p, `farmers` f
									 WHERE `delivery_date`= ?
									   AND tr.`product_id` = p.`id` 
									   AND tr.`farmer_id` = f.`id` 
									UNION 
									  SELECT f.`name` "farmer_name", p.`name` "product_name", 0 AS "capacity", 
									  		 0.3 AS "unit_quantity", "kg" AS "unit", p.`price` "price", 0 "price_farmer",
									  		  ? AS "delivery_date", p.`category` "category", 0 AS "status"
									  FROM `products` p, `farmers` f
									 WHERE f.`id` = p.`farmer_id`
									   AND p.`id` NOT IN (SELECT `product_id` FROM `trading` WHERE `delivery_date`=?) 
									 ORDER BY `category` ', 
									[$date, $date, $date]);
			return $packages;
		}
		else {
			return  redirect()->back();
		}
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

		$locale = 'vi';
		if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

		if (strcmp($locale, 'en') == 0) {
			$product_detail = DB::select('SELECT f.`id` "id", f.`en_name` "name", f.`rating` "rating", 
												 IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` "unit" 
										    FROM `farmers` f, `trading` tr, `products` p 
										   WHERE p.`id` = tr.`product_id` 
										     AND tr.`product_id` = ? 
										     AND tr.`farmer_id` = f.`id` 
										     AND tr.`status` = 1 ', [$product_id]);		}
		else {
			$product_detail = DB::select('SELECT f.`id` "id", f.`name` "name", f.`rating` "rating", 
												 IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` "unit" 
										    FROM `farmers` f, `trading` tr, `products` p 
										   WHERE p.`id` = tr.`product_id` 
										     AND tr.`product_id` = ? 
										     AND tr.`farmer_id` = f.`id` 
										     AND tr.`status` = 1 ', [$product_id]);
		}

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
		$locale = 'vi';
		if (Session::has('locale')) {
            $locale = Session::get('locale');
        }

		if (strcmp($locale, 'en') == 0) {
			$product_detail = DB::select('SELECT f.`id` "id", f.`en_name` "name", ROUND(f.`rating`/100, 2)  "rating", 
												 tr.`capacity`, IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` 
											FROM `farmers` f, `trading` tr, `products` p 
										   WHERE p.`id` = tr.`product_id` 
										     AND tr.`product_id` = ? 
										     AND tr.`status` = 1 
										     AND tr.`farmer_id` = f.`id`', [$product_id]
										);					}
		else {
			$product_detail = DB::select('SELECT f.`id` "id", f.`name` "name", ROUND(f.`rating`/100, 2)  "rating", 
												 tr.`capacity`, IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`unit` 
											FROM `farmers` f, `trading` tr, `products` p 
										   WHERE p.`id` = tr.`product_id` 
										     AND tr.`product_id` = ? 
										     AND tr.`status` = 1 
										     AND tr.`farmer_id` = f.`id`', [$product_id]
										);			
		}


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