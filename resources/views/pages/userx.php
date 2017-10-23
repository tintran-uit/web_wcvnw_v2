@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')
<link href="{{url('')}}/packages/kartik-rate/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

<!-- optionally if you need to use a theme, then include the theme CSS file as mentioned below -->
<link href="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

<!-- important mandatory libraries -->
<script src="{{url('')}}/packages/kartik-rate/js/star-rating.js" type="text/javascript"></script>

<!-- optionally if you need to use a theme, then include the theme JS file as mentioned below -->
<script src="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.js"></script>

<!-- optionally if you need translation for your language then include locale file as mentioned below -->
<!-- <script src="{{url('')}}/packages/kartik-rate/js/locales/<lang>.js"></script> -->
@endsection


@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
          <aside class="col-sm-12 col-md-3">
            @include('layouts.menu_user')
          </aside>
            <article class="col-sm-12 col-md-9">
               <div class="spacer-bottom-25">
                  <h3 class="no-margin-top text-uppercase spacer-10 text-center">
                     Thông tin cá nhân
                  </h3>
                  <section class="wrap internal-padding wrap-border action-box bg-white wrap-radius">
                     <div class="row clearfix">
                       <div class="col-sm-3 titlebar" style="border-right: 1px dashed #64903E;">
                         <div class="hgroup">
                           <h2 class="text-uppercase no-margin">Đơn hàng cuả tôi</h2>
                           <h3 class="no-margin">Các đơn hàng gần đây của bạn:</h3>
                         </div>
                         <div class="icon-box">
                           <img alt="orders" src="{{url('')}}/assets/images/icons/icon-my-order.png">
                           <br><br>
                           <?php $i=0; ?>
                           @foreach($orders as $order)
                           @if($order->status != 8)
                           <?php $i++; ?>
                            <p><a href="#" data-toggle="modal" data-target="#order-{{$i}}">Xem đơn hàng: {{$order->order_id}}<br>{{ \Carbon\Carbon::parse($order->date)->format('d/m/Y')}} - <span class="@if($order->status == 1) btn-info @endif @if($order->status == 2) btn-primary @endif @if($order->status == 0) btn-warning @endif @if($order->status == 3) btn-error @endif">{{$order->status_vn_name}}</span></a></p>
                            @endif
                           @endforeach
                         </div>
                       </div>
                       <div class="col-sm-9 listbar" style="border-left: 0px;">
                        <!--  -->
                         <!-- <div class="listbox">
                           <p>Đánh giá sản phẩm để xây dựng cộng đồng tốt hơn<br>Mời bạn đánh giá chất lượng đơn hàng ngày <b><i>21/10/2017</i></b></p>
                           </div>
                    <form id="formRate">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingOne">
                                 <h4 class="panel-title">
                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <i class="fa fa-angle-down btn-link"></i> Chấm điểm
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                 <div class="panel-body">
                                   <p><b>Bạn có thể đánh giá sản phẩm mua trong vòng một tuần, kể từ ngày nhận được hàng.</b></p>
                                      </div>
                                      <div class="modal-body">
                                        <div class="form-group" style="width: 100%">
                                           <input id="input-4" name="rate" type="number" class="rating rating-loading" data-show-clear="false" data-min="0" data-max="5" data-step="1">
                                        </div>
                                 </div>
                               </div>
                             </div>
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingTwo">
                                 <h4 class="panel-title">
                                   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                     <i class="fa fa-angle-down btn-link"></i> Chọn sản phẩm <span class="prod"></span> 
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                 <div class="panel-body">
                                   <p><b>Vui lòng tích vào sản phẩm nào khiến bạn <span class="prod"></span></b></p>
                                   
                                      <div class="col-md-6" ><label><input type="checkbox" value="0" name="checked">Tất cả sản phẩm</label></div>
                                    @foreach($cartOld as $item)
                                      <div class="col-md-6" ><label><input type="checkbox" value="{{$item->id}}" name="checked">{{$item->name}}</label></div>
                                    @endforeach
                                    
                                 </div>
                               </div>
                             </div>
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingThree">
                                 <h4 class="panel-title">
                                   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                     <i class="fa fa-angle-down btn-link"></i> Bình luận
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                 <div class="panel-body">
                                   <div class="form-group">
                                      <label for="comment">Vui lòng nhập bình luận để xây dựng cồng đồng nông dân nuôi trồng sạch:</label>
                                      <textarea class="form-control" rows="5" name="comment"></textarea>
                                    </div>
                                 </div>
                               </div>
                             </div>
                           </div>
                  </form> 
<a class="btn btn-primary btn-lg lg-2x" onclick="sentRate()"> Gửi đánh giá <i class="fa fa-angle-double-right"></i>
                           </a>

                -->

                          <div class="listbox">
                           <p><b>Bạn chưa có đơn hàng để đánh giá!</b><br>Bạn có thể đánh giá chất lượng sản phẩm trong thời gian một tuần, kể từ khi nhận được đơn hàng!</p>
                           <div class="pull-right">
                           <img alt="danh gia rau sach"  class="image-responsive" src="{{url('')}}/assets/images/icons/rate.png" style="width: 100%">
                         </div>
                           </div>

                           


                       </div>
                     </div>
                   </section>
                  
               </div>
            </article>
         </div>
         
      </div>
   </section>
   @include('layouts.banner_bottom')
</main>
<?php $i=0; ?>
@foreach($orderItem as $order)
<?php $i++; ?>
 <!-- Modal order -->
