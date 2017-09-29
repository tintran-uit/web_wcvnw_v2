<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cart;

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
		
		return Cart::content(); 
		foreach ($request->data as $order) {


		}
		
		return 0;
	}
	

	/**
	 *cancelOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function cancelOrder($customer_id, $cart)
	{
		// 
		return 0;
	}
	

}
