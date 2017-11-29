<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use Illuminate\Http\Request;
use DB;
use DateTime;

class TradingController extends CrudController
{

public function index()
    {
      
      return view('admin.trading', []);
        
    }

    public function editItem(Request $request)
    {
      $data = $request->data;
      $delivery_date = '2017-11-25';
      foreach ($data as $key => $value) {
        $id = $key;
        if(count($value)==1){
          // edit other
          //update trading, products for that product.
          switch(key($value)) {
            case "capacity":
              DB::statement('UPDATE `trading` 
                                SET `capacity` = ? 
                              WHERE `product_id` = ?
                                AND `delivery_date` = ?', [$value["capacity"], $id, $delivery_date]
                            );
              break;
            case "unit_quantity":
              DB::statement('UPDATE `products` p 
                                SET `unit_quantity` = ? 
                              WHERE `id` = ?', [$value["unit_quantity"], $id]
                            );
              break;
            case "unit":
              DB::statement('UPDATE `trading` tr, `products` p 
                                SET tr.`unit` = ?, 
                                    p.`unit` = ?
                              WHERE p.`id` = tr.`product_id`
                                AND p.`id` = ?
                                AND tr.`delivery_date` = ?', [$value["unit"], $value["unit"], $id, $delivery_date]
                            );
              break;
            case "price":
              DB::statement('UPDATE `products` p 
                                SET `price` = ? 
                              WHERE `id` = ?', [$value["price"], $id]
                            );
              break;
            case "price_farmer":
              DB::statement('UPDATE `trading` tr, `products` p 
                                SET tr.`price_farmer` = ?, 
                                    p.`price_farmer` = ?,
                                    p.`price_wholesale` = ROUND(1.4*?,0)
                              WHERE p.`id` = tr.`product_id`
                                AND p.`id` = ?
                                AND tr.`delivery_date` = ?', [$value["price_farmer"], $value["price_farmer"], $value["price_farmer"], $id, $delivery_date]
                            );
              break;
            case "price_wholesale":
              DB::statement('UPDATE `products` p 
                                SET `price_wholesale` = ? 
                              WHERE `id` = ?', [$value["price_wholesale"], $id]
                            );
              break;
          }

          return $value;
        }else{
          if($value['status'] == 1) {
            //add trading product
            DB::insert('INSERT INTO trading(`farmer_id`, `product_id`, `product_name`, `capacity`, `price_farmer`,
                                            `sold`, `unit`, `status`, `delivery_date`, `priority`, `category`) 
                          VALUES (?,?,?,?,?, CURRENT_TIMESTAMP)', [$name, $phone, $email, $address, $district]);
          }
          else {
            //remove trading product
            $value['status'] = 0;
            DB::delete('DELETE FROM `trading`
                              WHERE `product_id` = ?
                                AND `delivery_date` = ?', [$id, $delivery_date]
                      );
          }
          return $value['status'];
        }
      }
      return $value[key($value)];
      return key($value);
    }

  public function getItems()
  {
    $delivery_date = '2017-11-18';
    $items = DB::select('SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 
                                ROUND(tr.`capacity`, 2) "capacity", ROUND(tr.`unit_quantity`, 2) "unit_quantity", 
                                tr.`unit` "unit", tr.`price` "price", tr.`price_farmer` "price_farmer", 
                                tr.`price_wholesale` "price_wholesale", tr.`delivery_date` "delivery_date", 
                                p.`category` "category", 1 as "status"
                          FROM `trading` tr, `products` p, `farmers` f
                         WHERE `delivery_date`= ?
                           AND tr.`product_id` = p.`id` 
                           AND tr.`farmer_id` = f.`id` 
                        UNION 
                        SELECT p.`id` "DT_RowId", f.`name` "farmer_name", p.`name` "product_name", 0 AS "capacity", 
                               0.3 AS "unit_quantity", "kg" AS "unit", tr.`price` "price", 0 "price_farmer", 
                                p.`price_wholesale` "price_wholesale", ? AS "delivery_date", p.`category` "category", 0 AS "status"
                          FROM `products` p, `farmers` f
                         WHERE f.`id` = p.`farmer_id`
                           AND p.`id` NOT IN (SELECT `product_id` FROM `trading` WHERE `delivery_date`=?) 
                      ORDER BY `category`, `product_name`', 
                        [$delivery_date, $delivery_date, $delivery_date]);
    $data['data'] = $items;
    return $data;

  }

  
}