@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main>
  <div id="fb-root" class=" fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=f28c7fa749f3e3&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=f28c7fa749f3e3&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=fe4936fbed70ec&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=fe4936fbed70ec&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>
    
  <section>
    <section class="product-details spacer-20">
      <div class="container">
        <div class="row">
          <article class="col-sm-4 col-md-5">
            <section class="wrap internal-padding wrap-border wrap-radius bg-white">
              <div class="">
                <img class="img-responsive big-img center-block" alt="product" src="{{url('')}}/{{$product[0]->image}}">
                
              </div>
              <div class="icon-shipping" style="margin-top: 30px;margin-bottom: 10px;"> <!--icon-email, icon-discount, icon-shipping-->
                <h4 class="title-box text-uppercase no-margin-top">
                  GIAO HÀNG TẬN NƠI
                </h4>
                <p class="copy-box no-margin">
                  Miễn phí giao hàng cho đơn hàng trên 500.000 VNĐ.
                </p>
              </div>

            </section>

          </article>
          <article class="col-sm-8 col-md-7">
            <section class="wrap internal-padding wrap-radius bg-white">
<form action="#" accept-charset="UTF-8" id="product_addtocart_form" method="post">                <h2 class="title-box no-margin" style="color: #A52223">
                  {{$product[0]->name}}
                </h2>
                <br>
                <?php echo($product[0]->short_description); ?>
                <div class="product-options">
                  <section class="choose">
                    <h5 class="col-sm-12">
                      <b>Chọn nông trại cung cấp:</b>
                    </h5>
                    <article class="col-sm-12">
                        
                        <table class="table table-striped" id="tbSupp">
                          <thead>
                            <tr>
                              <th class="col-sm-1">Chọn</th>
                              <th class="col-sm-5">Nông trại</th>
                              <th class="col-sm-3">Đang còn</th>
                              <th class="col-sm-2">
                               Đánh giá
                              </th>
                              <th class="col-sm-1"> </th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                        
                    </article>
                  </section>
                  <section class="choose">
                    <div class="col-sm-2 vcenter">
                    <h5 class="">
                      <b>Số lượng:</b>
                    </h5>
                    </div>
                    <div class="stepper col-sm-5 vcenter"><input type="text" class="form-control stepper-input text-center" id="stepper" value="{{$product[0]->unit_quantity}} {{$product[0]->unit}}" min="1" max="1000"><span class="stepper-arrow up" onclick="stepperUp()">Up</span><span class="stepper-arrow down" onclick="stepperDown()">Down</span></div>  
                    <div class="vcenter">
                  </section>
                  <section>
                    <div class="row">
                      <article class="col-sm-7 button-group">
                        <a class="btn btn-primary btn-lg lg-2x" onclick="addCartProd()">
                          Thêm vào giỏ <i class="glyphicon glyphicon-shopping-cart"></i>
                        </a>
<a class="btn btn-info btn-lg" onclick="interest({{$product[0]->id}})">                          <i class="fa fa-heart"></i>
</a>                  </article>
                      <article class="col-sm-5">
                        <div class="clearfix product-price"> 
                          <p class="discounted-price pull-left" id="dis_price">
                            {{number_format($product[0]->price)}} VND
                            @if($product[0]->category == 0)
                              <p style="font-size: 19px;">Mua lẻ: <span style="text-decoration: line-through;">{{$product[0]->price_old}} VND</span></p>
                            @endif
                          </p>
                        </div>
                      </article>
                    </div>
                  </section>
                </div>
                <div class="text-center">
                  <i class="glyphicon glyphicon-option-horizontal"></i>
                </div>
</form>              <section>
                
              </section>
            </section>
          </article>
          <!-- chi tiet -->
          <article class="col-sm-12 col-md-12" style="margin-top:-10px">
            <ul class="product-tabs">
                  <li class=" active first"><a href="#product_tabs_description_contents" data-toggle="pill">Chi tiết sản phẩm</a>
                  </li>
                  
                  <li class=""><a href="#product_tabs_product_additional_data_contents" data-toggle="pill"></a>
                  </li>
                  
                  
                  <li class=" last"><a href="#product_tabs_product_tags_contents" data-toggle="pill"></a>
                  </li>
                  
                </ul>
            <section class="wrap internal-padding wrap-border wrap-radius bg-white">
                <article>
                   <?php
                   echo ($product[0]->description);
                  ?>
            </article>
            </section>
          </article>
        </div>
      </div>
    </section>
  </section>
  
  @include('layouts.banner_bottom')

</main>

