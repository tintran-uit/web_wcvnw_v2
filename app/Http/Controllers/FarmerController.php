<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
{

	/**
	 *farmerOrderList
	 *
	 * Retrieve all available products in system into different categories
	 * @param $farmer_id: id of the farmer to be retrieved for
	 * @return array of products in its categories 
	 */

	public function farmerOrderList($farmer_id)
	{
		return 0;
	}

	/**
	 * getFarmerProfile
	 *
	 * Retrieve all available products in system into different categories
	 * @param No
	 * @return array of products in its categories 
	 */
    public function getFarmerProfile($farmer_id)
	{
		$farmer = DB::select('SELECT `id`, `name` FROM `categories` ORDER BY `id` ASC');
		foreach($categories as $cat)
		{
		 $products_list[""+$cat->id] = DB::select('SELECT p.`name` "name", im.`filename` 
		 	"image", i.`price_customer` "price" FROM `products` p, `prices` i, `images` im, `products_images` pi WHERE p.`price_id` = i.`id` AND p.`id` = pi.`product_id` AND pi.`image_id` = im.`id` AND p.`category` = ? ', [$cat->id]);
		}
	        return $products_list;	        
	}
}
