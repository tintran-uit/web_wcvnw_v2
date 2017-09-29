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
		 $products_list[""+$cat->id] = DB::select('SELECT tr.`farmer_id` "farmer_id", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`price` "price", p.`unit_quantity` "unit_quantity", p.`unit` "unit"  FROM `products` p, `trading` tr WHERE tr.`product_id` = p.`id` AND p.`category` = ? ', [$cat->id]);
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
		$product_detail = DB::select('SELECT F.`name`, F.`rating`, (T.`capacity` - T.`sold`) "quantity_left", F.`id` FROM `farmers` F, `trading` T WHERE T.`product_id` = ? AND T.`farmer_id` = F.`id` ', [$product_id]);
		/*
		  SELECT F.name, F.rating, T.quantity_left, F.id
		    FROM farmers F, trading T
		   WHERE T.product_id = ?
		     AND T.farmer_id = F.id
		*/

		return $product_detail;
	}

	/**
	 *getProductDetail
	 *
	 * Retrieve all available products in system into different categories
	 * @param No
	 * @return array of products in its categories 
	 */
    public function getSuppliers($product_id)
	{
		$product_detail = DB::select('SELECT F.`name`, ROUND(F.`rating`/100, 2) as `rating`, T.`capacity` - T.`sold` "quantity_left", T.`capacity`, T.`unit`, F.`id` FROM `farmers` F, `trading` T WHERE T.`product_id` = ? AND T.`farmer_id` = F.`id`', [$product_id]);
		/*
		  SELECT F.name, F.rating, T.quantity_left, F.id
		    FROM farmers F, trading T
		   WHERE T.product_id = ?
		     AND T.farmer_id = F.id
		*/

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