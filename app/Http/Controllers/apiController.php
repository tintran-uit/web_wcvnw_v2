<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class apiController extends Controller
{
    //
    public function getproducts()
	{
		 $products = DB::select('select * from product');

	        return $products;
	        
	}

}

