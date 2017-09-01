<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use DB;

class CartProductController extends Controller
{
    public function addCart(Request $request)
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
        $prod = DB::select('SELECT p.`id` "id", p.`name` "name", p.`slug` "slug", im.`filename` 
            "image", i.`price_customer` "price" FROM `products` p, `prices` i, `images` im, `products_images` pi WHERE p.`price_id` = i.`id` AND p.`id` = pi.`product_id` AND pi.`image_id` = im.`id` AND p.`id` = ? ', [$proID]);
        Cart::add([
          'id' => $proID, 'name' => $prod[0]->name, 'qty' => $data['qty'], 'price' => $prod[0]->price, 'options' => ['image' => $prod[0]->image,'nd_id' => 'TG111', 'name' => 'Nông trại Bác 8 Bình D ']
        ]);
        return Cart::content();
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
}
