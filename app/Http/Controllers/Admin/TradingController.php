<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use Illuminate\Http\Request;
use DB;
use DateTime;

class TradingController extends CrudController
{

public function index()
    {
      
      return view('admin.trading', []);
        
    }

    public function editItem(Request $request)
    {
      $data = $request->data;
      return $data;
      foreach ($data as $key => $value) {
        $id = $key;
        if(count($value)==1){
          // edit other
          return $value;
        }else{
          //edit status
          return $value['status'];
        }
      }
      return $value[key($value)];
      return key($value);
    }

  public function getItems()
  {
    $delivery_date = '2017-11-18';
    $items = DB::select('SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 
                                ROUND(tr.`capacity`, 2) "capacity", ROUND(p.`unit_quantity`, 2) "unit_quantity", 
                                p.`unit` "unit", p.`price` "price", tr.`price_farmer` "price_farmer", 
                                p.`price_wholesale` "price_wholesale", tr.`delivery_date` "delivery_date", 
                                p.`category` "category", 1 as "status"
                          FROM `trading` tr, `products` p, `farmers` f
                         WHERE `delivery_date`= ?
                           AND tr.`product_id` = p.`id` 
                           AND tr.`farmer_id` = f.`id` 
                        UNION 
                        SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 0 AS "capacity", 
                               0.3 AS "unit_quantity", "kg" AS "unit", p.`price` "price", 0 "price_farmer", 
                                p.`price_wholesale` "price_wholesale", ? AS "delivery_date", p.`category` "category", 0 AS "status"
                          FROM `products` p, `farmers` f
                         WHERE f.`id` = p.`farmer_id`
                           AND p.`id` NOT IN (SELECT `product_id` FROM `trading` WHERE `delivery_date`=?) 
                      ORDER BY `category`, `product_name`', 
                        [$delivery_date, $delivery_date, $delivery_date]);
    $data['data'] = $items;
    return $data;

  }

  
}