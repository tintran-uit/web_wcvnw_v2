<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

class FarmingCrudController extends CrudController
{

    public function setUp()
    {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Farming");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/farmer-farming');
        $this->crud->setEntityNameStrings('farming', 'farmings');

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
            'name' => 'farmer_id',
            'label' => 'Trang Trại',
            'type' => 'select',
            'entity' => 'farmer',
            'attribute' => 'name',
            'model' => "App\Models\Farmer",
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
            'name' => 'capacity',
            'label' => 'Sản Lượng ngày',
        ]);
        $this->crud->addColumn([
            'name' => 'unit',
            'label' => 'Đơn vị',
            'default'    => 'kg',
        ]);

        $this->crud->addColumn([
            'name' => 'harvest_period',
            'label' => 'Thu hoạch trong',
        ]);


        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Trạng Thái',
        ]);

        // ------ CRUD FIELDS
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
            'name' => 'capacity',
            'label' => 'Sản Lượng',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);
        $this->crud->addField([
            'name' => 'unit',
            'label' => 'Đơn vị',
            'type' => 'text',
            'default'    => 'kg',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        $this->crud->addField([
            'name' => 'harvest_period',
            'label' => 'Thu hoạch trong',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Trạng Thái',
            'type' => 'text',
            'default'    => '0',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
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
