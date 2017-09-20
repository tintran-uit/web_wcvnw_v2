<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

class ShipperCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Shipper");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/shipper-item');
        $this->crud->setEntityNameStrings('shipper', 'shippers');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 1);

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Tên',
        ]);
        $this->crud->addColumn([
            'name' => 'phone',
            'label' => 'Điện Thoại',
        ]);
        $this->crud->addColumn([
            'name' => 'address',
            'label' => 'Địa chỉ',
        ]);
        $this->crud->addColumn([
            'name' => 'transaction_count',
            'label' => 'Đã vận chuyển',
        ]);

        $this->crud->addColumn([
            'name' => 'rating',
            'label' => 'Điểm',
        ]);
        $this->crud->addColumn([
            'name' => 'photo',
            'label' => 'Hình Ảnh',
        ]);

        // ------ CRUD FIELDS
       $this->crud->addField([
            'name' => 'name',
            'label' => 'Tên',
        ]);
        $this->crud->addField([
            'name' => 'phone',
            'label' => 'Điện Thoại',
        ]);
        $this->crud->addField([
            'name' => 'address',
            'label' => 'Địa chỉ',
        ]);

        $this->crud->addField([
            'name' => 'photo',
            'label' => 'Hình Ảnh',
            'type' => 'browse',
        ]);
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
