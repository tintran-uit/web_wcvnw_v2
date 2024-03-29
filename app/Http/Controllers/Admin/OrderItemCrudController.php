<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use DB;

class OrderItemCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\OrderItem");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/order-item');
        $this->crud->setEntityNameStrings('orderitem', 'orderitems');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

//        $this->crud->setFromDb();
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 1);
        $this->crud->orderBy('order_id', 'DESC');


        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'order_id',
            'label' => 'Mã Order',
        ]);
        $this->crud->addColumn([
            'name' => 'product_id',
            'label' => 'Sản phẩm',
            'type' => 'select',
            'entity' => 'product',
            'attribute' => 'name',
            'model' => "App\Models\Product",
        ]);
        $this->crud->addColumn([
            'name' => 'quantity',
            'label' => 'Số lượng',
        ]);

        $this->crud->addColumn([
            'name' => 'unit',
            'label' => 'Đơn vị',
        ]);
        $this->crud->addColumn([
            'name' => 'price',
            'label' => 'Thành Tiền',
        ]);
        $this->crud->addColumn([
            'name' => 'farmer_id',
            'label' => 'Trang Trại',
            'type' => 'select',
            'entity' => 'farmer',
            'attribute' => 'name',
            'model' => "App\Models\Farmer",
        ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'order_id',
            'label' => 'Mã Order',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);
        $this->crud->addField([
            'name' => 'product_id',
            'label' => 'Sản phẩm',
            'type' => 'select',
            'entity' => 'product',
            'attribute' => 'name',
            'model' => "App\Models\Product",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);
        $this->crud->addField([
            'name' => 'quantity',
            'label' => 'Số lượng',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        $this->crud->addField([
            'name' => 'unit',
            'label' => 'Đơn vị',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);
        $this->crud->addField([
            'name' => 'price',
            'label' => 'Thành Tiền',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);
        $this->crud->addField([
            'name' => 'farmer_id',
            'label' => 'Trang Trại',
            'type' => 'select',
            'entity' => 'farmer',
            'attribute' => 'name',
            'model' => "App\Models\Farmer",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);
    }
    /*public function additem($order_id)
    {
        $v_crud = new OrderItemCrudConltroller();
        $v_crud->setup();
        $v_crud->crud->hasAccessOrFail('create');

        // prepare the fields you need to show
        $v_crud->data['crud'] = $v_crud->crud;
        $v_crud->data['saveAction'] = $v_crud->getSaveAction();
        $v_crud->data['fields'] = $v_crud->crud->getCreateFields();
        $v_crud->data['title'] = trans('backpack::crud.add').' '.$v_crud->crud->entity_name;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($v_crud->crud->getCreateView(), $v_crud->data);

    }*/

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

	public function update(UpdateRequest $request)
	{
		// your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
	}

    public function stats()
    {
        $date = '2017-10-21';
        $farmers = DB::select('SELECT f.`name` "name", f.`id` "id" 
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
        return view('admin.stats', $products);
        
    }
    
}
