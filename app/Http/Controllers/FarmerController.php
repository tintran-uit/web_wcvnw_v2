<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

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
		$trading = DB::select('SELECT p.`name` "product_name", t.`capacity` "capacity", t.`sold` "sold", t.`unit`, t.`sold_count` * p.`price_farmer` "price_farmer" FROM `trading` t, `products` p 
			WHERE t.`product_id` = p.`id` AND t.`farmer_id` = ?', [$farmer_id]);
		
	    return $trading;
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
		$farmer = DB::select('SELECT `id`, `name`, `address`, `rating`, `photo`, `profile` FROM `farmers` 
			WHERE `id` = ?', [$farmer_id]);
		
	    return $farmer;	        
	}

    public function farmers()
	{
		$farmers = DB::select('SELECT `id`, `name`, `address`, `rating`, `photo`, `profile` FROM `farmers` ');
		
	    return $farmers;	        
	}

	public function customerComment($farmer_id)
	{
		$comments = DB::select('SELECT DISTINCT c.`name` AS "customer_name", g.`comment` AS "comment" FROM `g_orders` g, `m_orders` m, `customers` c  WHERE g.`comment` IS NOT NULL AND m.`order_id` = g.`order_id` AND m.`farmer_id` = ?', [$farmer_id]);
		
		return $comments;
	}


}
