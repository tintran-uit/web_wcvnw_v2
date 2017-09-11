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
		 $products_list[""+$cat->id] = DB::select('SELECT p.`id` "id" ,p.`name` "name", p.`slug` "slug", im.`filename` 
		 	"image", i.`price_customer` "price" FROM `products` p, `prices` i, `images` im, `products_images` pi WHERE p.`price_id` = i.`id` AND p.`id` = pi.`product_id` AND pi.`image_id` = im.`id` AND p.`category` = ? ', [$cat->id]);
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
		$product_detail = DB::select('SELECT F.`name`, ROUND(F.`rating`/100, 2) as `rating`, T.`quantity_left`, F.`id` FROM `farmers` F, `trading` T WHERE T.`product_id` = ? AND T.`farmer_id` = F.`id` AND  T.`quantity_left` > 0 ', [$product_id]);
		/*
		  SELECT F.name, F.rating, T.quantity_left, F.id
		    FROM farmers F, trading T
		   WHERE T.product_id = ?
		     AND T.farmer_id = F.id
		*/

		return $product_detail;
	}
}