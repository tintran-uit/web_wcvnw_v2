<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cart;
use Auth;

class OrderController extends Controller
{
	/**
	  * An Order Status: Order Submitted -> Processing -> Confirmed -> Assigned   ----> Picked ------> Delievered
	  *                  (Đã nhập đơn hàng) (Đang xử lý)  (Xác nhận)  (Đã phân công)   (Đã lấy hàng)   (Đã giao hàng)
	  * In case deliver on Wednesday & Saturday:
	  */

	/**
	 *addOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function addOrder(Request $request)
	{
		$data = $request->data;
		$phone = $data["sdt"];
        $email = $data["email"];
        $name  = $data["ten"];
        $address = $data["diaChi"];
        $district = $data["selectQuan"];
        $payment = $data["thanhToan"];
        $promotion_code = $data["maGiamGia"];

         $items = Cart::content();
         $orderPossible = 1;
         $counter = 1;
         $total = 0;
         $promotion = 0;
		foreach ($items as $item) {

			$product_id = $item->id;
			$farmer_id = $item->options["farmer_id"];
			$price = $item->price;
			$qty = $item->qty;
			$total = $total + ($price * $qty);
			
			//receive numbers and check if quantity_left is >= order quantity
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
			if($numbers[0]->quantity_left < $qty * $numbers[0]->unit_quantity)
			{
				$item->options["error"] = 1;
				$orderPossible = 0;
				Cart::update($item->rowId, $item->options["error"]);
			}
		}
        if($orderPossible == 0){
         	$msg['Cart'] = Cart::content();
       		return response()->json($msg); 
        }
        
        $shipping_cost = DB::select('SELECT `shipping_cost` FROM `district` WHERE `id` = ?', [$district]);

        $shipping_cost = $shipping_cost[0]->shipping_cost;
        $msg['shipping_cost'] = $shipping_cost;

        $msg['promotion'] = $promotion;

         if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         	if(!$customer_id) {
         		//check if data exist in db (email and phone)
	         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
	         	//if not yet in db, create customer into db
	         	if(!$customer_id) {
	         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $email, $address, $district]);
	         		$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
	         	}
	         	$customer_id = $customer_id[0]->id;

	         	DB::statement('UPDATE `users` SET `account_type` = "Customer", `connnected_id` = ? WHERE `email` = ?', [$customer_id, $user->email]);
         	}
         }
         else 
         {
         	//check if data exist in db (email and phone)
         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
         	//if not yet in db, create customer into db
         	if(!$customer_id) {
         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $email, $address, $district]);
         		$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
         	}
         	$customer_id = $customer_id[0]->id;
         }
        
// Create Order_id and return after adding the order successfully.
        //#34256789
        if($total < 500000) {
         	$total = $total - ROUND(($promotion * $total)/100, 0) + $shipping_cost;
        }
        else {
        	//free ship
        	$total = $total - ROUND(($promotion * $total)/100, 0);
        }
        $order_id = DB::select('SELECT `order_id` "order_id" FROM `uniqueids` WHERE `id` = 1');
        $order_id = $order_id[0]->order_id;
        DB::statement('UPDATE `uniqueids` SET `order_id` = `order_id`+1 WHERE `id` = 1');

         DB::insert('INSERT INTO g_orders(`order_id`, `customer_id`, `payment`, `promotion_code`, `delivery_address`, `delivery_phone`, `delivery_district`, `shipping_cost`, `total`, `created_at`) VALUES(?,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP)', [$order_id, $customer_id, $payment, $promotion_code, $address, $phone, $district, $shipping_cost, $total]);

 		// $items = Cart::content();
		$msg['order_id'] = $order_id;

		foreach ($items as $item) {

			$product_id = $item->id;
			$farmer_id = $item->options["farmer_id"];
			$price = $item->price;
			$qty = $item->qty;
			
			//receive numbers and check if quantity_left is >= order quantity
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left", p.`category` "category" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
			if($numbers[0]->quantity_left < $qty * $numbers[0]->unit_quantity)
			{
				$item->options["error"] = 1;
				Cart::update($item->rowId, $item->options["error"]);
			}
			else{
				$quantity = $qty * $numbers[0]->unit_quantity;
				$price_farmer = $qty * $numbers[0]->price_farmer;
				$unit = $numbers[0]->unit;
				$category = $numbers[0]->category;

	         	$m_order = DB::insert('INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES(?,?,?,?,?,?,?)', [$order_id, $farmer_id, $product_id, $quantity, $unit, $price * $qty, $price_farmer * $qty]);

	         	//update trading table
	        	DB::statement('UPDATE `trading` SET `sold_count` = `sold_count`+ ?, `sold` = `sold` + ? WHERE `farmer_id` = ? AND `product_id` = ?', [$qty, $quantity, $farmer_id, $product_id]);

	        	//Proccess the elements in case package is order
	        	if($category == 0) //package
	        	{
		        	DB::statement('UPDATE `trading` AS t, `m_packages` AS m 
		        		              SET t.`sold` = t.`sold` + m.`quantity`,
		        		              	  t.`sold_count` =  t.`sold_count` + ?
 									WHERE t.`farmer_id` = m.`farmer_id`
   									  AND t.`product_id` = m.`product_id` 
   									  AND m.`package_id` = ?', [$qty, $product_id]);

	        	}
			}
         	
        }
		Cart::destroy();
 		$msg['Cart'] = Cart::content();
       // return $order_id;
       	return response()->json($msg);

}
	
	public function rateOrder(Request $request)
	{
		$rate = $request->rate;
		$comment = $request->comment;
		$elements = $request->elements;
		$order_id = $request->order_id;

		if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         	if(strcmp($user->account_type, "Customer") == 0)
         	{
         		if($elements[0] == 0) {
         			//rate the package as whole
		        	DB::statement('UPDATE `g_orders` 
		        		              SET `rating` = ?,
		        		                  `comment` = ?
 									WHERE `order_id` = ?', [$rate, $comment, $order_id]);
		        	//Apply the rate, rating_count to farmers
		        	DB::statement('UPDATE `farmers` f, `m_orders` m
		        		              SET f.`rating` = ROUND((f.`rating` * f.`rating_count` + ?)/(f.`rating_count` + 1), 0),
		        		                  `comment` = ?
 									WHERE `order_id` = ?', [$rate*100, $comment, $order_id]);



         		}
         		else
         		{
         			foreach ($elements as $element) {
         				//
         			}
         		}
         	}
         }
         else {
         	return redirect()->back();
         }

	}


	/**
	 *cancelOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function orderItems($order_id)
	{
		$items = DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM `m_orders` m, `products` p, `farmers` f WHERE p.`id` = m.`product_id` AND f.`id` = m.`farmer_id` AND `order_id` = ?', [$order_id]);
    	return $items;
	}

	

}
