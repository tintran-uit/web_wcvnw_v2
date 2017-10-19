<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vister;
use Backpack\PageManager\app\Models\Page;
use DB;
use Auth;
use Session;
use App;
use App\Models\MenuItem;
use Cart;

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

	public function getOrders()
	{
		if(Auth::check()) {
			$user = Auth::user();
         	$customer_id = $user->connected_id;
			
			$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` AND g.`customer_id` = ? ORDER BY g.`order_id` DESC', [$customer_id]);
    		return $orders;
		}
		else
		{
			return redirect()->back();
		}
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

	public function editProfile()
	{
		if (Auth::check()) {
			
		}
		return redirect()->back();
	}

	public function getRate()
	{
		if (Auth::check()) {
			$page = Page::findBySlug('index');

	        if (!$page)
	        {
	            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
	        }

	        if (Session::has('locale')) {
	            App::setLocale(Session::get('locale'));
	        }

	        $this->data['title'] = $page->title;
	        $this->data['page'] = $page->withFakes();
	        $this->data['menu'] = MenuItem::all();
	        $this->data['cart'] = Cart::content();
	        $this->data['cartOld'] = Cart::content();
	        $user = Auth::user();
         	$customer_id = $user->connected_id;
			
			$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` AND g.`customer_id` = ? ORDER BY g.`order_id` DESC', [$customer_id]);
			$this->data['orders'] = $orders;
			$this->data['orderItem'] = [];
			foreach ($orders as $order) {
				$item = DB::select('SELECT p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name" FROM `m_orders` m, `products` p, `farmers` f  
			WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?', [$order->order_id]);
				// array_push($this->data['orderItem'], $item);
				$this->data['orderItem'][$order->order_id] = $item;
				// $this->data['orderItem'][$order->order_id]['ship'] = 2000;
			}
	        // $this->data['cartOld'] = DB::table('articles')->where('id', $post_id)->first();
	        // return $this->data['orderItem'];
	        return view('pages.user', $this->data);
		}
		return redirect()->back();
	}

	public function rate(Request $request)
	{
		return $data = $request->data;
	}

}
