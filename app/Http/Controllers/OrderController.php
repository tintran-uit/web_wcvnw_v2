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

  public function moveOrder($order_id, $delivery_date)
  {
    if(Auth::check()) {

      $update = DB::statement('UPDATE `trading` tr, `m_orders` m, `g_orders` g
                        SET tr.`sold` = tr.`sold` - m.`quantity`
                      WHERE m.`order_id` = g.`order_id`
                        AND g.`order_id` = ?
                        AND g.`delivery_date` = tr.`delivery_date`
                        AND tr.`product_id` = m.`product_id`
                        AND tr.`farmer_id` = m.`farmer_id`', [$order_id]);

        $update =  DB::statement('UPDATE `g_orders` 
                            SET `delivery_date` = ?
                          WHERE `order_id` = ?', [$delivery_date, $order_id]);
          
        $update = DB::statement('UPDATE `trading` tr, `m_orders` m
                            SET tr.`sold` = tr.`sold` + m.`quantity`
                          WHERE m.`order_id` = ?
                            AND tr.`product_id` = m.`product_id`
                            AND tr.`farmer_id` = m.`farmer_id`
                            AND tr.`delivery_date` = ?
                            AND tr.`status` = 1', [$order_id, $delivery_date]);
        if($update){
            return redirect()->back();
        }else{
            return "Cập nhật không thành công";
        }

    }
    else {
      return redirect()->back();
    } 
  }

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
        $note = $data["note"];
        
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
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left", tr.`delivery_date` "delivery_date" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`status` = 1 AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
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
        $delivery_date = $numbers[0]->delivery_date;        
        $shipping_cost = DB::select('SELECT `shipping_cost`, `name` FROM `district` WHERE `id` = ?', [$district]);

//Be careful of reassignment of $shipping_cost to itself
        $district_name = $shipping_cost[0]->name;
        $shipping_cost = $shipping_cost[0]->shipping_cost;
        $msg['shipping_cost'] = $shipping_cost;

        $address = $address." ".$district_name;

        $msg['promotion'] = $promotion;
         if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         	$account_email = $user->email;
         	if($customer_id===null) {
         		//check if data exist in db (email and phone)
	         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `email` = ?', [$account_email]);
	         	//if not yet in db, create customer into db
	         	if($customer_id!==null) {
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

         DB::insert('INSERT INTO g_orders(`order_id`, `customer_id`, `payment`, `promotion_code`, `delivery_address`, `delivery_phone`, `delivery_district`, `shipping_cost`, `total`, `discount_amount`, `created_at`, `delivery_date`, `note`, `delivery_name`) VALUES(?,?,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP,?,?,?)', [$order_id, $customer_id, $payment, $promotion_code, $address, $phone, $district, $shipping_cost, $total, $discount_amount, $delivery_date, $note, $name]);

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

	         	$m_order = DB::insert('INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES(?,?,?,?,?,?,?)', [$order_id, $farmer_id, $product_id, $quantity, $unit, $price * $qty, $price_farmer]);

	         	//update trading table
	        	DB::statement('UPDATE `trading` SET `sold` = `sold` + ? WHERE `status` = 1 AND `farmer_id` = ? AND `product_id` = ?', [$quantity, $farmer_id, $product_id]);

	        	//Proccess the elements in case package is order
	        	if($category == 0) //package
	        	{
		        	DB::statement('UPDATE `trading` AS t, `m_packages` AS m 
		        		              SET t.`sold` = t.`sold` + m.`quantity`
 									WHERE t.`farmer_id` = m.`farmer_id`
 									  AND t.`status` = 1
   									  AND t.`product_id` = m.`product_id` 
   									  AND m.`package_id` = ?', [$product_id]);

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
        return redirect()->back();
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
			$products = DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", p.`category` "category", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM `m_orders` m, `products` p, `farmers` f WHERE p.`id` = m.`product_id` AND f.`id` = m.`farmer_id` AND `order_id` = ? ORDER BY p.`category` DESC', [$order_id]);

            for($x=0; $x<count($products); $x++) {
                if($products[$x]->category==0){
                    $items =  DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", 
                           m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM m_packages m, products p, farmers f 
                       WHERE p.`id` = m.`product_id` 
                       AND f.`id` = m.`farmer_id` 
                       AND m.`package_id` = ?',[$products[$x]->product_id]);
                    $products[$x]->items = $items;
                }
            }
    		return $products;
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

    public function addItemAdmin(Request $request)
    {
        if(Auth::check()){
            $data = $request->data;
            $order_id = $data["order_id"];

            $m_orders = $data["ItemsUpload"];

            $g_orders = DB::select('SELECT g.`total`, g.`shipping_cost` "shipping_cost", g.`delivery_date`, d.`shipping_cost` "shipping_cost_ex"
                                      FROM `g_orders` g, `district` d
                                     WHERE `order_id` = ?
                                       AND g.`delivery_district` = d.`id`', [$order_id]);

            if(count($g_orders) < 1){
              $msg["error"]=1;
              $msg["status"] = "Thông tin chung đơn hàng không tồn tại";
              return response()->json($msg);
            }
            $total = $g_orders[0]->total;
            $shipping_cost = $g_orders[0]->shipping_cost;
            $shipping_cost_ex = $g_orders[0]->shipping_cost_ex;
            $delivery_date = $g_orders[0]->delivery_date;


            foreach ($m_orders as $m_order) {
              //return response()->json($m_order);

                $farmer_id = $m_order["farmerID"];
                $product_id = $m_order["prodID"];
                $qty = $m_order["qty"];
                $m_item = DB::select('SELECT `product_id`, `price`
                                        FROM `m_orders` 
                                       WHERE `product_id` = ?
                                         AND `farmer_id` = ?
                                         AND `order_id` = ?', [$product_id, $farmer_id, $order_id]);
                if(count($m_item) > 0){
                    $total = $total - $m_item[0]->price;
                    $this->removeItemAdmin($order_id, $product_id, $farmer_id);
                }
                else {
                  $product = DB::select('SELECT p.`category`, p.`unit_quantity`, p.`price`, p.`unit`, tr.`price_farmer`
                                         FROM `products` p, `trading` tr
                                        WHERE p.`id` = tr.`product_id`
                                          AND tr.`status` = 1
                                          AND (tr.`capacity` - tr.`sold`) > p.`unit_quantity` * ?
                                          AND tr.`farmer_id` = ?
                                          AND tr.`product_id` = ?
                                          AND tr.`delivery_date` = ?', [$qty, $farmer_id, $product_id, $delivery_date]);
                  if(count($product) < 1)
                  {
                      $msg["failed:".$product_id] = $m_order;
                  }
                  else if ($qty > 0){
                      $msg["success:".$product_id] = $m_order;

                      $quantity = $qty * $product[0]->unit_quantity;
                      $price = $qty * $product[0]->price;
                      $price_farmer = $qty * $product[0]->price_farmer;
                      $category = $product[0]->category;
                      $unit = $product[0]->unit;

                      $total = $total + $price;

                      DB::insert('INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES(?,?,?,?,?,?,?)', [$order_id, $farmer_id, $product_id, $quantity, $unit, $price, $price_farmer]);

                      DB::statement('UPDATE `trading` 
                                        SET `sold` = `sold` + ? 
                                      WHERE `status` = 1 
                                        AND `delivery_date` = ?
                                        AND `farmer_id` = ? 
                                        AND `product_id` = ?', [$quantity, $delivery_date, $farmer_id, $product_id]);

                      //Proccess the elements in case package is order
                      if($category == 0) //package
                      {
                          DB::statement('UPDATE `trading` AS tr, `m_packages` AS m 
                                            SET tr.`sold` = tr.`sold` + m.`quantity` * ?
                                          WHERE tr.`farmer_id` = m.`farmer_id`
                                            AND tr.`product_id` = m.`product_id` 
                                            AND tr.`status` = 1
                                            AND tr.`delivery_date` = ?
                                            AND m.`package_id` = ?', [$qty, $delivery_date, $product_id]);

                      }

                    }
                  }
            }
            $msg["order_id"] = $order_id;//price subtraction
            if(($total - $shipping_cost) >= 500000 && $shipping_cost > 0){
                $total = $total - $shipping_cost;
                $shipping_cost = 0;
            }
            else if(($total - $shipping_cost) < 500000 && $shipping_cost == 0)
            {
              $shipping_cost = $shipping_cost_ex;
              $total = $total + $shipping_cost;
            }

            //update trading table
            DB::statement('UPDATE `g_orders` 
                              SET `total` = ? ,
                                  `shipping_cost` = ?
                            WHERE `order_id` = ?', [$total, $shipping_cost, $order_id]);
              
            $msg["error"]=0;
            $msg["status"] = "Chỉnh sửa đơn hàng thành công.";

            return response()->json($msg);
        }
        else {
           return redirect()->back();
        }
        
    }

	public function removeItemAdmin($order_id, $product_id, $farmer_id)
    {
        if(Auth::check()){

            $m_orders = DB::select('SELECT m.`id`, m.`quantity`, m.`unit`, m.`price`, g.`total`, d.`shipping_cost` "shipping_cost_ex", g.`delivery_date`, p.`category`, g.`shipping_cost` "shipping_cost"
                                     FROM `m_orders` m, `g_orders` g, `district` d, `products` p
                                    WHERE g.`order_id` = m.`order_id`
                                      AND d.`id` = g.`delivery_district`
                                      AND p.`id` = m.`product_id`
                                      AND g.`order_id` = ?
                                      AND m.`product_id` = ?
                                      AND m.`farmer_id` = ?', [$order_id, $product_id, $farmer_id]);
            if(!$m_orders)
            {
                $msg["error"] = 1;
                $msg["status"] = "Order Item not exists";
                $msg["order_id"] = $order_id;
                $msg["product_id"]= $product_id;
                $msg["farmer_id"] = $farmer_id;
                return response()->json($msg);
            }
            $quantity = $m_orders[0]->quantity;
            $price = $m_orders[0]->price;
            $total = $m_orders[0]->total;
            $shipping_cost = $m_orders[0]->shipping_cost;
            $shipping_cost_ex = $m_orders[0]->shipping_cost_ex;
            $delivery_date = $m_orders[0]->delivery_date;
            $category = $m_orders[0]->category;

            if($shipping_cost == 0 && ($total - $price) < 500000){
                $total = $total - $price + $shipping_cost_ex;
                $shipping_cost = $shipping_cost_ex;
                $msg["if"] = 1;
            }
            else {
                $total = $total - $price;
                $msg["else"] = 1;
            }
            $msg["total"]=$total;
            $msg["shipping_cost_ex"] = $shipping_cost_ex;
            $msg["shipping_cost"] = $shipping_cost;
            $msg["price"] = $price;
         	DB::delete('DELETE FROM m_orders
                              WHERE `id` = ?', [$m_orders[0]->id]
                      );

         	//update trading table
            DB::statement('UPDATE `g_orders` 
                              SET `total` = ? ,
                                  `shipping_cost` = ?
                            WHERE `order_id` = ?', [$total, $shipping_cost, $order_id]);

            DB::statement('UPDATE `trading` 
                              SET `sold` = `sold` - ? 
                            WHERE `status` = 1 
                              AND `delivery_date` = ?
                              AND `farmer_id` = ? 
                              AND `product_id` = ?', [$quantity, $delivery_date, $farmer_id, $product_id]);

        	//Proccess the elements in case package is order
        	if($category == 0) //package
        	{
	        	DB::statement('UPDATE `trading` AS tr, `m_packages` AS m 
	        		                SET tr.`sold` = tr.`sold` - m.`quantity` * ?
								            WHERE tr.`farmer_id` = m.`farmer_id`
                              AND tr.`product_id` = m.`product_id` 
								              AND tr.`status` = 1
                              AND tr.`delivery_date` = ?
								              AND m.`package_id` = ?', [$quantity, $delivery_date, $product_id]);

        	}
          $msg["error"]=0;
          $msg["status"] = "Bỏ sản phẩm thành công";

          return response()->json($msg);
        }
        else {
           return redirect()->back();
        }
        
    }

}
