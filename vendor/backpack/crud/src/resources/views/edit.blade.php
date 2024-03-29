@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Cfarm.vn
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
@if($crud->entity_name_plural == "orders")
<style type="text/css">
textarea.form-control {
  height: 182px;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.min.css" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="{{url('')}}/assets/stylesheets/vendor/print-friendly/custom.css"> -->
<script src="{{url('')}}/assets/javascripts/vendor/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.3.7/alasql.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.2/xlsx.core.min.js"></script> -->
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
                <hr>
       <h3><b>Chi tiết đơn hàng:</b></h3>
       <div>
       <div class="col-md-2 vcenter">
       <a href="#" class="btn btn-primary ladda-button" data-style="zoom-in" data-toggle="modal" data-target="#modal-add-item"><span class="ladda-label"><i class="fa fa-plus"></i> Thêm/sửa</span></a>
      </div>
      <div class="btn-group">
            <a class="btn btn-success">
                <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
                <span data-value="save_and_back">Chuyển đơn hàng:</span>
            </a>

            <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aira-expanded="false" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Save Dropdown</span>
            </a>

            <?php
              // $date1 = date("Y-m-d",strtotime('Saturday +1 week'));
              // $date2 = date("Y-m-d",strtotime('Saturday +2 week'));
              // $date2 = $date2->format('Y-m-d');
            ?>

            <ul class="dropdown-menu" style="background-color: #008d4c; color: #ffffff">
                    <li><a href="{{url('')}}/admin/set-delivery-date/order-id={{$fields['order_id']['value']}}&date=1" data-value="save_and_edit" style="color: #ffffff">+1 Tuần</a></li>
                    <li><a href="{{url('')}}/admin/set-delivery-date/order-id={{$fields['order_id']['value']}}&date=2" data-value="save_and_new" style="color: #ffffff">+2 Tuần</a></li>
                </ul>
        </div>
      <div class="col-md-2 vcenter">
              <!-- <a class="btn btn-default xlsx" onclick="exportExcell()">Xuất hóa đơn (.xlsx)</a> -->
              <a href="https://www.printfriendly.com" class="btn btn-default xlsx" onclick="window.print();return false;">Xuất hóa đơn (.xlsx)</a>
              <script>
                var headCode = '<div class="print-head text-center"><span class="print-title">Cfarm.vn</span><b><i>Kết nối lương nông - An lòng nội trợ</i></b><br><img id="pf-src-icon" src="http://cfarm.vn/assets/images/favicon/favicon-96x96.png" class="non-delete"></div>';
              var pfHeaderImgUrl = '';var pfHeaderTagline = headCode;var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '{{url('')}}/assets/stylesheets/vendor/print-friendly/custom.css';var pfBtVersion='1';(function(){var js,pf;pf=document.createElement('script');pf.type='text/javascript';pf.src='{{url('')}}/assets/javascripts/vendor/print-friendly/custom.js';document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
          </div>

      </div>
      <table id="tbSupp" class="table table-bordered table-striped display" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>STT</th>
                <th>Gói/lẻ</th>
                <th>Sản phẩm</th>
                <th>Trang trại</th>
                <th>Đơn vị</th>
                <th>SL đặt mua</th>
                <th>SL thực tế</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              
            </tfoot>
          </table>

          </div><!-- /.box-footer-->
      </div><!-- /.box -->
      {!! Form::close() !!}

  </div>
</div>

<?php 
$order_id = $fields['order_id']['value'];
$language = $fields['language']['value'];
if( $language == 'en') {
  $products = DB::select('SELECT f.`en_name` "farmer_name", f.`id` "farmer_id", p.`en_name` "name", tr.`price` "price", 
                               p.`id` "id", tr.`unit` "unit", p.`category` "category", m.`quantity` "quantity", 
                               m.`order_type` "order_type", tr.`unit_quantity` "unit_quantity", m.`price` "m_price", 
                               p.`thumbnail` "product_thumbnail" 
                          FROM `m_orders` m, `products` p, `farmers` f, `g_orders` g, `trading` tr 
                         WHERE p.`id` = m.`product_id` 
                           AND f.`id` = m.`farmer_id` 
                           AND m.`order_id` = ? 
                           AND g.`order_id` = m.`order_id`
                           AND g.`delivery_date` = tr.`delivery_date`
                           AND tr.`product_id` = p.`id`
                      ORDER BY p.`category` DESC', [$order_id]);
}
else {
  $products = DB::select('SELECT f.`en_name` "farmer_name", f.`id` "farmer_id", p.`en_name` "name", tr.`price` "price", 
                               p.`id` "id", tr.`unit` "unit", p.`category` "category", m.`quantity` "quantity", 
                               m.`order_type` "order_type", tr.`unit_quantity` "unit_quantity", m.`price` "m_price", 
                               p.`thumbnail` "product_thumbnail" 
                          FROM `m_orders` m, `products` p, `farmers` f, `g_orders` g, `trading` tr 
                         WHERE p.`id` = m.`product_id` 
                           AND f.`id` = m.`farmer_id` 
                           AND m.`order_id` = ? 
                           AND g.`order_id` = m.`order_id`
                           AND g.`delivery_date` = tr.`delivery_date`
                           AND tr.`product_id` = p.`id`
                      ORDER BY p.`category` DESC', [$order_id]);
}

/*for($x=0; $x<count($products); $x++) {
    if($products[$x]->category==0){
        $order_type = $products[$x]->order_type.' AS "order_type"';
        $items = DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "name", 
                                            p.`id` "product_id", m.`quantity` "quantity", "" AS "order_quantity", '.$order_type.', m.`unit` "unit", m.`price` "price", p.`category` "category", p.`id` "id", p.`unit_quantity` "unit_quantity"
                                      FROM `m_packages` m, `products` p, `farmers` f, `g_orders` g
                                     WHERE p.`id` = m.`product_id` 
                                       AND f.`id` = m.`farmer_id` 
                                       AND m.`delivery_date` = g.`delivery_date`
                                       AND g.`order_id` = ?
                                       AND m.`package_id` = ?',[$order_id, $products[$x]->id]);
         unset($products[$x]);
        $products += $items;
    }
}*/

$mySQL = 'SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", tr.`price` "price", tr.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", 0 AS "order_type", tr.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND tr.`status` = 1 AND f.`id` = tr.`farmer_id` ';

foreach ($products as $item) {
  $mySQL = $mySQL.'AND p.`id` != '.$item->id.' ';
}

$mySQL = $mySQL.'ORDER BY p.`name` ASC';

$products = array_merge($products, DB::select($mySQL));
?>
<!-- Modal add item -->
<div class="modal fade style-base-modal" id="modal-add-item" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" style="width: 55%">
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

            <form action="#" accept-charset="UTF-8" class="form-style-base">
                     <input type="hidden" name="_method" value="delete">
                     <fieldset class="buttons">
                        <div class="pull-right">
                           <a class="btn btn-info text-uppercase" href="#" onclick="addItems();">Chỉnh sửa xong</a>
                        </div>
                     </fieldset>
                     <fieldset>
                        <div class="table-responsive">
                           <table id="cartTable" class="table table-bordered table-striped" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th class="bg-extra-light-grey col-md-1 col-xs-1">STT</th>
                                    <th class="bg-extra-light-grey">Sản Phẩm</th>
                                    <th class="bg-extra-light-grey col-md-2 col-xs-1">Số Lượng</th>
                                    <th class="bg-extra-light-grey">Giá</th>
                                    <th class="bg-extra-light-grey" style="display:none;">Thành tiền</th>
                                    <th class="bg-extra-light-grey">Hình thức</th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; ?>
                              @foreach($products as $item)
                                 <tr class="">
                                    <td class="align-middle">
                                      {{$i}}
                                    </td>
                                    <td class="align-middle">
                                       <div style="width: auto;">{{$item->name}}</div>
                                    </td>
                                    <td class="align-middle text-center" style="text-align: center; ">
                                       <div class="stepper" style="width: 100%"><input type="text" class="form-control stepper-input text-center" value="@if(isset($item->quantity)) {{$item->quantity}} @else 0 @endif {{$item->unit}}" ><span class="stepper-arrow up">Up</span><span class="stepper-arrow down">Down</span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                       {{number_format($item->price)}} VND
                                    </td>
                                    <td class="align-middle text-center" style="display:none;">
                                       @if(isset($item->m_price)) {{$item->m_price}} @endif VND
                                    </td>
                                    <td class="align-middle text-center">
                                        <label class="radio-inline"><input type="radio" name="order_type{{$i}}" class="order_type" value="0" @if($item->order_type==0) checked @endif>Bán</label>
                                        <label class="radio-inline"><input type="radio" name="order_type{{$i}}" class="order_type" value="1" @if($item->order_type==1) checked @endif>Tặng</label>
                                        <label class="radio-inline"><input type="radio" name="order_type{{$i}}" class="order_type" value="2" @if($item->order_type==2) checked @endif>Gốc</label>  
                                        <label class="radio-inline"><input type="radio" name="order_type{{$i}}" class="order_type" value="3" @if($item->order_type==3) checked @endif>Sỉ</label>
                                        <label class="radio-inline"><input type="radio" name="order_type{{$i}}" class="order_type" value="4" @if($item->order_type==4) checked @endif>Gói</label>                    
                                    </td>
                                    <td style="display:none;">@if(isset($item->quantity)) {{$item->quantity}} @else 0 @endif</td>
                                    <td style="display:none;">{{$item->unit_quantity}}</td>
                                    <td style="display:none;">{{$item->unit}}</td>
                                    <td style="display:none;">{{$item->id}}</td>
                                    <td style="display:none;">{{$item->farmer_id}}</td>
                                 </tr>
                                 <?php $i++;?>
                                 @endforeach
                                 
                              </tbody>
                              <tfoot>
                                 <tr>
                                   <td colspan="4" align="right" style="padding-right: 20px"><b>Tổng Tiền</b>  </td>
                                   <td colspan="2" style="padding-left: 20px"><span id="total"></span></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </fieldset>
                     <hr>
                     
                  </form>

    </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  loaditems();
  var customer = $("input[name=delivery_name]").val();
  var order_id = $("input[name=order_id]").val();
  var note = $("textarea[name=note]").val();

  function loaditems() {
    var order_id = $("input[name=order_id]").val(); 
    var url = '/api/orderitems/order_id='+order_id;
    var shipping_cost = $("input[name=shipping_cost]").val();
    var total = $("input[name=total]").val();
    var delivery_phone = $("input[name=delivery_phone]").val();
    var delivery_address = $("input[name=delivery_address]").val();
    var payment = $("input[name=payment]").val();
    var balance = $("select[name=customer_id] option:selected").text();
    // alert(order_id);
    jQuery("#tbSupp tbody").empty();
    $.ajaxSetup({ cache: false });
    var newRowContent = '';
    $.getJSON(url, function(data0){
        var n = Object.keys(data0).length
        var countGoi = 0;
        var countGoiItem = 0;
        //dem goi
        for(var i = 0; i<n; i++){
          if(data0[i].category==0){
            countGoi++;
            countGoiItem = countGoiItem + Object.keys(data0[i].items).length;
          }
        }
        console.log(countGoiItem);
        var countLe = n - countGoi;
        var firstGoi = 0;
        var firstLe = 0;
        var stt = 1;
          $.each(data0, function(index, data){ 
            
                  if(data.order_type==4){
                  //them goi
                     // if(firstGoi==0){
                      $.each(data.items, function(index, data2){
                        if(firstGoi==0){
                          newRowContent += '<tr role=\"row\" class=\"odd\">\r\n  <td>'+stt+'<\/td>\r\n<td style="vertical-align: inherit;" rowspan="'+Object.keys(data.items).length+'">Gói</td>  \r\n<td>'+data2.product_name+'<\/td>\r\n<td>'+data2.farmer_name+'<\/td>      \r\n <td>'+data2.unit+'<\/td>                    \r\n<td>'+data2.quantity+'<\/td>   \r\n  <td class="quantity">'+data2.quantity+'    \r\n<td style="vertical-align: inherit;" rowspan="'+Object.keys(data.items).length+'">'+numberWithCommas(data.price, data.order_type)+'</td>\r\n <\/tr>';
                          stt++;
                          firstGoi++;
                        }else{
                          newRowContent += '<tr role=\"row\" class=\"odd\">\r\n  <td>'+stt+'<\/td>\r\n<td style="display:none;"></td>  \r\n<td>'+data2.product_name+'<\/td>\r\n<td>'+data2.farmer_name+'<\/td>      \r\n <td>'+data2.unit+'<\/td>                    \r\n<td>'+data2.quantity+'<\/td>  \r\n  <td class="quantity">'+data2.quantity+'     \r\n<td style="display:none;"></td>\r\n <\/tr>';
                          stt++;
                        }

                      });
                      firstGoi=0;
                  
                }else{
                  // them le
                    if(firstLe==0){
                      newRowContent += '<tr role=\"row\" class=\"odd\">\r\n  <td>'+stt+'<\/td>\r\n<td style="vertical-align: inherit;" rowspan="'+countLe+'">Lẻ</td>  \r\n<td>'+data.product_name+'<\/td>\r\n<td>'+data.farmer_name+'<\/td>      \r\n <td>'+data.unit+'<\/td>                    \r\n<td>'+data.order_quantity+'<\/td>\r\n  <td class="quantity">'+data.quantity+'</td>     \r\n<td>'+numberWithCommas(data.price, data.order_type)+'</td>\r\n <\/tr>';
                      firstLe++;
                      stt++;
                    }else{
                      newRowContent += '<tr role=\"row\" class=\"odd\">\r\n  <td>'+stt+'<\/td><td style="display:none;"><\/td>  \r\n<td>'+data.product_name+'<\/td>\r\n<td>'+data.farmer_name+'<\/td>      \r\n <td>'+data.unit+'<\/td>                    \r\n<td>'+data.order_quantity+'<\/td>   \r\n  <td class="quantity">'+data.quantity+'    \r\n<td>'+numberWithCommas(data.price, data.order_type)+'</td>\r\n <\/tr>';
                      stt++;
                    }
                }
              });
            newRowContent += '<tr><td style="display:none;"><\/td><td style="display:none;"><\/td><td style="display:none;"><\/td><td colspan=\"4\"><\/td>\r\n<td colspan=\"2\" align=\"right\" style=\"padding-right: 20px\">Khuy\u1EBFn m\u00E3i:<\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" style=\"float: right; width: 100%;\">0 <\/td>\r\n<td><\/td>\r\n<\/tr>\r\n<tr><td style="display:none;"><\/td><td style="display:none;"><\/td><td style="display:none;"><\/td><td colspan=\"4\"><\/td>\r\n<td colspan=\"2\" align=\"right\" style=\"padding-right: 20px\">Ph\u00ED v\u1EADn chuy\u1EC3n:<\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" style=\"float: right;width: 100%;\"><span id=\"tbshipping_cost\">'+numberWithCommas(shipping_cost)+' VND<\/span><\/td>\r\n<td><\/td>\r\n<\/tr>\r\n<tr><td style="display:none;"><\/td><td style="display:none;"><\/td><td style="display:none;"><\/td><td colspan=\"4\" rowspan="2"><\/td>\r\n<td colspan=\"2\" align=\"right\" style=\"padding-right: 20px\">Tài khoản KH còn:<\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" style=\"float: right;width: 100%;\"><span id=\"tbshipping_cost\">'+numberWithCommas(balance)+' VND<\/span><\/td>\r\n<td><\/td>\r\n<\/tr>\r\n';
            if(payment==1){
              newRowContent += '<tr><td style="display:none;"><\/td><td style="display:none;"><\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" align=\"right\" style=\"padding-right: 20px;\">T\u1ED5ng ti\u1EC1n:<\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" style=\"float: right;width: 100%;\"><span class="quantity" id=\"tbtotal\">'+numberWithCommas(total)+' VND<\/span><\/td>\r\n<td><\/td>\r\n<\/tr>';
            }else{
              newRowContent += '<tr><td style="display:none;"><\/td><td style="display:none;"><\/td><td style="display:none;"><\/td>\r\n<td colspan=\"2\" align=\"right\" style=\"padding-right: 20px;\">T\u1ED5ng ti\u1EC1n:<\/td><td style="display:none;"><\/td>\r\n<td colspan=\"3\" style=\"\"><span class="quantity" id=\"tbtotal\"><strike>'+numberWithCommas(total)+' VND <\/strike> (chuyển khoản)<\/span><\/td>\r\n<\/tr>';
            }
            /*newRowContent += '<tr><td colspan=\"9\"><\/td><\/tr>\r\n<tr>\r\n<td colspan=\"9\">Kh\u00E1ch h\u00E0ng: '+customer+' - S\u0110T: '+delivery_phone+'<\/td>\r\n<\/tr>\r\n<tr>\r\n<td colspan=\"9\">\u0110\u1ECBa ch\u1EC9: '+delivery_address+'<\/td>\r\n<\/tr>';*/
            newRowContent += '<tr>\r\n<td colspan=\"9\">Kh\u00E1ch h\u00E0ng: '+customer+' - S\u0110T: '+delivery_phone+'<\/td>\r\n<\/tr>\r\n<tr>\r\n<td colspan=\"9\">\u0110\u1ECBa ch\u1EC9: '+delivery_address+'<\/td>\r\n<\/tr>';
            newRowContent += '<tr class="quantity">\r\n<td colspan=\"9\">Ghi chú: '+note+'<\/td>\r\n<\/tr>';
                jQuery("#tbSupp tbody").append(newRowContent);

       }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
           alert("Vui lòng kiểm tra kết nối internet.");
       });

  }
function exportExcell() {

  var filename = customer + '_' + order_id;
    alasql('SELECT * INTO XLSX("'+filename+'.xlsx",{headers:true, footers:true}) \
                    FROM HTML("#tbSupp",{headers:true, footers:true})');

}

function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }

function numberWithCommas(x, order_type) {
            if(order_type==1)
            {
              return "(tặng)";
            }
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }

</script>




<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->
<!-- chinh sua goi -->

@elseif($crud->entity_name_plural == "packages")
<style type="text/css">
textarea.form-control {
  height: 105px;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.min.css" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="{{url('')}}/assets/stylesheets/vendor/print-friendly/custom.css"> -->
<script src="{{url('')}}/assets/javascripts/vendor/jquery-2.1.3.min.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.3.7/alasql.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.9.2/xlsx.core.min.js"></script> -->
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
<?php 
$delivery_date = date('Y-m-d', strtotime("last Saturday"));
$packageID = $fields['id']['value'];
$products =  DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "product_name", 
                                            p.`id` "product_id", m.`quantity` "quantity", "" AS "order_quantity", m.`unit` "unit", m.`price` "price", p.`thumbnail` "product_thumbnail" 
                                      FROM `m_packages` m, `products` p, `farmers` f, `g_orders` g
                                     WHERE p.`id` = m.`product_id` 
                                       AND f.`id` = m.`farmer_id` 
                                       AND m.`delivery_date` = ?
                                       AND m.`package_id` = ?',[$delivery_date, $packageID]);

// for($x=0; $x<count($products); $x++) {
//     if($products[$x]->category==0){
//         // $items =  DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "name", p.`price` "price", p.`id` "id", p.`unit` "unit", p.`category` "category", m.`quantity` "quantity", p.`unit_quantity` "unit_quantity", m.`price` "m_price", p.`thumbnail` "product_thumbnail" FROM m_packages m, products p, farmers f 
//         //    WHERE p.`id` = m.`product_id` 
//         //    AND f.`id` = m.`farmer_id` 
//         //    AND m.`package_id` = ?',[$products[$x]->id]);
//         $items = DB::select('SELECT f.`name` "farmer_name", f.`id` "farmer_id", p.`name` "name", 
//                                             p.`id` "product_id", m.`quantity` "quantity", "" AS "order_quantity", m.`unit` "unit", m.`price` "price", p.`category` "category", p.`id` "id", p.`unit_quantity` "unit_quantity"
//                                       FROM `m_packages` m, `products` p, `farmers` f, `g_orders` g
//                                      WHERE p.`id` = m.`product_id` 
//                                        AND f.`id` = m.`farmer_id` 
//                                        AND m.`delivery_date` = g.`delivery_date`
//                                        AND g.`order_id` = ?
//                                        AND m.`package_id` = ?',[$order_id, $products[$x]->id]);
//         unset($products[$x]);
//         $products += $items;
//     }
// }

// $mySQL = 'SELECT tr.`farmer_id` "farmer_id", f.`name` "farmer_name", p.`id` "id" ,p.`name` "name", p.`slug` "slug", p.`image` "image", p.`thumbnail` "thumbnail", p.`price` "price", p.`unit_quantity` "unit_quantity", IF(tr.`capacity` - tr.`sold` - p.`unit_quantity` <= 0, 0, round(tr.`capacity` - tr.`sold`, 1)) AS "quantity_left", p.`unit` "unit", p.`brand_id` "label"  FROM `products` p, `trading` tr, `farmers` f WHERE tr.`product_id` = p.`id` AND tr.`status` = 1 AND f.`id` = tr.`farmer_id` ';

// foreach ($products as $item) {
//   $mySQL = $mySQL.'AND p.`id` != '.$item->id.' ';
// }

// $mySQL = $mySQL.'ORDER BY p.`name` ASC';

// $products = array_merge($products, DB::select($mySQL));
?>


            <div class="box-footer">

                @include('crud::inc.form_save_buttons')
                <hr>
       <h3><b>Chi tiết đơn hàng:</b></h3>
       <div>
       <div class="col-md-2 vcenter">
       <a href="#" class="btn btn-primary ladda-button" data-style="zoom-in" data-toggle="modal" data-target="#modal-add-item"><span class="ladda-label"><i class="fa fa-plus"></i> Thêm/sửa</span></a>
      </div>

      </div>
      <table id="tbSupp" class="table table-bordered table-striped display" style="margin-top: 10px;">
            <thead>
              <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Trang trại</th>
                <th>Đơn vị</th>
                <th>sản lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach($products as $product)
              <tr>
                <td>{{$i}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->farmer_name}}</td>
                <td>{{$product->unit}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->quantity}}</td>
              </tr>
              <?php $i++; ?>
              @endforeach
            </tbody>
            <tfoot>
              
            </tfoot>
          </table>

          </div><!-- /.box-footer-->
      </div><!-- /.box -->
      {!! Form::close() !!}

  </div>
</div>


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

            <form action="#" accept-charset="UTF-8" class="form-style-base">
                     <input type="hidden" name="_method" value="delete">
                     <fieldset class="buttons">
                        <div class="pull-right">
                           <a class="btn btn-info text-uppercase" href="#" onclick="addItems();">Chỉnh sửa xong</a>
                        </div>
                     </fieldset>
                     <fieldset>
                        <div class="table-responsive">
                           <table id="cartTable" class="table table-bordered table-striped" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th class="bg-extra-light-grey col-md-1 col-xs-1">STT</th>
                                    <th class="bg-extra-light-grey">Sản Phẩm</th>
                                    <th class="bg-extra-light-grey col-md-2 col-xs-1">Số Lượng</th>
                                    <th class="bg-extra-light-grey">Giá</th>
                                    <th class="bg-extra-light-grey">Thành tiền</th>
                                    <th class="bg-extra-light-grey" style="display:none;">Xóa</th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                 </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; ?>
                              @foreach($products as $item)
                                 <tr class="">
                                    <td class="align-middle">
                                      {{$i}}
                                    </td>
                                    <td class="align-middle">
                                       <div style="width: auto;">{{$item->name}}</div>
                                    </td>
                                    <td class="align-middle text-center" style="text-align: center; ">
                                       <div class="stepper" style="width: 100%"><input type="text" class="form-control stepper-input text-center" value="@if(isset($item->quantity)) {{$item->quantity}} @else 0 @endif {{$item->unit}}" ><span class="stepper-arrow up">Up</span><span class="stepper-arrow down">Down</span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                       {{number_format($item->price)}} VND
                                    </td>
                                    <td class="align-middle text-center">
                                       @if(isset($item->m_price)) {{$item->m_price}} @endif VND
                                    </td>
                                    <td class="align-middle text-center" style="display:none;">
                                       <a class="btn btn-info text-center no-margin item-delete">                            <i class="fa fa-trash"></i>
                                       </a>                        
                                    </td>
                                    <td style="display:none;">@if(isset($item->quantity)) {{$item->quantity}} @else 0 @endif</td>
                                    <td style="display:none;">{{$item->unit_quantity}}</td>
                                    <td style="display:none;">{{$item->unit}}</td>
                                    <td style="display:none;">{{$item->id}}</td>
                                    <td style="display:none;">{{$item->farmer_id}}</td>
                                 </tr>
                                 <?php $i++;?>
                                 @endforeach
                                 
                              </tbody>
                              <tfoot>
                                 <tr>
                                   <td colspan="4" align="right" style="padding-right: 20px"><b>Tổng Tiền</b>  </td>
                                   <td colspan="2" style="padding-left: 20px"><span id="total"></span></td>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </fieldset>
                     <hr>
                     
                  </form>

    </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

</script>
@else
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



@endif
@endsection

@section('after_scripts2')
<!-- <script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/dataTables/editor.jqueryui.min.js"></script> -->
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/dataTables/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    // var ItemsUpload = ["order_id":order_id];
    var ItemsUpload = [];

$(document).ready(function() {

    var table = $('#cartTable').DataTable({searching: true, paging: false, "bInfo" : false});

    table.on( 'input', 'input.stepper-input' , function () {
         var msg;
         // var row = $(this).closest('tr').index();
         var tr = $(this).parents('tr');
    		var row = table.row( tr );
         // console.log(row[0][0]);
         var unit_quantity = table.row(row).data()[7];
         var unit = table.row(row).data()[8];
         var prodID = table.row(row).data()[9];
         var farmerID = table.row(row).data()[10];
         msg =  parseFloat($(this).val());
         msg = converQty(msg, unit_quantity, unit);
         // console.log(msg);
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         // row = 2;
         // table.cell(row, 4).data(numberWithCommas(price) + ' VND').draw();
         var index = row[0][0] + 1;
         var nameRadio = 'input[name=order_type'+index+']:checked';
         var order_type = $(nameRadio).val();
         console.log(nameRadio+'--'+order_type);
         var rowId = 0;
         updateCart(order_type, msg, prodID, unit_quantity, unit, farmerID);
      });

    table.on( 'click', 'input.order_type' , function () {
         var msg;
         // var row = $(this).closest('tr').index();
         var tr = $(this).parents('tr');
        var row = table.row( tr );
         // console.log(row);
         var unit_quantity = table.row(row).data()[7];
         var unit = table.row(row).data()[8];
         var prodID = table.row(row).data()[9];
         var farmerID = table.row(row).data()[10];
         $(this).closest('tr').find(':input[type=text]').each(function() {
            
            msg =  parseFloat($(this).val());
            // msg = stepperUp(msg, unit_quantity, unit); 
            // $(this).val(msg);
         });
         // console.log(msg+'---'+unit_quantity+'----'+unit);
         msg = converQty(msg, unit_quantity, unit);
         // console.log(msg);
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         // row = 2;
         var index = row[0][0] + 1;
         var nameRadio = 'input[name=order_type'+index+']:checked';
         var order_type = $(nameRadio).val();
         var rowId = 0;
         updateCart(order_type, msg, prodID, unit_quantity, unit, farmerID);
      });

    table.on( 'click', 'span.up' , function () {
         var msg;
         // var row = $(this).closest('tr').index();
         var tr = $(this).parents('tr');
    		var row = table.row( tr );
         // console.log(row);
         var unit_quantity = table.row(row).data()[7];
         var unit = table.row(row).data()[8];
         var prodID = table.row(row).data()[9];
         var farmerID = table.row(row).data()[10];
         $(this).closest('tr').find(':input[type=text]').each(function() {
            
            msg =  parseFloat($(this).val());
            msg = stepperUp(msg, unit_quantity, unit); 
            $(this).val(msg);
         });
         // console.log(msg+'---'+unit_quantity+'----'+unit);
         msg = converQty(msg, unit_quantity, unit);
         // console.log(msg);
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         // row = 2;
         var index = row[0][0] + 1;
         var nameRadio = 'input[name=order_type'+index+']:checked';
         var order_type = $(nameRadio).val();
         var rowId = 0;
         updateCart(order_type, msg, prodID, unit_quantity, unit, farmerID);
      });

    table.on( 'click', 'span.down' , function () {
         var msg;
         var tr = $(this).parents('tr');
    		var row = table.row( tr );
         var unit_quantity = table.row(row).data()[7];
         var unit = table.row(row).data()[8];
         var prodID = table.row(row).data()[9];
         var farmerID = table.row(row).data()[10];
         $(this).closest('tr').find(':input[type=text]').each(function() {
            
            msg =  parseFloat($(this).val());
            msg = stepperDown(msg, unit_quantity, unit); 

            $(this).val(msg);
         });
         msg = converQty(msg, unit_quantity, unit);
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         
         var index = row[0][0] + 1;
         var nameRadio = 'input[name=order_type'+index+']:checked';
         var order_type = $(nameRadio).val();
         var rowId = 0;
         updateCart(order_type, msg, prodID, unit_quantity, unit, farmerID);
      });
   

    function updateCart(order_type, qty, prodID, unit_quantity, unit, farmerID) {
      // console.log(qty)

      var markers = {"qty": qty, "prodID": prodID , "farmerID":farmerID, "order_type":order_type};
      console.log(ItemsUpload);
      var check = false;
      for(var i = 0; i<ItemsUpload.length; i++){
      	if(ItemsUpload[i].prodID==prodID){
          ItemsUpload[i].qty = qty;
      		ItemsUpload[i].order_type = order_type;
      		check = true;
      		// break; 
      	}
      }
      if(!check){
      	ItemsUpload.push(markers);
      }

   }

   function deleteItem(rowId) {
      var markers = { "rowId": rowId};

      $.ajax({
          type: "POST",
          url: "api/cart/delete-item",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: markers }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){
            // console.log(data);
            if(data.error){
            	alert(data.status);
            }else{
            	// alert("Thêm thành công!");
            	location.reload();
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
      });
   }


   function stepperUp(num, unit_quantity, unit) {
      num = parseFloat(num);
      unit_quantity = parseFloat(unit_quantity);
      if(unit != 'kg')
      {
        num = num + unit_quantity;
        
      }else {
        num = (num + unit_quantity).toFixed(1);
      }
      num = num + ' ' + unit;
      return num;
   }

   function stepperDown(num, unit_quantity, unit) {
      num = parseFloat(num);
      unit_quantity = parseFloat(unit_quantity);
      console.log(unit);
      if(unit != 'kg')
      {
        num = num - unit_quantity;
        
      }else {
        num = (num - unit_quantity).toFixed(1);
      }
      num = num + ' ' + unit;
      return num;
   }

   function converQty(qty, unit_quantity, unit) {
      // if(unit = 'kg'){
      //   qty = parseFloat(qty);
      //   qty = qty/unit_quantity;
      //   return qty.toFixed(0);
      // }
      qty = parseFloat(qty); 
      return qty.toFixed(3);
      
   }

   function numberWithCommas(x) {
         return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     }

   

});
  function addItems() {
  	var dataUp = {"order_id":order_id, ItemsUpload};
   	console.log(dataUp);

   		$.ajax({

          type: "POST",
          url: "{{url('')}}/api/admin/update-cart",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: dataUp }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){
            console.log(data);
            if(data.error==0){
            	// alert(data.status);
            	// location.reload();
              // loaditems();
              ItemsUpload = [];
            }else{
            	alert(data.status);
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
      });
   } 
</script>
@endsection