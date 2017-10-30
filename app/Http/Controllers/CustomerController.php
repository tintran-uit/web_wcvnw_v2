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
	        $user = Auth::user();
         	$customer_id = $user->connected_id;
			if($user->email == 'minh.huynh@cfarm.vn'){
				$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id", g.`delivery_date` "delivery_date" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name" FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?', [$order->order_id]);
					// array_push($this->data['orderItem'], $item);

					$this->data['orderItem'][$order->order_id] = $item;
					$this->data['orderItem'][$order->order_id]['shipping_cost'] = $order->shipping_cost;
					$this->data['orderItem'][$order->order_id]['discount_amount'] = $order->discount_amount;
					$this->data['orderItem'][$order->order_id]['nguoinhan'] = DB::select('SELECT `name` FROM `customers` 
								WHERE `id` = ?', [$order->customer_id])[0]->name;
					// return view('pages.user3', $this->data);
					}
				}
		        // return $this->data['orderItem'];
		        return view('pages.user2', $this->data);
			}else{
				$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`delivery_date` "delivery_date" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` AND g.`customer_id` = ? ORDER BY g.`order_id` DESC', [$customer_id]);
			}
			
			$this->data['orders'] = $orders;
			$this->data['orderItem'] = [];
	        $this->data['orderRate'] = [];
	        $today = date("Y-m-d");
	        $week = strtotime(date("Y-m-d", strtotime($today)) . " -1 week");
  			$week = strftime("%Y-%m-%d", $week);
  			// return $week;
			foreach ($orders as $order) {
				$item = DB::select('SELECT p.`id` "id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name" FROM `m_orders` m, `products` p, `farmers` f  
					WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?', [$order->order_id]);
				// array_push($this->data['orderItem'], $item);
				if(empty($this->data['orderRate'] ) && $order->delivery_date > $week){
					$this->data['orderRate'] = $item;
				}
				$this->data['orderItem'][$order->order_id] = $item;
				$this->data['orderItem'][$order->order_id]['shipping_cost'] = $order->shipping_cost;
				$this->data['orderItem'][$order->order_id]['discount_amount'] = $order->discount_amount;
			}
	        // $this->data['cartOld'] = DB::table('articles')->where('id', $post_id)->first();
	        // return $this->data['orderItem'];
	        
	        return view('pages.user', $this->data);
		}
		return redirect()->back();
	}

	public function rating(Request $request)
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
         	//check if the order_id is right for customer_id
         	$rate_valid = DB::select('SELECT `order_id` "order_id" 
         								FROM `g_orders` 
         							   WHERE `order_id` = ? 
         							     AND `customer_id` = ?
         							     AND DATEDIFF(CURRENT_DATE, `delivery_date`) < 7', [$order_id, $customer_id]);
         							     //count `status` != cancel

         	$msg['order_id'] = $order_id;
         	$msg['customer_id'] = $customer_id;
         	$msg['rate_valid'] = count($rate_valid);
         	$msg['elements'] = $elements;
         	$msg['account_type'] = $user->account_type;
         	if(count($rate_valid) > 0)
         	{
         		if($elements[0] == 0) {
         			//rate the package as whole
					$farmer_id = 0;
                    $m_rating = DB::insert('INSERT INTO `rating` (`rating`, `comment`, `farmer_id`, `customer_id`, `date`)
                                            VALUES(?, ?, ?, ?, CURRENT_DATE)',
                                          [$rate, $comment, $farmer_id, $customer_id]);
                    $msg['rating_id'] = $m_rating;
                    return response()->json($msg);		

                    DB::statement('UPDATE `g_orders` 
		        		              SET `rating` = ?,
		        		                  `comment` = ?
 									WHERE `order_id` = ?
 									  AND `rating` IS NULL', [$rate, $comment, $order_id]);
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
	        $msg['error'] = 0;
	        $msg['status'] = 'Cảm ơn bạn đã đánh giá để góp phân nâng cao chất lượng dịch vụ của cfarm.';
         	return response()->json($msg);
	     }
         else {
         	return redirect()->back();
         }
	}

	public function layhang($id)
	{
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

		if(Auth::check() && Auth::user()->email == 'minh.huynh@cfarm.vn'){
			if($id==1){
				$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'ga-ta'){
								$mua['ga-ta'] += $it->quantity; 
							}
							if($it->slug == 'trung-ga'){
								$mua['trung-ga'] += $it->quantity; 
							}
							
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							if($it->product_id == 63 || $it->product_id == 64){
								$mua['trung-ga'] += $it->quantity; 
								$mua['ga-ta'] += $it->quantity; 
							}
							
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
			}
		}

		if($id==2){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'chuoi-xiem'){
								$mua['chuoi-xiem'] += $it->quantity; 
							}
							if($it->slug == 'chuoi-cau'){
								$mua['chuoi-cau'] += $it->quantity; 
							}
							if($it->slug == 'chuoi-gia'){
								$mua['chuoi-gia'] += $it->quantity; 
							}
							if($it->slug == 'buoi-da-xanh'){
								$mua['buoi-da-xanh'] += $it->quantity; 
							}
							if($it->slug == 'ga-toc'){
								$mua['ga-toc'] += $it->quantity; 
							}
							if($it->slug == 'vit-ray'){
								$mua['vit-ray'] += $it->quantity; 
							}
							if($it->slug == 'gao-ray-toc'){
								$mua['gao-ray-toc'] += $it->quantity; 
							}
							if($it->slug == 'thit-dui-heo-toc'){
								$mua['thit-dui-heo-toc'] += $it->quantity; 
							}
							if($it->slug == 'thit-ba-roi-heo-toc'){
								$mua['thit-ba-roi-heo-toc'] += $it->quantity; 
							}
							if($it->slug == 'bap-gio-heo-toc'){
								$mua['bap-gio-heo-toc'] += $it->quantity; 
							}
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 63 || $it->product_id == 62){
								$mua['chuoi-xiem'] += $it->quantity*2; 
							}else{
								$mua['chuoi-xiem'] += $it->quantity;
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	    if($id==3){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'suon-non'){
								$mua['suon-non'] += $it->quantity; 
							}
							if($it->slug == 'suon-gia'){
								$mua['suon-gia'] += $it->quantity; 
							}
							if($it->slug == 'thit-ba-roi-heo'){
								$mua['thit-ba-roi-heo'] += $it->quantity; 
							}
							if($it->slug == 'cot-let-heo'){
								$mua['cot-let-heo'] += $it->quantity; 
							}
							if($it->slug == 'thit-dui-heo'){
								$mua['thit-dui-heo'] += $it->quantity; 
							}
							if($it->slug == 'thit-nac-dam'){
								$mua['thit-nac-dam'] += $it->quantity; 
							}
							if($it->slug == 'chan-gio'){
								$mua['chan-gio'] += $it->quantity; 
							}
							if($it->slug == 'xuong'){
								$mua['xuong'] += $it->quantity; 
							}
							
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 64){
								 $mua['thit-dui-heo'] += $it->quantity*0.5; 
								 $mua['cot-let-heo'] += $it->quantity*0.3;
								  $mua['thit-ba-roi-heo'] += $it->quantity*0.5;
								   $mua['suon-non'] += $it->quantity*0.5;
							}elseif($it->product_id == 63){
								$mua['thit-dui-heo'] += $it->quantity*0.5; 
								 $mua['cot-let-heo'] += $it->quantity*1;
								  $mua['thit-ba-roi-heo'] += $it->quantity*0.5;
								   $mua['suon-non'] += $it->quantity*1;
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	    if($id==9){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'cam-xoan'){
								$mua['cam-xoan'] += $it->quantity; 
							}
							
							
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 64 || $it->product_id == 61){
								 $mua['cam-xoan'] += $it->quantity; 
								 
							}elseif($it->product_id == 63 || $it->product_id == 62 ){
								$mua['cam-xoan'] += $it->quantity*2; 
								 
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	        if($id==6){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'kho-qua'){
								$mua['kho-qua'] += $it->quantity; 
							}
							if($it->slug == 'dua-leo'){
								$mua['dua-leo'] += $it->quantity; 
							}
							if($it->slug == 'bi-xanh'){
								$mua['bi-xanh'] += $it->quantity; 
							}
							if($it->slug == 'ca-tim'){
								$mua['ca-tim'] += $it->quantity; 
							}
							if($it->slug == 'cu-cai-trang'){
								$mua['cu-cai-trang'] += $it->quantity; 
							}
							if($it->slug == 'dau-cove'){
								$mua['dau-cove'] += $it->quantity; 
							}
							
							
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 64 || $it->product_id == 61){
								 $mua['ca-tim'] += $it->quantity*0.3; 
								 
							}elseif($it->product_id == 63 || $it->product_id == 62 ){
								$mua['ca-tim'] += $it->quantity*0.5; 
								 
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	    if($id==7){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'bo-xoi'){
								$mua['bo-xoi'] += $it->quantity; 
							}
							if($it->slug == 'cai-cau-vong'){
								$mua['cai-cau-vong'] += $it->quantity; 
							}
							if($it->slug == 'dau-cove-my'){
								$mua['dau-cove-my'] += $it->quantity; 
							}
							if($it->slug == 'su-su'){
								$mua['su-su'] += $it->quantity; 
							}
							if($it->slug == 'cu-cai-do'){
								$mua['cu-cai-do'] += $it->quantity; 
							}
							if($it->slug == 'bong-cai-xanh'){
								$mua['bong-cai-xanh'] += $it->quantity; 
							}
								
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 64 || $it->product_id == 61){
								 $mua['cai-cau-vong'] += $it->quantity*0.3; 
								 $mua['su-su'] += $it->quantity*0.3; 
								 
							}elseif($it->product_id == 63 || $it->product_id == 62 ){
								$mua['cai-cau-vong'] += $it->quantity*0.5; 
								$mua['su-su'] += $it->quantity*0.5; 
								 
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	        if($id==8){
		
		 	$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	// $mua['tinh'] = 0;
		 	foreach ($products_list as $key) {
		 		$mua[$key->slug] = 0;
		 	}
		 	// return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id` ORDER BY g.`order_id` DESC');
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];
				foreach ($orders as $order) {
					// return $order->customer_id;
					if($order->status != 8){
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, $id]);
					
						foreach ($item as $it) {
							if($it->slug == 'bo-ngot-nhat'){
								$mua['bo-ngot-nhat'] += $it->quantity; 
							}
							if($it->slug == 'rau-muong'){
								$mua['rau-muong'] += $it->quantity; 
							}
							if($it->slug == 'xa-lach-xoong-nhat'){
								$mua['xa-lach-xoong-nhat'] += $it->quantity; 
								if($it->quantity == 0.3){
								$mua['xa-lach-xoong-nhatz'] = $mua['xa-lach-xoong-nhatz'] + 1;}
							}
							
								
							
						}
						// array_push($mua, $item);

						$item2 = DB::select('SELECT p.`id` "product_id", p.`name` "product_name", m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ? AND f.`id` = ?' , [$order->order_id, 10]);
						// array_push($mua, $item);
						foreach ($item2 as $it) {
							
							if($it->product_id == 64 || $it->product_id == 61){
								 $mua['bo-ngot-nhat'] += $it->quantity*0.3; 
								 $mua['xa-lach-xoong-nhat'] += $it->quantity*0.3; 
								 
							}elseif($it->product_id == 63 || $it->product_id == 62 ){
								$mua['bo-ngot-nhat'] += $it->quantity*0.5; 
								$mua['xa-lach-xoong-nhat'] += $it->quantity*0.5; 
								 
							}
						}
					
					}
				}
				// return $this->data['orderItem'];
				return $mua;
		
	        }

	}

	public function layhang2($id)
	{
		$date = '2017-10-28';
		$products_list = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", tr.`sold` "sold", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND f.`id` = ? AND f.`id` = tr.`farmer_id`  ORDER BY tr.`priority` ASC', [$id]);

		 	$mua = [];
		 	foreach ($products_list as $key) {
		 		$mua[$key->id] = [];
		 		$mua[$key->id]['name'] = $key->slug;
		 		$mua[$key->id]['take_in'] = 0;
		 		$mua[$key->id]['unit'] = $key->unit;
		 		$mua[$key->id]['pack'] = [];
		 	}
		 // return $mua;
		 	$orders = DB::select('SELECT g.`order_id` "order_id", g.`total` "total", g.`created_at` "date", s.`name` "status_name", s.`vn_name` "status_vn_name", g.`status` "status", g.`discount_amount` "discount_amount", g.`note` "note", g.`shipping_cost` "shipping_cost", g.`customer_id` "customer_id" FROM `g_orders` g, `status` s WHERE g.`status` = s.`id`AND g.`delivery_date` = ? AND g.`status` != ? ORDER BY g.`order_id` DESC', [$date, 8]);
				$this->data['orders'] = $orders;
				$this->data['orderItem'] = [];

			foreach ($orders as $order) {
					// return $order->customer_id;
					$item = DB::select('SELECT p.`id` "product_id", p.`name` "product_name",p.`category` "product_category", p.`slug` "slug" , m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", f.`name` "farmer_name", m.`farmer_id` FROM `m_orders` m, `products` p, `farmers` f  
						WHERE m.`product_id` = p.`id` AND f.`id` = m.`farmer_id` AND m.`order_id` = ?' , [$order->order_id]);
					// $this->data['orderItem'] += $item;
					foreach ($item as $it) {
						if($it->product_category==0){
							$sp =  DB::select('SELECT f.`name` "farmer_name", p.`slug` "slug", f.`id` "farmer_id", p.`name` "product_name", p.`id` "product_id", 
		                           m.`quantity` "quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" FROM m_packages m, products p, farmers f 
		                       WHERE p.`id` = m.`product_id` 
		                       AND f.`id` = m.`farmer_id` 
		                       AND m.`package_id` = ?',[$it->product_id]);
							foreach ($sp as $key) {
								if(array_key_exists($key->product_id, $mua)){
									if($key->slug == $mua[$key->product_id]['name'])
									{
										$mua[$key->product_id]['take_in'] += $key->quantity; 
										if(array_key_exists($key->quantity.$key->unit, $mua[$key->product_id]['pack'])){
											$mua[$key->product_id]['pack'][$key->quantity.$key->unit] ++;
										}else{
											$mua[$key->product_id]['pack'][$key->quantity.$key->unit] = 1;
										}
									}
								}
							}
						}elseif(array_key_exists($it->product_id, $mua)){
							if($it->slug == $mua[$it->product_id]['name'])
							{
								$mua[$it->product_id]['take_in'] += $it->quantity; 
								if(array_key_exists($it->quantity.$it->unit, $mua[$it->product_id]['pack'])){
									$mua[$it->product_id]['pack'][$it->quantity.$it->unit] ++;
								}else{
									$mua[$it->product_id]['pack'][$it->quantity.$it->unit] = 1;
								}
							}
						}
					}
			
					// array_push($mua, $item);

				}
				// return $item;
				// return $this->data['orderItem'];
				return $mua;
	}

}
