<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use DB;

class CartProductController extends Controller
{
    public function updateCart(Request $request)
    {
        $data = $request->data;
        Cart::update($data['rowId'], $data['qty']);
        return Cart::content();
    }

    public function deleteItem(Request $request)
    {
    	$data = $request->data;    
    	Cart::remove($data['rowId']);
        return Cart::content();
    }

    public function addItem(Request $request)
    {
        
        $data = $request->data;
        $proID = $data['id'];
        $farmerID = $data['farmerID'];
        $qty = $data['qty'];
        $prod = DB::select('SELECT p.`id` "id", p.`name` "name",  p.`price` "price", p.`image` "image", p.`unit_quantity` "unit_quantity", p.`unit` "unit" FROM `products` p, `trading` td  WHERE p.`id` = ? AND td.`product_id` = p.`id` AND td.`farmer_id` = ? AND td.`capacity` - td.`sold` >= ?', [$proID, $farmerID, $qty]);
        if($prod)
        {
            Cart::add([
              'id' => $proID, 'name' => $prod[0]->name, 'qty' => $qty, 'price' => $prod[0]->price, 'options' => ['image' => $prod[0]->image,'farmer_id' => $farmerID, 'unit_quantity' => $prod[0]->unit_quantity, 'unit' => $prod[0]->unit]
            ]);
            return Cart::content();
        }else{
            return response()->json([
                'error' => 1,
                'status' => 'Sản lượng không đủ. Vui lòng chọn sản phẩm khác.'
            ]);
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
