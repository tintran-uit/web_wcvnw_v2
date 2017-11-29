<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use DB;
use DateTime;

class StatsController extends CrudController
{

public function stats()
    {
      if(date('D') == 'Sat'){
        $date = date('Y-m-d');
      }else{
        $date = new DateTime('next saturday');
        $date->format('Y-m-d');
      }
      // $date = '2017-11-11'; 
        $farmers = DB::select('SELECT DISTINCT f.`name` "name", f.`id` "id" 
                                 FROM `farmers` f, `trading` tr 
                                WHERE tr.`sold` > 0
                                  AND tr.`farmer_id` = f.`id` 
                             ORDER BY `id` ASC');

            foreach($farmers as $farm)
            {
              if($farm->id != 10){
                $products[$farm->name] = $this->layhang($farm->id, $date);
              }else{
                $products[$farm->name] = $this->soangoi($farm->id, $date);
              }
            }
        // $date = $date->format('Y-m-d'); 
        return view('admin.stats', ['farmers' =>$farmers, 'products' => $products, 'date' => $date]);
        
    }

public function statsByDate($date)
    {
      // $date = '2017-11-11'; 
      // return $end = date('next saturday', $date);
        $farmers = DB::select('SELECT DISTINCT f.`name` "name", f.`id` "id" 
                                 FROM `farmers` f, `trading` tr 
                                WHERE tr.`delivery_date` = ?
                                  AND tr.`sold` > 0
                                  AND tr.`farmer_id` = f.`id` 
                             ORDER BY `id` ASC', [$date]);
        if(empty($farmers)){
          return $date." chưa có đơn hàng!";
        }
            foreach($farmers as $farm)
            {
              if($farm->id != 10){
                $products[$farm->name] = $this->layhang($farm->id, $date);
              }else{
                $products[$farm->name] = $this->soangoi($farm->id, $date);
              }
            }
        
        return view('admin.stats', ['farmers' =>$farmers, 'products' => $products, 'date' => $date]);
        
    }

  public function layhang($id, $date)
  {
    $products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name",
                                        p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price",
                                        p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", 
                                        p.`brand_id` "label"  
                                   FROM `products` p, `trading` tr, `farmers` f 
                                  WHERE tr.`product_id` = p.`id` 
                                    AND f.`id` = ? 
                                    AND f.`id` = tr.`farmer_id` 
                                    AND tr.`sold` > 0 
                                    AND tr.`delivery_date` = ? 
                               ORDER BY p.`category` DESC', [$id, $date]);

      $mua = [];
      foreach ($products_list as $key) {
        $mua[$key->id] = [];
        $mua[$key->id]['name'] = $key->slug;
        $mua[$key->id]['full_name'] = $key->name;
        $mua[$key->id]['take_in'] = 0;
        $mua[$key->id]['unit'] = $key->unit;
        $mua[$key->id]['count_pack'] = 0;
        $mua[$key->id]['pack'] = [];
      }
     // return $mua;
    $orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", 
                                 s.`en_name` "status_name", s.`name` "status_vn_name", g.`status` "status", 
                                 g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost"
                                 , g.`customer_id` "customer_id" 
                            FROM `g_orders` g, `status` s 
                           WHERE g.`status` = s.`id`
                             AND g.`delivery_date` = ? 
                             AND g.`status` != ? 
                        ORDER BY g.`order_id` DESC', [$date, 8]);
        $this->data['orders'] = $orders;
        $this->data['orderItem'] = [];

      foreach ($orders as $order) {
          // return $order->customer_id;
          $item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`category` "product_category", p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
            WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?' , [$order->order_id]);
          // $this->data['orderItem'] += $item;
          foreach ($item as $it) {
            if($it->product_category==0){
              $sp =  DB::select('SELECT f.`name` "farmer_name", p.`slug` "slug", f.`id` "farmer_id", 
                                        p.`name` "product_name", p.`id` "product_id", m.`quantity` "quantity", 
                                        m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" 
                                   FROM `m_packages` m, `products` p, `farmers` f 
                                  WHERE p.`id` = m.`product_id` 
                                    AND f.`id` = m.`farmer_id` 
                                    AND m.`delivery_date` = ?
                                    AND m.`package_id` = ?',[$date, $it->product_id]);

              foreach ($sp as $key) {
                if(array_key_exists($key->product_id, $mua)){
                  if($key->slug == $mua[$key->product_id]['name'])
                  {
                    $mua[$key->product_id]['take_in'] += $key->quantity; 
                    $mua[$key->product_id]['count_pack'] ++; 
                    if(array_key_exists($key->quantity.$key->unit, $mua[$key->product_id]['pack'])){
                      $mua[$key->product_id]['pack'][$key->quantity.$key->unit] ++;
                    }else{
                      $mua[$key->product_id]['pack'][$key->quantity.$key->unit] = 1;
                    }
                  }
                }
              }
            }elseif(array_key_exists($it->product_id, $mua)){
              if($it->slug == $mua[$it->product_id]['name'])
              {
                $mua[$it->product_id]['take_in'] += $it->quantity; 
                $mua[$it->product_id]['count_pack'] ++; 
                if(array_key_exists($it->quantity.$it->unit, $mua[$it->product_id]['pack'])){
                  $mua[$it->product_id]['pack'][$it->quantity.$it->unit] ++;
                }else{
                  $mua[$it->product_id]['pack'][$it->quantity.$it->unit] = 1;
                }
              }
            }
          }
      
          // array_push($mua, $item);

        }
        // return $item;
        // return $this->data['orderItem'];
        return $mua;
  }

  public function soangoi($id, $date)
  {
    $products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id` AND tr.`sold` > 0 AND tr.`delivery_date` = ? ORDER BY p.`category` DESC', [$id, $date]);

      $mua = [];
      foreach ($products_list as $key) {
        $mua[$key->id] = [];
        $mua[$key->id]['name'] = $key->slug;
        $mua[$key->id]['full_name'] = $key->name;
        $mua[$key->id]['take_in'] = 0;
        $mua[$key->id]['unit'] = $key->unit;
        $mua[$key->id]['count_pack'] = 0;
        $mua[$key->id]['pack'] = [];
      }
     // return $mua;
      $orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`en_name` "status_name", s.`name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id`AND g.`delivery_date` = ? AND g.`status` != ? ORDER BY g.`order_id` DESC', [$date, 8]);
        $this->data['orders'] = $orders;
        $this->data['orderItem'] = [];

      foreach ($orders as $order) {
          // return $order->customer_id;
          $item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`category` "product_category", p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
            WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?' , [$order->order_id]);
          // $this->data['orderItem'] += $item;
          foreach ($item as $it) {
            if(array_key_exists($it->product_id, $mua)){
              if($it->slug == $mua[$it->product_id]['name'])
              {
                $mua[$it->product_id]['take_in'] += $it->quantity; 
                $mua[$it->product_id]['count_pack'] ++; 
                if(array_key_exists($it->quantity.$it->unit, $mua[$it->product_id]['pack'])){
                  $mua[$it->product_id]['pack'][$it->quantity.$it->unit] ++;
                }else{
                  $mua[$it->product_id]['pack'][$it->quantity.$it->unit] = 1;
                }
              }
            }
          }
      
          // array_push($mua, $item);

        }
        // return $item;
        // return $this->data['orderItem'];
        return $mua;
  }
}