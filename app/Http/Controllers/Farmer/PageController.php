<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Models\ProductCategory;
use App\Models\MenuItem;
use App\Http\Controllers\Controller;
use Cart;
use DB;
use Session;
use App;
use Auth;
use DateTime;

class PageController extends Controller
{

    public function page()
    {
        $date = new DateTime('next saturday');
        $date->format('Y-m-d');

        $category = [];

        $items = $this->layhang(2, $date);
        foreach ($items as $key) {
        	array_push($category, $key['category']);
        }
        return $category;
        $this->data['farmers'] = $farmers;
        $this->data['products'] = $products;
        return view('farmer.dashboard', $this->data);
    }


    public function layhang($id, $date)
  {
    $products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`category` "category", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id` AND tr.`status` = 1 AND tr.`sold` > 0 AND tr.`delivery_date` = ? ORDER BY p.`category` DESC', [$id, $date]);

      $mua = [];
      foreach ($products_list as $key) {
        $mua[$key->id] = [];
        $mua[$key->id]['name'] = $key->slug;
        $mua[$key->id]['category'] = $key->category;
        $mua[$key->id]['full_name'] = $key->name;
        $mua[$key->id]['take_in'] = 0;
        $mua[$key->id]['unit'] = $key->unit;
        $mua[$key->id]['count_pack'] = 0;
        $mua[$key->id]['pack'] = [];
      }
     // return $mua;
      $orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id`AND g.`delivery_date` = ? AND g.`status` != ? ORDER BY g.`order_id` DESC', [$date, 8]);
        $this->data['orders'] = $orders;
        $this->data['orderItem'] = [];

      foreach ($orders as $order) {
          // return $order->customer_id;
          $item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`category` "product_category", p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
            WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?' , [$order->order_id]);
          // $this->data['orderItem'] += $item;
          foreach ($item as $it) {
            if($it->product_category==0){
              $sp =  DB::select('SELECT f.`name` "farmer_name", p.`slug` "slug", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", 
                               m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM m_packages m, products p, farmers f 
                           WHERE p.`id` = m.`product_id` 
                           AND f.`id` = m.`farmer_id` 
                           AND m.`package_id` = ?',[$it->product_id]);
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
        // return $this->data['orderItem'];
        return $mua;
  }


  
    
}