<div class="modal fade simple-modal" id="modalAlert" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 35%">
               <div class="inner-container" style="border-color: #b50000">
                  <div class="modal-header text-center">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times"></i>
                     </span>
                     </button>
                     <h4 class="modal-title fa fa-exclamation-triangle" id="modalMessage"></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection

@section('scrip_code')

<script type="text/javascript">
var unit_quantity = parseFloat('{{$product[0]->unit_quantity}}');
var unit = '{{$product[0]->unit}}';
var dis_price = '{{$product[0]->price}}';
var quantity = 100;

loadsuppliers();

function loadsuppliers() {
  jQuery("#tbSupp tbody").empty();
  var unit = '{{$product[0]->unit}}';
  var id = {{$product[0]->id}};
  var url = '/api/products/suppliers/product_id='+id;
  $.ajaxSetup({ cache: false });
  $.getJSON(url, function(data){
        $.each(data, function(index, data){ 
              var newRowContent = '';
              var quantity_left = data.quantity_left;
              check = isFloat(data.quantity_left);
              if(check==true){
                quantity_left = parseFloat(data.quantity_left).toFixed(1);
              }
              if(index==0)
              {
                newRowContent = newRowContent = '<tr>\r\n <td><input type=\"radio\" value=\"'+data.id+'\" name=\"farmerID\" checked=\"checked\"><\/td>\r\n';
              }else{
                newRowContent = newRowContent = '<tr>\r\n <td><input type=\"radio\" value=\"'+data.id+'\" name=\"farmerID\"><\/td>\r\n';
              }

                                           newRowContent += '<td>'+data.name+'<\/td>\r\n                              <td>'+quantity_left+' '+unit+'<\/td>\r\n                              <td>\r\n                                <div id=\"colorstar\" class=\"starrr ratable\">\r\n                                  '+data.rating+' <span class=\"glyphicon glyphicon-star\"><\/span>\r\n                                <\/div>\r\n                              <\/td>\r\n                              <td><a href=\"luong-nong/id='+data.id+'\"><\/a><\/td>\r\n                            <\/tr>';
              jQuery("#tbSupp tbody").append(newRowContent);
              quantity = quantity_left;
            });
     }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
         alert("Vui lòng kiểm tra kết nối internet.");
     });

  // setTimeout(loadsuppliers, 45000);
}


function addCartProd() {
  var id = "{{$product[0]->id}}";
  var qty = parseFloat(document.getElementById('stepper').value);
  if(unit = 'kg'){
    qty = qty/unit_quantity;
  }
  var farmerID = $('input[name="farmerID"]:checked').val();
    console.log(farmerID);

  if(farmerID)
  {
    var data = { "id": id, "qty": qty , 'farmerID':farmerID};
    $('#modalLoader').modal('show');
    $.ajax({

        type: "POST",
        url: "{{url('')}}/api/cart/add-item",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        // The key needs to match your method's input parameter (case-sensitive).
        data: JSON.stringify({ data: data }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){
          $('#modalLoader').modal('hide');
          if(data.error)
          {
            $('#modalMessage').html(data.status);
            $('#modalAlert').modal('show');
          }else{
            updateCartStatus(data);
          }
          console.log(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus);
            $('#modalMessage').html("Vui lòng kiểm tra kết nối Internet!");
            $('#modalLoader').modal('hide');
            $('#modalAlert').modal('show');
        }
    });
  }
  
}


function stepperUp() {

  var num = document.getElementById('stepper').value;
  num = parseFloat(num);
    if (num < quantity) {
      if(unit != 'kg')
    {
      num = num + unit_quantity;
    }else {
      num = (num + unit_quantity).toFixed(1);
    }
    var qty = num;
    if(unit == 'kg'){
      qty = qty/unit_quantity;
    }
    document.getElementById('dis_price').innerHTML = numberWithCommas(dis_price*qty) + ' VNĐ';
    document.getElementById('stepper').value = num + ' ' + unit; 
  }else{
    $('#modalMessage').html("Sản lượng còn lại không đủ.");
            $('#modalAlert').modal('show');
  }
  

}

function stepperDown() {
  var num = document.getElementById('stepper').value;
  num = parseFloat(num);
  if(num>unit_quantity)
  {
    if(unit != 'kg')
    {
      num = num - unit_quantity;
    }else {
      num = (num - unit_quantity).toFixed(1);
    }
    var qty = num;
    if(unit == 'kg'){
      qty = qty/unit_quantity;
    }
    document.getElementById('dis_price').innerHTML = numberWithCommas(dis_price*qty) + ' VNĐ';
    document.getElementById('stepper').value = num + ' ' + unit;
  }
}
   
</script>

@endsection