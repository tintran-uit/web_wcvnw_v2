<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

	public function addEmai($emailCus, $receiveEmailCus)
	{
		return response()->json([
            'status' => 1,
            'ma' => $emailCus,
            'giam' => $receiveEmailCus
        ]);
	}

}
