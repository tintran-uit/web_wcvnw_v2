<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;

class FarmerCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Farmer");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/farmer-item');
        $this->crud->setEntityNameStrings('farmer', 'farmers');

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
            'label' => 'Địa Chỉ',
        ]);
        $this->crud->addColumn([
            'name' => 'rating',
            'label' => 'Điểm',
        ]);
        $this->crud->addColumn([
            'name' => 'rating_count',
            'label' => 'Lượt đánh giá',
        ]);
        $this->crud->addColumn([
            'name' => 'photo',
            'label' => 'Ảnh',
        ]);

        // ------ CRUD FIELDS
         $this->crud->addField([
            'name' => 'name',
            'label' => 'Tên',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

       $this->crud->addField([    // TEXT
            'name' => 'phone',
            'label' => 'Điện Thoại',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
       $this->crud->addField([    // TEXT
            'name' => 'address',
            'label' => 'Địa Chỉ',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-10'
            ],
        ]);
       $this->crud->addField([    // TEXT
            'name' => 'short_address',
            'label' => 'Địa Chỉ Ngắn',
            'type' => 'text',
            'placeholder' => 'Địa chỉ này sẽ hiển thị cho người dùng',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-10'
            ],
        ]);
        $this->crud->addField([   // WYSIWYG
            'name' => 'product_list',
            'label' => 'Các sản phẩm nuôi trồng',
            'type' => 'textarea',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-10'
            ],
            'placeholder' => 'Các sản phẩm nuôi trồng',
        ]);
        $this->crud->addField([   // WYSIWYG
            'name' => 'quality',
            'label' => 'Cam kết chất lượng',
            'type' => 'textarea',
            'placeholder' => 'Cam kết chất lượng',
        ]);

        $this->crud->addField([   // WYSIWYG
            'name' => 'profile',
            'label' => 'Thông Tin Nông Trại',
            'type' => 'ckeditor',
            'placeholder' => 'Your meta description here',
        ]);

        $this->crud->addField([   // WYSIWYG
            'name' => 'photo',
            'label' => 'Ảnh Nông Dân',
            'type' => 'browse',
            'placeholder' => 'Chọn hình ảnh cho sản phẩm',
        ]);


        $this->crud->enableAjaxTable();



        // ------ CRUD FIELDS

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
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
