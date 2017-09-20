<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vister;

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

	public function customerRateOrder($order_id)
	{
		return 0;
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
