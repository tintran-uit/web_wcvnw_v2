<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;

class ProductAvailableController extends Controller
{

public function index()
    {
      
      $items = DB::select('SELECT `product_name`, CONCAT(FORMAT(`price`, 0), "/", `unit_quantity`, `unit`) 
                         FROM `trading` 
                        WHERE `status`=1 
                          AND ROUND(`sold`,2) < ROUND(`capacity`, 2) 
                      ORDER BY `category`, `priority`');
    return $items;
        
    }

  
}