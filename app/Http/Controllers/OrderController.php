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
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`status` = 1 AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
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
         	$account_email = $user->email;
         	if(!$customer_id) {
         		//check if data exist in db (email and phone)
	         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `email` = ?', [$account_email]);
	         	//if not yet in db, create customer into db
	         	if(!$customer_id) {
	         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $account_email, $address, $district]);
	         		$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `email` = ?', [$account_email]);
	         	}
	         	$customer_id = $customer_id[0]->id;

	         	DB::statement('UPDATE `users` SET `account_type` = "Customer", `connected_id` = ? WHERE `email` = ?', [$customer_id, $user->email]);
         	}
         }
         else 
         {
         	//check if data exist in db (email and phone)
         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `email` = ?', [$email]);
         	//if not yet in db, create customer into db
         	if(!$customer_id) {
         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $email, $address, $district]);
         		$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `email` = ?', [$email]);
         	}
         	$customer_id = $customer_id[0]->id;
         }
        
// Create Order_id and return after adding the order successfully.
        //#34256789
        if($total >= 500000) {
         	$shipping_cost = 0;//free ship
        }
        $discount_amount = ROUND(($promotion * $total)/100, 0);
        $total = $total - $discount_amount + $shipping_cost;
        $order_id = DB::select('SELECT `order_id` "order_id" FROM `uniqueids` WHERE `id` = 1');
        $order_id = $order_id[0]->order_id;
        DB::statement('UPDATE `uniqueids` SET `order_id` = `order_id`+1 WHERE `id` = 1');

         DB::insert('INSERT INTO g_orders(`order_id`, `customer_id`, `payment`, `promotion_code`, `delivery_address`, `delivery_phone`, `delivery_district`, `shipping_cost`, `total`, `discount_amount`, `created_at`) VALUES(?,?,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP)', [$order_id, $customer_id, $payment, $promotion_code, $address, $phone, $district, $shipping_cost, $total, $discount_amount]);

 		// $items = Cart::content();
		$msg['order_id'] = $order_id;

		foreach ($items as $item) {

			$product_id = $item->id;
			$farmer_id = $item->options["farmer_id"];
			$price = $item->price;
			$qty = $item->qty;
			
			//receive numbers and check if quantity_left is >= order quantity
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left", p.`category` AS "category" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`status` = 1 AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
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
	        	DB::statement('UPDATE `trading` SET `sold_count` = `sold_count`+ ?, `sold` = `sold` + ? WHERE `status` = 1 AND `farmer_id` = ? AND `product_id` = ?', [$qty, $quantity, $farmer_id, $product_id]);

	        	//Proccess the elements in case package is order
	        	if($category == 0) //package
	        	{
		        	DB::statement('UPDATE `trading` AS t, `m_packages` AS m 
		        		              SET t.`sold` = t.`sold` + m.`quantity`,
		        		              	  t.`sold_count` =  t.`sold_count` + ?
 									WHERE t.`farmer_id` = m.`farmer_id`
 									  AND t.`status` = 1
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
		$data = $request->data;
		$rate = $data['rate']*100;
		$comment = $data['comment'];
		$elements = $data['elements'];
		$order_id = $data['order_id'];

		if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         	//check if the order_id is right for customer_id
         	$rate_valid = DB::select('SELECT `order_id` "order_id" 
         								FROM `g_orders` 
         							   WHERE `order_id` = ? 
         							     AND `customer_id` = ?', [$order_id, $customer_id]);

         	if(strcmp($user->account_type, "Customer") == 0 && count($rate_valid) > 0)
         	{
         		if($elements[0] == 0) {
         			//rate the package as whole
		        	DB::statement('UPDATE `g_orders` 
		        		              SET `rating` = ?,
		        		                  `comment` = ?
 									WHERE `order_id` = ?', [$rate, $comment, $order_id]);
		        	//Apply the rate, rating_count to farmers
		        	DB::statement('UPDATE `farmers` f
		        		              SET f.`rating` = ROUND((f.`rating` * f.`rating_count` + ?)/(f.`rating_count` + 1), 0),
		        		                  f.`rating_count` = f.`rating_count` + 1
 									WHERE f.`id` IN (SELECT DISTINCT `farmer_id` 
 													   FROM `m_orders` 
 													  WHERE `order_id` = ?
 													)', [$rate, $order_id]);



         		}
         		else
         		{
         			//rate individually. If multiple items from 1 farmer, rate him only once, apply to one order item as representative for that farmer.
         		// 	$product_id_list = '(0';
         		// 	foreach ($elements as $element) {
         		// 		$product_id_list = $product_id_list.','.$element;
         		// 	}
         		// 	$product_id_list = $product_id_list.')'
			        // 	DB::statement('UPDATE `m_orders` m, `farmers` f 
		        	// 	              	  SET m.`rating` = ?,
		        	// 	                      m.`comment` = ?,
		        	// 	                      f.`rating` = ROUND((f.`rating` * f.`rating_count` + ?)/(f.`rating_count` + 1), 0),
		        	// 	                  	  f.`rating_count` = f.`rating_count` + 1
 										// WHERE f.`id` = m.`farmer_id`
 										//   AND m.`order_id` = ?
 										//   AND m.`id` = (SELECT MIN(id)
 										//   				  FROM `m_orders` mo
 										//   				 WHERE mo.`order_id` = m.`order_id`
 										//   				   AND mo.`farmer_id` = m.`farmer_id`
 										//   				)
 										//   AND `product_id` IN ?', [$rate, $comment, $rate, $order_id, $product_id_list]);
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
		if(Auth::check()) {
			$user = Auth::user();
         	$customer_id = $user->connected_id;
			if(strcmp($user->account_type, "Customer") == 0){
				$items = DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM `m_orders` m, `products` p, `farmers` f WHERE p.`id` = m.`product_id` AND f.`id` = m.`farmer_id` AND `order_id` = ?', [$order_id]);
    			return $items;
    		}
    		else {
    			return redirect()->back();
    		}
    	}
    	else {
    		return redirect()->back();
    	}

	}


	public function cancelOrder($order_id)
	{
		$cancelStatus = 8;
		if(Auth::check()) {
			$user = Auth::user();
         	$customer_id = $user->connected_id;
			if(strcmp($user->account_type, "Admin") == 0){

		        	DB::statement('UPDATE `trading` AS t, `m_packages` AS m, `m_orders` AS mo, `products` AS p 
		        		              SET t.`sold` = t.`sold` - m.`quantity`
 									WHERE t.`farmer_id` = m.`farmer_id`
   									  AND t.`product_id` = m.`product_id` 
   									  AND p.`id` = mo.`product_id`
   									  AND p.`category` = 0
   									  AND t.`status` = 1
   									  AND m.`package_id` = p.`id`
   									  AND mo.`order_id` = ?', [$order_id]);

    			
    				DB::statement('UPDATE `g_orders` AS g, `m_orders` AS m, `trading` t
		        		              SET t.`sold` = t.`sold` - m.`quantity`,
		        		                  g.`status` = 8
 									WHERE g.`status` != 8
 									  AND m.`order_id` = g.`order_id`
 									  AND m.`farmer_id` = t.`farmer_id`
 									  AND m.`product_id` = t.`product_id`
 									  AND t.`status` = 1
 									  AND g.`order_id` = ?', [$order_id]);

    		}
    		else {
    			return redirect()->back();
    		}
    	}
    	else {
    		return redirect()->back();
    	}

	}

}
