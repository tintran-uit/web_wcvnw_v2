<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use DB;
use Intervention\Image\Facades\Image as FileImage;

class ProductCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Product");
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/product-item');
        $this->crud->setEntityNameStrings('product', 'products');

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
            'name' => 'id',
            'label' => 'ID',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Tên SP',
        ]);
        $this->crud->addColumn([
            'name' => 'price_old',
            'label' => 'Giá Gói Bán Lẻ',
        ]);

        $this->crud->addColumn([
            'name' => 'farmer_id',
            'label' => 'Nông Trại',
            'type' => 'select',
            'entity' => 'farmer', 
            'attribute' => 'name', 
            'model' => "App\Models\Farmer", // foreign key model
        ]);
        $this->crud->addColumn([
            'name' => 'brand_id',
            'label' => 'Nhãn SP',
            'type' => 'select',
            'entity' => 'brand', 
            'attribute' => 'name', 
            'model' => "App\Models\Brand", // foreign key model
        ]);

//--------CRUD Fields
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Tên Sản Phẩm',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);
        $this->crud->addField([
            'name' => 'en_name',
            'label' => 'Tên Tiếng Anh',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);
        $this->crud->addField([
            'name' => 'price_old',
            'label' => 'Giá Gói Bán Lẻ',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Nhóm Sản Phẩm',
            'type' => 'select2',
            'name' => 'category', // the method that defines the relationship in your Model
            'entity' => 'categories', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Category", // foreign key model
            // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Nhãn Sản Phẩm',
            'type' => 'select2',
            'name' => 'brand_id', // the method that defines the relationship in your Model
            'entity' => 'brand', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Brand", // foreign key model
            // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => 'Nông trại',
            'type' => 'select2',
            'name' => 'farmer_id', // the method that defines the relationship in your Model
            'entity' => 'farmer', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Farmer", // foreign key model
            // 'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'wrapperAttributes' => [
                'class' => 'form-group col-md-5'
            ],
        ]);

        $this->crud->addField([   // WYSIWYG
            'name' => 'short_description',
            'label' => 'Mô Tả Ngắn',
            'type' => 'summernote',
            'placeholder' => 'Mô Tả ngắn sản phẩm',
        ]);
        $this->crud->addField([   // WYSIWYG
            'name' => 'en_short_description',
            'label' => 'Mô Tả Tiếng Anh',
            'type' => 'summernote',
            'placeholder' => 'Mô Tả ngắn sản phẩm',
        ]);
        $this->crud->addField([   // WYSIWYG
            'name' => 'description',
            'label' => 'Mô Tả chi tiết',
            'type' => 'ckeditor',
            'placeholder' => 'Liệt kê những mô tả chi tiết sản phẩm',
        ]);
        $this->crud->addField([   // WYSIWYG
            'name' => 'en_description',
            'label' => 'Mô Tả dài tiếng anh',
            'type' => 'ckeditor',
            'placeholder' => 'Liệt kê những mô tả chi tiết sản phẩm',
        ]);

        $this->crud->addField([   // WYSIWYG
            'name' => 'image',
            'label' => 'Ảnh Sản Phẩm',
            'type' => 'browse',
            'placeholder' => 'Chọn hình ảnh cho sản phẩm',
        ]);

        $this->crud->addField([   // WYSIWYG
            'name' => 'thumbnail',
            'label' => 'thumbnail',
            'type' => 'hidden',
        ]);

        // $this->crud->enableAjaxTable();

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

        // your additional operations before save here
        $img = $request->image;
        
        //create thumbnails
        $thumbName = str_replace("images","thumbnails",$img);
        $request->request->set('thumbnail', $thumbName);

        // $imgThumb = $this->attachmentThumb($img, $thumbName, 261, 174);
       
        $this->data['thumbnail'] = $thumbName;

        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $img = $request->image;
        
        //create thumbnails
        $thumbName = str_replace("images","thumbnails",$img);
        $request->request->set('thumbnail', $thumbName);
        // $imgThumb = $this->attachmentThumb($img, $thumbName, 261, 174);
        
        $this->data['thumbnail'] = $thumbName;
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }

    public function attachmentThumb($input, $thumbName, $width, $height)
    {
        $img = FileImage::make($input);
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($thumbName);
        return $img;
    }
}
