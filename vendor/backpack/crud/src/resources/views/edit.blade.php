@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    {{ trans('backpack::crud.edit') }} <span>{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
@if($crud->entity_name_plural != "orders")
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif

		@include('crud::inc.grouped_errors')

		  {!! Form::open(array('url' => $crud->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$crud->hasUploadFields('update', $entry->getKey()))) !!}
		  <div class="box">
		    <div class="box-header with-border">
		    	@if ($crud->model->translationEnabled())
			    	<!-- Single button -->
					<div class="btn-group pull-right">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
					  	@endforeach
					  </ul>
					</div>
					<h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3>
				@else
					<h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
				@endif
		    </div>
		    <div class="box-body row">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
		      @endif
		    </div><!-- /.box-body -->

            <div class="box-footer">

                @include('crud::inc.form_save_buttons')

		    </div><!-- /.box-footer-->
		  </div><!-- /.box -->
		  {!! Form::close() !!}
	</div>
</div>
@else
<style type="text/css">
textarea.form-control {
	height: 105px;
}
</style>
<link href="{{url('')}}/assets/stylesheets/main.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.min.css" rel="stylesheet" type="text/css" />
<script src="{{url('')}}/assets/javascripts/vendor/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- <script src="{{url('')}}/vendor/backpack/xlsx/xlsx.core.min.js"></script>
<script src="{{url('')}}/vendor/backpack/xlsx/blob.min.js"></script>
<script src="{{url('')}}/vendor/backpack/xlsx/fileSaver.min.js"></script>
<script src="{{url('')}}/vendor/backpack/xlsx/tableexport.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.3.7/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.2/xlsx.core.min.js"></script>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif

		@include('crud::inc.grouped_errors')

		  {!! Form::open(array('url' => $crud->route.'/'.$entry->getKey(), 'method' => 'put', 'files'=>$crud->hasUploadFields('update', $entry->getKey()))) !!}
		  <div class="box">
		    <div class="box-header with-border">
		    	@if ($crud->model->translationEnabled())
			    	<!-- Single button -->
					<div class="btn-group pull-right">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
					  	@endforeach
					  </ul>
					</div>
					<h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3>
				@else
					<h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
				@endif
		    </div>
		    <div class="box-body row">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
		      @endif
		    </div><!-- /.box-body -->

            <div class="box-footer">

                @include('crud::inc.form_save_buttons')
		   <h3><b>Chi tiết đơn hàng:</b></h3>
		   <div>
		   <div class="col-md-1 vcenter">
		   <a href="#" class="btn btn-primary ladda-button" data-style="zoom-in" data-toggle="modal" data-target="#modal-add-item"><span class="ladda-label"><i class="fa fa-plus"></i> Thêm</span></a>
			</div>
			<div class="col-md-2 vcenter">
	            <a class="btn btn-default xlsx" onclick="exportExcell()" style="margin-top: -10px;">Xuất hóa đơn (.xlsx)</a>
	        </div>
	    </div>
		  <table id="tbSupp" class="table table-bordered table-striped display">
            <thead>
              <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Trang trại</th>
                <th>Đơn vị</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Ghi chú</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              </tr>
            	<tr><td colspan="8"></td>
              </tr>
              <tr>
                <td colspan="5" align="right" style="padding-right: 20px">Khuyến mãi:</td>
                <td colspan="2" style="float: right; width: 100%;">0 VNĐ</td>
                <td></td>
              </tr>
              <tr>
                <td colspan="5" align="right" style="padding-right: 20px">Phí vận chuyển:</td>
                <td colspan="2" style="float: right;width: 100%;"><span id="tbshipping_cost"></span></td>
                <td></td>
              </tr>
              <tr>
                <td colspan="5" align="right" style="padding-right: 20px;">Tổng tiền:</td>
                <td colspan="2" style="float: right;width: 100%;"><span id="tbtotal"></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>

          </div><!-- /.box-footer-->
		  </div><!-- /.box -->
		  {!! Form::close() !!}

	</div>
</div>

<?php 
$products = DB::select('SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND tr.`status` = 1 AND f.`id` = tr.`farmer_id` ORDER BY tr.`priority` ASC');
?>
<!-- Modal add item -->
<div class="modal fade style-base-modal" id="modal-add-item" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container">
        <div class="modal-header" style="background-color: #f9f9f9">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title email-icon" id="modalResetPsw">Thêm sản phẩm</h4>
        </div>

        <div class="modal-body clearfix">

          	<div class="form-group col-md-3">
			    <label>Sản phẩm:</label>
		        <select name="product_id" class="form-control">
		        	@foreach($products as $product)
	                <option value="{{$product->id}}">{{$product->name}}</option>
	                @endforeach
	            </select>
			</div>

			<div class="form-group col-md-3">
			    <label>Sản lượng:</label>
			<div class="stepper col-sm-5 vcenter"><input type="text" class="form-control stepper-input text-center" id="stepper" value="1 gói" min="1" max="1000"><span class="stepper-arrow up" onclick="stepperUp()">Up</span><span class="stepper-arrow down" onclick="stepperDown()">Down</span></div>
			</div>
    
		</div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	loaditems();
	function loaditems() {
	  var order_id = $("input[name=order_id]").val();
	  var url = '/api/orderitems/order_id='+order_id;
	  // alert(order_id);
	  jQuery("#tbSupp tbody").empty();
	  $.ajaxSetup({ cache: false });
	  var newRowContent = '';
	  $.getJSON(url, function(data){
	        $.each(data, function(index, data){ 
	              
	              newRowContent += '<tr data-entry-id=\"122\" role=\"row\" class=\"odd\">\r\n  <td>'+(index+1)+'<\/td>                    \r\n<td>'+data.product_name+'<\/td>\r\n<td>'+data.product_name+'<\/td>                    \r\n <td>'+data.unit+'<\/td>                    \r\n<td>'+data.quantity+'<\/td>                    \r\n<td>'+data.price+' VNĐ\r\n<td></td>\r\n <\/tr>';
	            });
	              jQuery("#tbSupp tbody").append(newRowContent);

	     }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
	         alert("Vui lòng kiểm tra kết nối internet.");
	     });

	  var shipping_cost = $("input[name=shipping_cost]").val();
	  var total = $("input[name=total]").val();
	  $('#tbshipping_cost').html(shipping_cost+' VNĐ');
	  $('#tbtotal').html(total+' VNĐ');
	}

function exportExcell() {
	 
    alasql('SELECT * INTO XLSX("myinquires.xlsx",{headers:true, footers:true}) \
                    FROM HTML("#tbSupp",{headers:true, footers:true})');

}

</script>
@endif
@endsection

@section('after_scripts')

@endsection