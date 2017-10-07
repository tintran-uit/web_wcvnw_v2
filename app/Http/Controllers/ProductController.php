<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;


class ProductController extends Controller
{    
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
		 	$products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left", p.`unit` "unit"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = tr.`farmer_id` AND p.`category` = ? ', [$cat->id]);
		}
	        return $products_list;    
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
		$product_detail = DB::select('SELECT f.`id` "id", f.`name` "name", f.`rating` "rating", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` < 0, 0, tr.`capacity` - tr.`sold`) AS "quantity_left" FROM `farmers` f, `trading` tr, `products` p WHERE p.`id` = tr.`product_id` AND tr.`product_id` = ? AND tr.`farmer_id` = f.`id` ', [$product_id]);

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