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

		$categories = DB::select('SELECT `category_id`, `slug` FROM `categories` ORDER BY `category_id` ASC');

		foreach($categories as $cat)
		{
		 $products_list["" + $cat->category_id] = DB::select('SELECT p.`name` "Name", p.`image` 
		 	"Image", i.`price_customer` "Price" FROM `products` p, `prices` i WHERE p.`price_id` = i.`price_id` AND p.`category` = ? ', [$cat->category_id]);

	        return $products_list;	        
	}

}

