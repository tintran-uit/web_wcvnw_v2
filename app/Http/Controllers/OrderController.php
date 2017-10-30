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

        $address = $address.$district_name;

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
	         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $account_email, $address, $district_name]);
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
         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $email, $address, $district_name]);
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

         DB::insert('INSERT INTO g_orders(`order_id`, `customer_id`, `payment`, `promotion_code`, `delivery_address`, `delivery_phone`, `delivery_district`, `shipping_cost`, `total`, `discount_amount`, `created_at`, `delivery_date`, `note`, `delivery_name`) VALUES(?,?,?,?,?,?,?,?,?,?, CURRENT_TIMESTAMP,?,?,?)', [$order_id, $customer_id, $payment, $promotion_code, $address, $phone, $district_name, $shipping_cost, $total, $discount_amount, $delivery_date, $note, $name]);

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
		$data = $request->data;
		$rate = $data['rate']*100;
		$comment = $data['comment'];
		$elements = $data['elements'];
		$order_id = $data['order_id'];

		if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         	if(!$customer_id){
         		return redirect()->back();
         	}
            //$m_rating = DB::insert('INSERT INTO `rating` (`rate`, `comment`, `farmer_id`, `customer_id`, `date`') ')
         	//check if the order_id is right for customer_id
         	$rate_valid = DB::select('SELECT `order_id` "order_id" 
         								FROM `g_orders` 
         							   WHERE `order_id` = ? 
         							     AND `customer_id` = ?
         							     AND DATEDIFF(CURRENT_DATE, `delivery_date`) < 7', [$order_id, $customer_id]);

         	if(strcmp($user->account_type, "Customer") == 0 && count($rate_valid) > 0)
         	{
         		if($elements[0] == 0) {
                    $farmer_id = 0;
                    $m_rating = DB::insert('INSERT INTO `rating` (`rate`, `comment`, `farmer_id`, `customer_id`, `date`)
                                            VALUES(?, ?, ?, ?, CURRENT_DATE)',
                                          [$rate, $comment, $farmer_id, $customer_id]);
                    $return $m_rating;
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
         			foreach ($elements as $element) {
			        	DB::statement('UPDATE `m_orders` m, `farmers` f 
		        		              	  SET m.`rating` = ?,
		        		                      m.`comment` = ?,
		        		                      f.`rating` = ROUND((f.`rating` * f.`rating_count` + ?)/(f.`rating_count` + 1), 0),
		        		                  	  f.`rating_count` = f.`rating_count` + 1
 										WHERE f.`id` = m.`farmer_id`
 										  AND m.`order_id` = ?
 										  AND m.`id` = (SELECT MIN(id)
 										  				  FROM `m_orders` mo
 										  				 WHERE mo.`order_id` = m.`order_id`
 										  				   AND mo.`farmer_id` = m.`farmer_id`
 										  				)
 										  AND `product_id` = ?', [$rate, $comment, $rate, $order_id, $element]);
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

            $g_orders = DB::select('SELECT g.`total`, g.`shipping_cost`, g.`delivery_date`
                                      FROM `g_orders` g
                                     WHERE `order_id` = ?', [$order_id]);

            $total = $g_orders[0]->total;
            $shipping_cost = $g_orders[0]->shipping_cost;
            $delivery_date = $g_orders[0]->delivery_date;

            foreach ($m_orders as $item) {
                $farmer_id = $item->farmerID;
                $product_id = $item->prodID;
                $qty = $item->qty;

                $product = DB::select('SELECT p.`category`, p.`unit_quantity`, p.`price`, p.`unit`, tr.`price_farmer`
                                         FROM `products` p, `trading` tr
                                        WHERE p.`id` = tr.`product_id`
                                          AND tr.`status` = 1
                                          AND (tr.`capacity` - tr.`sold`) > p.`unit_quantity` * ?
                                          AND tr.`farmer_id` = ?
                                          AND tr.`product_id` = ?', [$qty, $farmer_id, $product_id]);
                if(!$product)
                {
                    $msg["failed"][$product_id]->error = 1;
                    $msg["failed"][$product_id]->farmer = $farmer_id;
                }
                else {
                    $msg["success"][$product_id]->error = 0;
                    $msg["success"][$product_id]->farmer = $farmer_id;

                    $quantity = $qty * $product[0]->unit_quantity;
                    $price = $qty * $product[0]->price;
                    $price_farmer = $qty * $product[0]->price_farmer;
                    $category = $product[0]->category;
                    $unit = $product[0]->unit;

                    $total = $total + $price;

                    $m_order = DB::insert('INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`) VALUES(?,?,?,?,?,?,?)', [$order_id, $farmer_id, $product_id, $quantity, $unit, $price, $price_farmer]);

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
            $msg["order_id"] = $order_id;
            if($total >= 500000 && $shipping_cost > 0){
                $total = $total - $shipping_cost;
            }
            else {
                $shipping_cost = 0;
            }

            //update trading table
            DB::statement('UPDATE `g_orders` 
                              SET `total` = ? ,
                                  `shipping_cost` = `shipping_cost` - ?
                            WHERE `farmer_id` = ? 
                              AND `order_id` = ?
                              AND `product_id` = ?', [$total, $shipping_cost, $farmer_id, $order_id, $product_id]);

            return response()->json($msg);
        }
        else {
           return redirect()->back();
        }
        
    }

	public function removeItemAdmin(Request $request)
    {
        if(Auth::check()){
            $data = $request->data;
            $farmer_id = $data["farmerID"];
            $product_id = $data["prodID"];
            $qty = $data["qty"];
            $order_id = $data["order_id"];


            $m_orders = DB::select('SELECT m.`id`, m.`quantity`, m.`unit`, m.`price`, g.`total`, d.`shipping_cost`, g.`delivery_date`, p.`category`
                                     FROM `m_orders` m, `g_orders` g, `district` d, `products` p
                                    WHERE g.`order_id` = m.`order_id`
                                      AND d.`id` = g.`delivery_district`
                                      AND p.`id` = m.`product_id`
                                      AND `order_id` = ?
                                      AND `product_id` = ?
                                      AND `farmer_id` = ?', [$order_id, $product_id, $farmer_id]);
            if(!$m_orders)
            {
                $msg["error"] = 1;
                $msg["status"] = "Order Item not exists";
                $msg["order_id"] = $order_id;
                $msg["product_id"]= $product_id;
                $msg["farmer_id"] = $farmer_id;
                return response()->json(msg);
            }
            $quantity = $m_orders[0]->quantity;
            $price = $m_orders[0]->price;
            $total = $m_orders[0]->total;
            $shipping_cost_ex = $m_orders[0]->shipping_cost;
            $delivery_date = $m_orders[0]->delivery_date;
            $category = $m_orders[0]->category;

            if( $total >= 500000 && ($total - $price) < 500000){
                $total = $total - $price + $shipping_cost_ex;
            }
            else {
                $shipping_cost_ex = 0;
                $total = $total - $price;
            }
         	DB::delete('DELETE FROM m_orders
                              WHERE `id` = ?', [$m_orders[0]->id]
                      );

         	//update trading table
            DB::statement('UPDATE `g_orders` 
                              SET `total` = ? ,
                                  `shipping_cost` = `shipping_cost` + ?
                            WHERE `farmer_id` = ? 
                              AND `order_id` = ?
                              AND `product_id` = ?', [$total, $shipping_cost_ex, $farmer_id, $order_id, $product_id]);

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
								  AND m.`package_id` = ?', [$qty, $delivery_date, $product_id]);

        	}

            return response()->json([
                'error' => 0,
                'status' => 'Bỏ sản phẩm thành công.'
            ]);
        }
        else {
           return redirect()->back();
        }
        
    }

	public function  itemStats($date){

		$farmers = DB::select('SELECT DISTINCT f.`name` "name", p.`name` "product_name", f.`id` "id", tr.`sold`  
								 FROM `farmers` f, `trading` tr, `products` p
								WHERE tr.`delivery_date` = ?
								  AND p.`id` = tr.`product_id`
								  AND tr.`sold` > 0
								  AND tr.`farmer_id` = f.`id` 
						 	 ORDER BY `name` ASC', [$date]);
		// return $farmers;
		// $products  = 'No Data';
        $num = 0;

			foreach($farmers as $farm)
			{
                // $products[$num]->farmer = $farm;
                $num = $num+1;

				$products[$farm->name]->stats = DB::select('(SELECT CONCAT(p.`name`, " (", m.`quantity`, m.`unit`, ")") "Product", COUNT(*) "Quantity", tr.`category` "category"
                                                      FROM `m_orders` m, `g_orders` g, `products` p, `trading` tr
                                                     WHERE p.`id` = m.`product_id`
                                                       AND m.`order_id` = g.`order_id`
                                                       AND tr.`farmer_id` = m.`farmer_id`
                                                       AND tr.`product_id` = m.`product_id`
                                                       AND g.`status` != 8
                                                       AND tr.`farmer_id` = ?
                                                       AND tr.`delivery_date` = g.`delivery_date`
                                                       AND tr.`delivery_date` = ?
                                                    GROUP BY  `category`, `Product`) 
                                                    UNION ALL
                                                    (SELECT CONCAT(p.`name`, " (", pa.`quantity`, pa.`unit`, ")") "Product", COUNT(*) "Quantity", tr.`category` "category"
                                                      FROM `m_orders` m, `g_orders` g, `products` p, `m_packages` pa, `trading` tr
                                                     WHERE p.`id` = pa.`product_id`
                                                       AND m.`order_id` = g.`order_id`
                                                       AND tr.`farmer_id` = pa.`farmer_id`
                                                       AND tr.`product_id` = pa.`product_id`
                                                       AND tr.`farmer_id` = ?
                                                       AND g.`status` != 8
                                                       AND g.`delivery_date` = ?
                                                       AND tr.`delivery_date` = g.`delivery_date`
                                                       AND m.`product_id` IN (SELECT `id` FROM `products` WHERE `category` = 0)
                                                       AND pa.`package_id` = m.`product_id`
                                                     GROUP BY `category`, `Product`)
                                                    ORDER BY `category`,`Product`  ASC', [$farm->id, $date, $farm->id, $date]);
			}
        if($num == 0) $products = "No data";
		return $products;
    }
}
