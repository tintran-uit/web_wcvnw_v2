<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use DB;

class StatsController extends CrudController
{

public function stats()
    {
        $date = '2017-10-21';
        $farmers = DB::select('SELECT DISTINCT f.`name` "name", f.`id` "id" 
                                 FROM `farmers` f, `trading` tr 
                                WHERE tr.`delivery_date` = ?
                                  AND tr.`sold` > 0
                                  AND tr.`farmer_id` = f.`id` 
                             ORDER BY `id` ASC', [$date]);
            foreach($farmers as $farm)
            {
                $products[$farm->name] = DB::select('(SELECT CONCAT(p.`name`, " (", m.`quantity`, m.`unit`, ")") "Product", COUNT(*) "Quantity" 
                                          FROM `m_orders` m, `g_orders` g, `products` p
                                         WHERE p.`id` = m.`product_id`
                                           AND m.`order_id` = g.`order_id`
                                           AND m.`farmer_id` = ?
                                           AND g.`status` != 8
                                           AND g.`delivery_date` = ?
                                        GROUP BY `Product`, `category` ) 
                                        UNION ALL
                                        (SELECT CONCAT(p.`name`, " (", pa.`quantity`, pa.`unit`, ")") "Product", COUNT(*) "Quantity"
                                          FROM `m_orders` m, `g_orders` g, `products` p, `m_packages` pa
                                         WHERE p.`id` = pa.`product_id`
                                           AND m.`order_id` = g.`order_id`
                                           AND g.`status` != 8
                                           AND pa.`farmer_id` = ?
                                           AND g.`delivery_date` = ?
                                           AND m.`product_id` IN (SELECT `id` FROM `products` WHERE `category` = 0)
                                           AND pa.`package_id` = m.`product_id`
                                         GROUP BY `Product`, `category` )
                                        ORDER BY `Product`  ASC', [$farm->id, $date, $farm->id, $date]);
            }
          // return $products;  
        return view('admin.stats', ['farmers' =>$farmers, 'products' => $products]);
        
    }
}