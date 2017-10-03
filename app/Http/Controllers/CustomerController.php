<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vister;
use DB;

class CustomerController extends Controller
{
    /**
	 *customerRateOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function orderContent($order_id)
	{
		$items = DB::select('SELECT p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name" FROM `m_orders` m, `products` p, `farmers` f  
			WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?', [$order_id]);
		
	    return $items;
	}

	public function orders($customer_id)
	{
		$orders = DB::select('SELECT g.`order_id` "order_id", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`note` "note" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` AND g.`customer_id` = ? ORDER BY g.`status` ASC', [$customer_id]);
	    return $orders;
	}

	public function createOrder($customer_id)
	{
		$orders = DB::select('SELECT g.`order_id` "order_id", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`note` "note" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` AND g.`customer_id` = ? ORDER BY g.`status` ASC', [$customer_id]);
	    return $orders;
	}

	/**
	 *customerCart
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function customerCart($customer_id)
	{
		return 0;
	}

	public function addEmaiVister($emailCus, $receiveEmailCus)
	{
		$vister = Vister::where('email', $emailCus)->first(); // model or null
		if (!$vister) {
		    $vister = new Vister;
			$vister->email    = $emailCus;
			$vister->save();
			return response()->json([
	            'error' => 1,
	            'status' => 'Cảm ơn bạn.',
	        	]);
		}else{
			return response()->json([
	            'error' => 2,
	            'status' => 'Bạn đã thêm.',
	        	]);
		}
		
		
	}

}
