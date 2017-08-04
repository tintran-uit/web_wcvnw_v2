<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class apiController extends Controller
{
    
    public function getproducts()
	{
		for($i = 1; $i <= 5; $i++)
		{
		 $products_list["" + $i] = DB::select('SELECT p.`name` "Sản Phẩm", p.`image` 
		 	"Hình Ảnh", i.`price_customer` "Giá Thành", c.`name` "Danh Mục" FROM `products` p, `categories` c, `prices` i WHERE p.`category` = c.`category_id` AND p.`price_id` = i.`price_id` AND p.`category` = ? ', [$i]);
		}

	        return $products_list;
	        
	}

}