<div class="modal fade style-base-modal" id="order-{{$i}}" tabindex="-1" role="dialog" aria-labelledby="modalBuyVoucher" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title" id="modalBuyVoucher">Chi tiết đơn hàng</h4>
        </div>
        <div class="modal-body">
          
          <table style="width: 100%">
            <thead>
            <tr>
              <th class="col-md-3">Sản phẩm</th>
              <th class="col-md-5">Nguồn gốc</th>
              <th class="col-md-2">Số lượng</th>
              <th class="col-md-2">Giá</th>
            </tr>
            </thead>
            <tbody>
              <?php $total=0; ?>
              @for($j = 0; $j < sizeof($order)-3; $j++)
              <tr>
              <td class="col-md-3">{{$order[$j]->product_name}}</td>
              <td>{{$order[$j]->farmer_name}}</td>
              <td><input type="text" name="qty" value="{{$order[$j]->quantity}}" style="width: 40%" class="text-center"> {{$order[$j]->unit}}</td>
              <td><input type="text" name="qty" value="{{$order[$j]->price}}" style="width: 40%" class="text-center"> VNĐ</td>
              </tr>
              <?php $total+=$order[$j]->price; ?>
              @endfor
            </tbody>
            <tfoot>
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px"><br><b>Khuyến mãi</b>  </td>
                <td colspan="1" align="left" style="float: right;"><br><span>{{$order['discount_amount']}} VNĐ</span></td>
              </tr>
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px;"><b>Phí vận chuyển</b>  </td>
                <td colspan="1" align="left" style="float: right;"><span>{{$order['shipping_cost']}} VNĐ</span></td>
              </tr>
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px"><b>Tạm tính</b>  </td>
                <td colspan="1" align="left" style="float: right;"><span>{{$total}} VNĐ</span></td>
              </tr>
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px"><b>Tổng tiền</b>  </td>
                <td colspan="1" align="left" style="float: right;"><span>{{($total+$order['shipping_cost'])}} VNĐ</span></td>
              </tr>
              <tr style="">
                <td colspan="1" align="right" style="padding-right: 5px"><br><b>Người đặt hàng: </b>  </td>
                <td colspan="3" align="left" style=""><br><span> {{$order['nguoinhan']}}</span></td>
              </tr>
            </tfoot>
          </table>


        </div>
      </div>
    </div>
  </div>
</div>
@endforeach


@endsection

@section('scrip_code')
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/dataTables/jquery.dataTables.min.js"></script>

<script type="text/javascript">
   initRatingStar();
   var rate = 0;
   var dataPost = {};
   // getFormValue('#formRate');  

   function initRatingStar() {
      var $rate = $('input[type="number"]');
      $rate.rating({
         clearCaption: '',
         step: 1,
         starCaptions: {1: 'Rất kém', 2: 'Kém', 3: 'Được', 4: 'Tốt', 5: 'Đáng khen'},
         starCaptionClasses: {1: 'text-danger', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
         });
      };
$(document).on('ready', function () {
         $('.rating,.kv-gly-star,.kv-gly-heart,.kv-uni-star,.kv-uni-rook,.kv-fa,.kv-fa-heart,.kv-svg,.kv-svg-heart').on(
                'change', function () {
                    rate = $(this).val();
                    if(rate>3){
                        $('.prod').html('ưng ý');
                    }else{
                        $('.prod').html('không hài lòng');
                    }
                    next1();
                });
         $('input[type="checkbox"]').on(
                'change', function () {
                    rate = $(this).val();
                    if(rate>3){
                        $('.prod').html('ưng ý');
                    }else{
                        $('.prod').html('không hài lòng');
                    }
                    next2();
                });
    });

function next1() {
   $("#collapseTwo").collapse("show");
   $("#collapseOne").collapse("hide");

}
function next2() {
   $("#collapseThree").collapse("show");
   scrollToTab();
}
function getFormValue(formID) {
  var $inputs = $(formID+' :input');
  $inputs.each(function() {
      dataPost[this.name] = $(this).val();
  });
  dataPost['elements'] = [];
  var inputElements = $('#formRate :input');
      for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked && 'undefined'){
                  var checked = inputElements[i].value;
                 
                 dataPost['elements'].push(
                    checked
                ); 
            }
      }
  console.log(dataPost);
  return checkForm();
}

function sentRate() {
   var checkForm = getFormValue('#formRate');

   if(checkForm){

      $.ajax({
          type: "POST",
          url: "/api/customer/rate",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: dataPost }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){
            
            console.log(data);
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              $('#modalLoader').modal('hide');
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
        });

   }
}

function checkForm() {
  if (dataPost['rate'] == "") {
    $("#collapseOne").collapse("show");
    $("#collapseTwo").collapse("hide");
    $("#collapseThree").collapse("hide");
    $('#modalMessage').html("Vui lòng chấm điểm!");
    $('#modalAlert').modal('show');
    return false;
  }

  if (dataPost['elements'].length == 0) {
    $("#collapseTwo").collapse("show");
    $("#collapseOne").collapse("hide");
    $("#collapseThree").collapse("hide");
    $('#modalMessage').html("Vui lòng đánh dấu sản phẩm!");
    $('#modalAlert').modal('show');
    return false;
  }

  if (dataPost['comment'] == ""){
    $("#collapseThree").collapse("show");
    $("#collapseOne").collapse("hide");
    $("#collapseTwo").collapse("hide");
    $('#modalMessage').html("Vui lòng nhập bình luận!");
    $('#modalAlert').modal('show');
    return false;
  }
  return true;
}

function scrollToTab() {

            $('html, body').animate({
                        scrollTop: $('#formRate').offset().top
                    }, 'slow');
                    
                    
         }
</script>

@endsection