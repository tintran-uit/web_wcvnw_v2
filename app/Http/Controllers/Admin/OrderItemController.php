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

        $m_item = DB::select('SELECT m.`product_id`, m.`price`, m.`price_farmer`, m.`quantity`, g.`total`, 
                                     g.`shipping_cost`, g.`delivery_date`
                                FROM `m_orders` m, `g_orders` g 
                               WHERE g.`order_id` = m.`order_id`
                                 AND m.`product_id` = ?
                                 AND m.`order_id` = ?', [$product_id, $order_id]);
        if(count($m_item) <= 0){
          $msg["error"]=1;
          $msg["status"] = "Không tồn tại mặt hàng này trong đơn hàng ".$order_id;
          return response()->json($msg);
        }
        $delivery_date = $m_item[0]->delivery_date;
        $new_price = ($m_item[0]->price * $quantity)/ $m_item[0]->quantity;
        $new_price_farmer = ($m_item[0]->price_farmer * $quantity)/ $m_item[0]->quantity;
        $total = $m_item[0]->total + $new_price - $m_item[0]->price;
        $shipping_cost = $m_item[0]->shipping_cost;

        if($total >= 500000 && $shipping_cost > 0) {
          $shipping_cost = 0;//free ship
        }

        DB::statement('UPDATE `m_orders`
                          SET `quantity` = ?,
                              `price` = ?,
                              `price_farmer` = ?
                        WHERE `order_id` = ?
                          AND `product_id` = ?', [$quantity, $new_price, $new_price_farmer, $order_id, $product_id]
                      );

        DB::statement('UPDATE `trading` 
                          SET `sold` = `sold` + ? - ? 
                        WHERE `delivery_date` = ? 
                          AND `product_id` = ?', [$quantity, $m_item[0]->quantity, $delivery_date, $product_id]);        

        DB::statement('UPDATE `g_orders` 
                          SET `total` = ? ,
                              `shipping_cost` = ?
                        WHERE `order_id` = ?', [$total, $shipping_cost, $order_id]);

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