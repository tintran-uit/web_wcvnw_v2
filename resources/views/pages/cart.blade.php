@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            <aside class="col-sm-12 col-md-3">
               <div class="block block-nav spacer-15">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Giỏ hàng</h4>
                  </div>
                  <div class="content">
                     <ul class="list-unstyled">
                        <li>
                           <a href="account.html">          <i class="fa fa-angle-right"></i> Tài khoản
                           </a>      
                        </li>
                        <li>
                           <a class="current" href="{{url('gio-hang-thuc-pham-sach')}}">          <i class="fa fa-angle-right"></i> Đơn hàng
                           </a>      
                        </li>
                        <li>
                           <a class="" href="{{url('thanh-toan')}}">          <i class="fa fa-angle-right"></i> Thông tin giao hàng
                           </a>      
                        </li>
                        
                     </ul>
                  </div>
               </div>
               
            </aside>
            <article class="col-sm-12 col-md-9">
               <div class="spacer-bottom-25">
                  <h3 class="no-margin-top text-uppercase spacer-10 text-center">
                     Giỏ hàng thực phẩm an toàn
                  </h3>
                  <form action="/destroy" accept-charset="UTF-8" class="form-style-base" method="post">
                     <input type="hidden" name="_method" value="delete">
                     <fieldset>
                        <div class="table-responsive">
                           <table id="cartTable" class="table table-bordered" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th class="bg-extra-light-grey col-md-2 col-xs-1">Hình ảnh</th>
                                    <th class="bg-extra-light-grey">Sản Phẩm</th>
                                    <th class="bg-extra-light-grey">Số Lượng</th>
                                    <th class="bg-extra-light-grey">Giá</th>
                                    <th class="bg-extra-light-grey">Tổng</th>
                                    <th class="bg-extra-light-grey"></th>
                                    <th style="display:none;"></th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach($cart as $item)
                                 <tr>
                                    <td class="align-middle">
                                       <img class="img-responsive center-block extra-small-img" alt="product" src="http://wecarevn.com/uploads{{$item->options->image}}">
                                                         
                                    </td>
                                    <td class="align-middle">
                                       <div style="width: auto;">{{$item->name}}</div>
                                    </td>
                                    <td class="align-middle">
                                       <div class="stepper "><input type="number" class="form-control stepper-input" value="{{$item->qty}}" min="1" max="20" step="1"><span class="stepper-arrow up">Up</span><span class="stepper-arrow down">Down</span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                       {{number_format($item->price)}} VND
                                    </td>
                                    <td class="align-middle text-center">
                                       {{number_format($item->price*$item->qty)}} VND
                                    </td>
                                    <td class="align-middle text-center">
                                       <a class="btn btn-info text-center no-margin item-delete">                            <i class="fa fa-trash"></i>
                                       </a>                        
                                    </td>
                                    <td style="display:none;">{{$item->rowId}}</td>
                                 </tr>
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
                     <fieldset class="buttons">
                        <div class="pull-right">
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="{{url('/mua-thuc-pham-sach')}}">Tiếp tục mua hàng</a>
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="{{url('/thanh-toan')}}">Thanh toán</a>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </article>
         </div>
         
      </div>
   </section>
   @include('layouts.banner_bottom')
</main>
@endsection

@section('scrip_code')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    var table = $('#cartTable').DataTable({searching: false, paging: false, "bInfo" : false, "footerCallback": function ( row, data, start, end, display ) {
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                numberWithCommas(pageTotal) +' VND'
            );
        }});

    table.on( 'click', 'span.up' , function () {
         var msg = '';
         $(this).closest('tr').find(':input').each(function() {
            msg +=  $(this).val();
            msg = parseInt(msg) + 1;
            $(this).val(msg);
         });
         var row = $(this).closest('tr').index();
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         table.cell(row, 4).data(numberWithCommas(price) + ' VND').draw();
         var rowId = table.row(row).data()[6];
         updateCart(rowId, msg);
      });
    table.on( 'click', 'span.down' , function () {
         var msg = 0;
         $(this).closest('tr').find(':input').each(function() {
            msg +=  $(this).val();
            msg = parseInt(msg) - 1;
            if(msg > 0 )
            {
               $(this).val(msg);
            }
         });
         var row = $(this).closest('tr').index();
         var price = table.row(row).data()[3].replace(/[^0-9.]/g, "");
         price = parseInt(price)*msg;
         table.cell(row, 4).data(numberWithCommas(price) + ' VND').draw();
         var rowId = table.row(row).data()[6];
         updateCart(rowId, msg);
      });
   
   table.on( 'click', 'a.item-delete' , function () {
      var row = $(this).closest('tr').index();
      var rowId = table.row(row).data()[6];
      var status = deleteItem(rowId);
      table
        .row( $(this).parents('tr') )
        .remove()
        .draw();
   });

    function updateCart(rowId, qty) {
      var markers = { "rowId": rowId, "qty": qty };

      $.ajax({

          type: "POST",
          url: "api/cart/update-cart",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: markers }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){
            console.log(data);
            updateCartStatus(data);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
      });
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
            console.log(data);
            updateCartStatus(data);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
      });
   }


});



function stepperUp() {
  
}

function stepperDown() {
  
}
   
</script>

@endsection