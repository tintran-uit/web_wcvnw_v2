<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use DB;
use Session;

class CartProductController extends Controller
{
    public function updateCart(Request $request)
    {
      $locale = 'vi';
      if (Session::has('locale')) {
            $locale = Session::get('locale');
      }

        $data = $request->data;
        $prodID = $data['prodID'];
        $farmerID = $data['farmerID'];
        $qty = $data['qty'];

      if (strcmp($locale, 'en') == 0) {
        $prod = DB::select('SELECT p.`id` "id", p.`en_name` "name",  td.`price` "price", p.`image` "image", 
                                   td.`unit_quantity` "unit_quantity", td.`unit` "unit" 
                              FROM `products` p, `trading` td  
                             WHERE p.`id` = ? 
                               AND td.`product_id` = p.`id` 
                               AND td.`farmer_id` = ? 
                               AND td.`status` = 1 
                               AND td.`capacity` - td.`sold` >= ? * td.`unit_quantity`', [$prodID, $farmerID, $qty]);
        if($prod)
        {
            Cart::update($data['rowId'], $data['qty']);
            return Cart::content();
        }else{
            return response()->json([
                'error' => 1,
                'status' => 'Product sold out, please choose other products.'
            ]);
        }
      }
      else {
        $prod = DB::select('SELECT p.`id` "id", p.`name` "name",  td.`price` "price", p.`image` "image", 
                                   td.`unit_quantity` "unit_quantity", td.`unit` "unit" 
                              FROM `products` p, `trading` td  
                             WHERE p.`id` = ? 
                               AND td.`product_id` = p.`id` 
                               AND td.`farmer_id` = ? 
                               AND td.`status` = 1 
                               AND td.`capacity` - td.`sold` >= ? * td.`unit_quantity`', [$prodID, $farmerID, $qty]);
        if($prod)
        {
            Cart::update($data['rowId'], $data['qty']);
            return Cart::content();
        }else{
            return response()->json([
                'error' => 1,
                'status' => 'Sản lượng không đủ. Vui lòng chọn sản phẩm khác.'
            ]);
        }        
      }
    }

    public function deleteItem(Request $request)
    {
    	$data = $request->data;    
    	Cart::remove($data['rowId']);
        return Cart::content();
    }

    public function addItem(Request $request)
    {
        $locale = 'vi';
        if (Session::has('locale')) {
              $locale = Session::get('locale');
        }
        $data = $request->data;
        $proID = $data['id'];
        $farmerID = $data['farmerID'];
        $qty = $data['qty'];
        if (strcmp($locale, 'en') == 0) {
          $prod = DB::select('SELECT p.`id` "id", p.`en_name` "name",  td.`price` "price", p.`image` "image", 
                                     td.`unit_quantity` "unit_quantity", td.`en_unit` "unit" 
                                FROM `products` p, `trading` td  
                               WHERE p.`id` = ? 
                                 AND td.`status` = 1 
                                 AND td.`product_id` = p.`id` 
                                 AND td.`farmer_id` = ? 
                                 AND td.`capacity` - td.`sold` >= ? * td.`unit_quantity`', [$proID, $farmerID, $qty]);
          if($prod)
          {
              Cart::add([
                'id' => $proID, 'name' => $prod[0]->name, 'qty' => $qty, 'price' => $prod[0]->price, 'options' => ['image' => $prod[0]->image,'farmer_id' => $farmerID, 'unit_quantity' => $prod[0]->unit_quantity, 'unit' => $prod[0]->unit, 'error' => 0]
              ]);
              return Cart::content();
          }else{
              return response()->json([
                  'error' => 1,
                  'status' => 'Product sold out, please choose other products.'
              ]);
          }
        }
        else {
          $prod = DB::select('SELECT p.`id` "id", p.`name` "name",  td.`price` "price", p.`image` "image", 
                                     td.`unit_quantity` "unit_quantity", td.`unit` "unit" 
                                FROM `products` p, `trading` td  
                               WHERE p.`id` = ? 
                                 AND td.`status` = 1 
                                 AND td.`product_id` = p.`id` 
                                 AND td.`farmer_id` = ? 
                                 AND td.`capacity` - td.`sold` >= ? * td.`unit_quantity`', [$proID, $farmerID, $qty]);
          if($prod)
          {
              Cart::add([
                'id' => $proID, 'name' => $prod[0]->name, 'qty' => $qty, 'price' => $prod[0]->price, 'options' => ['image' => $prod[0]->image,'farmer_id' => $farmerID, 'unit_quantity' => $prod[0]->unit_quantity, 'unit' => $prod[0]->unit, 'error' => 0]
              ]);
              return Cart::content();
          }else{
              return response()->json([
                  'error' => 1,
                  'status' => 'Sản lượng không đủ. Vui lòng chọn sản phẩm khác.'
              ]);
          }
        }
        
    }

    public function checkMaGiamGia($ma)
    {   
        $cart = Cart::content();
        $subtotal = 0; 
          foreach ($cart as $item) {
            $subtotal += $item->subtotal;
          }
        $subtotal = $subtotal - 5000;
        return response()->json([
            'status' => 1,
            'ma' => $ma,
            'giam' => '20000',
            'subtotal' => $subtotal
        ]);
    }

    public function addPay(Request $request)
    {

        return $data = $request->data;
    }
}
