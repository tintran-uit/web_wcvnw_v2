@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')



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
<?php $i=0;?>
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
          <h4 class="modal-title" id="">Chi tiết đơn hàng</h4>
        </div>
        <div class="modal-body">
          
          <table  id="cartTable{{$i}}" class="table table-bordered" cellspacing="0">
            <thead>
            <tr>
              <th class="col-md-3">Sản phẩm</th>
              <th class="col-md-4">Nguồn gốc</th>
              <th class="col-md-2">Số lượng</th>
              <th class="col-md-2">Giá</th>
              <th style="display:none;"></th>
            </tr>
            </thead>
            <tbody>
              <?php $total=0; ?>
              @for($j = 0; $j < sizeof($order)-3; $j++)
              <tr>
                  <td class="col-md-3">{{$order[$j]->product_name}}</td>
                  <td>{{$order[$j]->farmer_name}}</td>
                  <td class="text-center">
                    <input type="text" class="form-control stepper-input text-center" value="{{$order[$j]->quantity}} {{$order[$j]->unit}}" >
                 </td>
                  <td id="order{{$i}}{{$j}}">{{$order[$j]->price}} VND</td>
                  <td style="display:none;">{{$order[$j]->price/$order[$j]->quantity}}</td>
              </tr>
              <?php $total+=$order[$j]->price; ?>
              @endfor
            </tbody>
            <tfoot>
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px"><b>Tạm tính</b>  </td>
                <td align="left" style="float: right;width: 100%"><span>{{$total}} VND</span></td>
                <td style="display:none;"></td>
              </tr>

              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px;"><b>Phí vận chuyển</b>  </td>
                <td align="left" style="float: right; width: 100%"><span>{{$order['shipping_cost']}} VND</span></td>
                <td style="display:none;"></td>
              </tr>
              
              <tr style="">
                <td colspan="3" align="right" style="padding-right: 20px"><b>Tổng tiền</b>  </td>
                <td align="left" style="float: right;width: 100%"><span>{{($total+$order['shipping_cost'])}} VND</span></td>
                <td style="display:none;"></td>
              </tr>
              <tr style="">
                <td colspan="5" align="right" style="padding-right: 5px"><br><b>Người đặt hàng: </b> {{$order['nguoinhan']}}</td>
                <td style="display:none;"></td>
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
<?php $i=0;?>
@foreach($orderItem as $order)
<?php $i++; ?>
<script type="text/javascript">
  $(document).ready(function() {

    var table{{$i}} = $('#cartTable{{$i}}').DataTable({searching: false, paging: false, "bInfo" : false, "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\VND,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                numberWithCommas(pageTotal) +' VND'
            );
        }});

    table{{$i}}.on( 'change', 'input.stepper-input' , function () {
         var msg;
         var row = $(this).closest('tr').index();
         // var unit_quantity = table.row(row).data()[2];
         var price = table{{$i}}.row(row).data()[4];
         $(this).closest('tr').find(':input').each(function() {
            
            msg = parseFloat($(this).val());
            console.log(msg);

         });
         console.log(price);
         price = price*msg;
         console.log(price);
         console.log(row);
         table{{$i}}.cell(row, 3).data(numberWithCommas(price) + ' VND').draw();
         
      });
   

});
</script>
@endforeach

@endsection