<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;

class OrderItemController extends Controller
{

public function index()
    {
      
      return view('admin.orderItem', []);
        
    }

    public function editItem(Request $request)
    {
      $data = $request->data;
      
    }

    public function getItems()
    {
      if(date('D') == 'Fri'){
        $delivery_date = date('Y-m-d');
      }else{
        $delivery_date = new DateTime('next friday');
        $delivery_date = $delivery_date->format('Y-m-d');
      }
      $items = DB::select('SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 
                                  ROUND(tr.`capacity`, 2) "capacity", ROUND(tr.`unit_quantity`, 2) "unit_quantity", 
                                  tr.`unit` "unit", tr.`price` "price", tr.`price_farmer` "price_farmer", 
                                  tr.`delivery_date` "delivery_date", p.`category` "category", 1 as "status"
                             FROM `trading` tr, `products` p, `farmers` f
                            WHERE `delivery_date`= ?
                              AND tr.`product_id` = p.`id` 
                              AND tr.`farmer_id` = f.`id` 
                          UNION 
                           SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 0 AS "capacity", 
                                 0.3 AS "unit_quantity", "kg" AS "unit", tr.`price` "price", 0 "price_farmer",
                                  ? AS "delivery_date", p.`category` "category", 0 AS "status"
                            FROM `products` p, `farmers` f
                           WHERE f.`id` = p.`farmer_id`
                             AND p.`id` NOT IN (SELECT `product_id` FROM `trading` WHERE `delivery_date`=?) 
                           ORDER BY `category` ', 
                          [$delivery_date, $delivery_date, $delivery_date]);
      $data['data'] = $items;
      return $data;

    }

  
}