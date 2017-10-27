<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use DB;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

class OrderCrudController extends CrudController
{
    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Order");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/order');
        $this->crud->setEntityNameStrings('order', 'orders');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 1);
        $this->crud->orderBy('created_at', 'DESC');


        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'order_id',
            'label' => 'Mã Order',
        ]);
        $this->crud->addColumn([
            'name' => 'customer_id',
            'label' => 'Người mua',
            'type' => 'select',
            'entity' => 'customer',
            'attribute' => 'name',
            'model' => "App\Models\Customer",
        ]);
        $this->crud->addColumn([
            'name' => 'delivery_name',
            'label' => 'Người Nhận',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'delivery_phone',
            'label' => 'Điện Thoại Nhận',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'delivery_address',
            'label' => 'Địa Chỉ Giao Hàng',
            'type' => 'text',
        ]);
        // $this->crud->addColumn([
        //     'name' => 'delivery_district',
        //     'label' => 'Quận',
        //     'type' => 'text',
        // ]);
        $this->crud->addColumn([
            'name' => 'delivery_district',
            'label' => 'Quận',
            'type' => 'select',
            'entity' => 'district',
            'attribute' => 'name',
            'model' => "App\Models\District",
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Trạng Thái',
            'type' => 'select',
            'entity' => 'status_v',
            'attribute' => 'vn_name',
            'model' => "App\Models\Status",
        ]);
        
        $this->crud->addColumn([
            'name' => 'total',
            'label' => 'Tổng Tiền',
            'type' => 'number',
        ]);
        $this->crud->addColumn([
            'name' => 'note',
            'label' => 'Note',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'delivery_date',
            'label' => 'Ngày Giao Hàng',
            'type' => 'text',
        ]);
        // ------ CRUD FIELDS
       $this->crud->addField([
            'name' => 'order_id',
            'label' => 'Mã Order',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);
        $this->crud->addField([
            'name' => 'customer_id',
            'label' => 'Khách hàng',
            'type' => 'select',
            'entity' => 'customer',
            'attribute' => 'name',
            'model' => "App\Models\Customer",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);
        $this->crud->addField([
            'name' => 'shipper_id',
            'label' => 'Giao hàng',
            'type' => 'select',
            'entity' => 'shipper',
            'attribute' => 'name',
            'model' => "App\Models\Shipper",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'delivery_address',
            'label' => 'Địa Chỉ Giao Hàng',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-10'
            ],
        ]);

        $this->crud->addField([
            'name' => 'delivery_phone',
            'label' => 'SĐT người nhận',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        $this->crud->addField([
            'name' => 'delivery_district',
            'label' => 'Quận Giao Hàng',
            'type' => 'select',
            'entity' => 'district',
            'attribute' => 'name',
            'model' => "App\Models\District",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'note',
            'label' => 'Ghi chú',
            'type' => 'textarea',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'shipping_cost',
            'label' => 'Phí Giao Hàng',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'total',
            'label' => 'Tổng tiền',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Trạng Thái',
            'type' => 'select',
            'entity' => 'status',
            'attribute' => 'vn_name',
            'model' => "App\Models\Status",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // $this->crud->allowAccess('details_row');
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']);
        // $this->crud->setDetailsRowView('orders_list.');
        

        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

  /*  public function showDetailsRow($id)
    {

        // $this->crud->hasAccessOrFail('details_row');

        // $this->data['entry'] = $this->crud->getEntry($id);
        // $this->data['crud'] = $this->crud;
        return $id;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        // return view($this->crud->getDetailsRowView(), $this->data);
    }  */     
}

    public function showDetailsRow($id)
    {

         $this->crud->hasAccessOrFail('details_row');

         // return $this->crud->getEntry($id)->order_id;
        // $this->data['crud'] = $this->crud;
         $m_orders = DB::table('m_orders')
                     ->select(DB::raw('*'))
                     ->where('order_id', '=', $this->crud->getEntry($id)->order_id)
                     ->get();
        return $m_orders->toJson();

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        // return view($this->crud->getDetailsRowView(), $this->data);
    } 

    public function additem($order_id)
    {
        return view($this->crud->getCreateView(), $this->data);

    } 
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
}
