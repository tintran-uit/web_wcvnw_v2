<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;

class PackageItemController extends Controller
{

public function index()
    {
      
      return view('admin.PackageItem', []);
        
    }

    public function updateItems(Request $request)
    {
      $data = $request->data;
      foreach ($data as $key => $value) {
        $product_id = $key;
        $order_id = $value['order_id'];
        $quantity = $value['quantity'];
      }
      
      // tra du lieu ve bang
      return $this->getItems();

    }

    public function getItems()
    {
      if(date('D') == 'Fri'){
        $delivery_date = date('Y-m-d');
      }else{
        $delivery_date = new DateTime('next friday');
        $delivery_date = $delivery_date->format('Y-m-d');
      }
      $delivery_date = '2017-12-1';
        $items = DB::select('SELECT 1 AS "checked", tr.`farmer_id`, tr.`product_id`, p.`name`, tr.`unit_quantity`, 
                                    tr.`unit`, ROUND(tr.`price`/tr.`unit_quantity`) AS "price", p.`category`, tr.`unit_quantity` AS "quantity_p1", tr.`unit_quantity` AS "quantity_p2", tr.`unit_quantity` AS "quantity_p3", tr.`unit_quantity` AS "quantity_p4", tr.`price` AS "price_p1", tr.`price` AS "price_p2", tr.`price` AS "price_p3", tr.`price` AS "price_p4"
                               FROM `trading` tr, `products` p
                              WHERE tr.`product_id` = p.`id`
                                AND tr.`delivery_date` = ? LIMIT 3', [$delivery_date]);
        $data['data'] = $items;
      return $data;
      

    }



  
}