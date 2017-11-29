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
        
          $g_orders = DB::select('SELECT g.`order_id`, g.`delivery_name`, g.`delivery_phone`, 
                                         tr.`product_name` AS "product_name", tr.`product_id` "DT_RowId", m.`order_quantity`, m.`quantity`, m.`unit`, g.`delivery_date` "delivery_date"
                                    FROM `g_orders` g, `m_orders` m, `trading` tr
                                   WHERE g.`order_id` = m.`order_id`
                                     AND g.`delivery_date` = tr.`delivery_date`
                                     AND tr.`product_id` = m.`product_id`
                                     AND g.`status` != 8
                                     AND g.`delivery_date` = ?
                                  ORDER BY tr.`product_id`', [$delivery_date]);     
        $data['data'] = $g_orders;
      return $data;
      

    }



  
}