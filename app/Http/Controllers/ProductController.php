<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


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
		 $products_list[""+$cat->id] = DB::select('SELECT p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` 
		 	"image", p.`price` "price", p.`unit_quantity` "unit_quantity", p.`unit` "unit"  FROM `products` p WHERE p.`category` = ? ', [$cat->id]);
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
		$product_detail = DB::select('SELECT F.`name`, F.`rating`, T.`quantity_left`, F.`id` FROM `farmers` F, `trading` T WHERE T.`product_id` = ? AND T.`farmer_id` = F.`id` ', [$product_id]);
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
		$product_detail = DB::select('SELECT F.`name`, ROUND(F.`rating`/100, 2) as `rating`, T.`quantity_left`, T.`capacity`, T.`unit`, F.`id` FROM `farmers` F, `trading` T WHERE T.`product_id` = ? AND T.`farmer_id` = F.`id`', [$product_id]);
		/*
		  SELECT F.name, F.rating, T.quantity_left, F.id
		    FROM farmers F, trading T
		   WHERE T.product_id = ?
		     AND T.farmer_id = F.id
		*/

		return $product_detail;
	}
}