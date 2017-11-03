@extends('layouts.farmer')

@section('content')
<div class="box-header with-border">
    <h3>CẬP NHẬT SẢN LƯỢNG TUẦN SAU</h3>
</div>

<form class="box-body table-responsive" method="POST" action="{{url('')}}/farmer/sell-update">
<div style="width:100%; margin-bottom: 10px; float: right;">
	<button type="submit" class="btn btn-success" style="float: right;">
            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
            <span data-value="save_and_back">Cập nhật sản lượng</span>
    </button>
</div>
<table id="crudTable" class="table table-bordered table-striped display dataTable" role="grid" aria-describedby="crudTable_info">
    <thead>
    	<tr>
	    	<th>STT</th>
	    	<th>Tên nông sản</th>
	    	<th>Trạng thái</th>
	    	<th>Ngày giao hàng</th>
	    	<th>Đơn vị</th>
	    	<th>Sản lượng</th>
	    	<th style="display:none;"></th>
	    </tr>
    </thead>
    <tbody>
    	<?php $i=1; $delivery_date = date("d-m-Y",strtotime('Saturday +2 week'));?>
    	@foreach($products as $product)
    	<tr>
    		<td class="text-center">{{$i}}</td>
    		<td>{{$product->product_name}}</td>
    		<td>@if($product->status==1) Đang bán @else Chưa bán @endif</td>
    		<td>{{$delivery_date}}</td>
    		<td>{{$product->unit}}</td>
    		<td class="text-center"><input type="number" name="date{{$product->product_id}}" value="{{$product->capacity}}" style="text-align: center;"></td>
    		<td style="display:none;">{{$product->product_id}}</td>
    	</tr>
    	<?php $i++; ?>
    	@endforeach
    </tbody>
</table>
</form>

@endsection