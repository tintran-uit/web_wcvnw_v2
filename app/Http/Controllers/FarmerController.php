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
		$farmer = DB::select('SELECT `id`, `name`, `address`, `rating`, `photo`, `profile` FROM `farmers` 
			WHERE `id` = ?', [$farmer_id]);
		
	    return $farmer;	        
	}

    public function farmers()
	{
		$farmers = DB::select('SELECT `id`, `name`, `address`, `rating`, `photo`, `profile` FROM `farmers` ');
		
	    return $farmers;	        
	}
}
