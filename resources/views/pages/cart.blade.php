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
                     <h4 class="text-uppercase no-margin">My account</h4>
                  </div>
                  <div class="content">
                     <ul class="list-unstyled">
                        <li>
                           <a href="account.html">          <i class="fa fa-angle-right"></i> Account
                           </a>      
                        </li>
                        <li>
                           <a class="current" href="orders.html">          <i class="fa fa-angle-right"></i> My orders
                           </a>      
                        </li>
                        <li>
                           <a href="info-account.html">          <i class="fa fa-angle-right"></i> Info Account
                           </a>      
                        </li>
                        <li>
                           <a href="add-address.html">          <i class="fa fa-angle-right"></i> Address book
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
                                       <img class="img-responsive center-block extra-small-img" alt="product" src="{{$item->options->image}}">
                                                         
                                    </td>
                                    <td class="align-middle">
                                       <div style="width: auto;">{{$item->name}}</div>
                                    </td>
                                    <td class="align-middle">
                                       <div class="stepper "><input type="number" class="form-control stepper-input" value="{{$item->qty}}" min="1" max="20" step="1"><span class="stepper-arrow up">Up</span><span class="stepper-arrow down">Down</span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                       {{$item->price}} VND
                                    </td>
                                    <td class="align-middle text-center">
                                       {{$item->price*$item->qty}} VND
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
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="shop.html">Tiếp tục mua hàng</a>
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="payment.html">Thanh toán</a>
                           <a class="btn btn-success btn-lg" href="#">                    <i class="glyphicon glyphicon-refresh"></i>
                           </a>                
                        </div>
                     </fieldset>
                  </form>
               </div>
            </article>
         </div>
         <div class="row">
            <div class="col-sm-4">
               <section class="single-block bg-white wrap-radius">
                  <div class="icon-email">
                     <!--icon-email, icon-discount, icon-shipping-->
                     <h4 class="title-box text-uppercase no-margin-top">
                        SUBSCRIBE TO NEWSLETTER
                     </h4>
                     <p class="copy-box no-margin-top">
                        Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
                     </p>
                     <div class="text-center">
                        <a class="btn btn-link no-margin" href="#">SHOW MORE</a>
                     </div>
                  </div>
               </section>
            </div>
            <div class="col-sm-4">
               <section class="single-block bg-white wrap-radius">
                  <div class="icon-discount">
                     <!--icon-email, icon-discount, icon-shipping-->
                     <h4 class="title-box text-uppercase no-margin-top">
                        Have a Coupon?
                     </h4>
                     <p class="copy-box no-margin-top">
                        Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
                     </p>
                     <div class="text-center">
                        <a class="btn btn-link no-margin" href="#">SHOW MORE</a>
                     </div>
                  </div>
               </section>
            </div>
            <div class="col-sm-4">
               <section class="wrap wrap-border internal-padding spacer-bottom-15">
                  <h4 class="text-uppercase no-margin">Summary order</h4>
                  <div class="spacer-top-5">
                     <div class="row spacer-bottom-5">
                        <div class="col-xs-6">Articles:</div>
                        <div class="col-xs-6 text-right">$ 45,00</div>
                     </div>
                     <div class="row spacer-bottom-5">
                        <div class="col-xs-6">Shipping costs:</div>
                        <div class="col-xs-6 text-right">
                           <b>GRATIS</b>
                        </div>
                     </div>
                     <div class="row spacer-bottom-5">
                        <div class="col-xs-6 highlighted">
                           <strong>Gift Certificate:</strong>
                        </div>
                        <div class="col-xs-6 text-right">
                           <b>- $ 45,00</b>
                        </div>
                     </div>
                     <div class="row spacer-bottom-5">
                        <div class="col-xs-6">Total order:</div>
                        <div class="col-xs-6 text-right">$ 0,00</div>
                     </div>
                     <p class="small no-margin spacer-top-15">
                        Your order includes VAT.
                        <a href="terms-conditions.html">
                        <u>Details</u>
                        </a>
                     </p>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </section>
   <section class="purchase-benefits spacer-30 bg-extra-light-grey">
      <div class=" spacer-10">
         <div class="container spacer-top-15">
            <div class="row clearfix">
               <article class="col-xs-12 col-sm-3">
                  <div class="column text-center spacer-bottom-15">
                     <i class="fa fa-truck fa-3x"></i>
                     <h4>Free Worldwide Shipping</h4>
                     <p class="no-margin">
                        Delivery throughout England<br>in 24/48 h by courier
                     </p>
                  </div>
               </article>
               <article class="col-xs-12 col-sm-3">
                  <div class="column text-center spacer-bottom-15">
                     <i class="fa fa-gift fa-3x"></i>
                     <h4>Want to make a gift?</h4>
                     <p class="no-margin">
                        When ordering, <a href="#" class="btn-link">ask for gift box</a> and you'll get everything you need to be able to create
                     </p>
                  </div>
               </article>
               <article class="col-xs-12 col-sm-3">
                  <div class="column text-center spacer-bottom-15">
                     <i class="fa fa-lock fa-3x"></i>
                     <h4>Secure Payments!</h4>
                     <p class="no-margin">
                        Please card payments credit in all tranquility use certified instruments
                     </p>
                  </div>
               </article>
               <article class="col-xs-12 col-sm-3">
                  <div class="column text-center spacer-bottom-15">
                     <i class="fa fa-phone fa-3x"></i>
                     <h4>Customer Service</h4>
                     <p class="no-margin">
                        Our customer service is available from Monday to Saturday from 9:00 to 18:00
                     </p>
                  </div>
               </article>
            </div>
         </div>
      </div>
   </section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    var table = $('#cartTable').DataTable({searching: false, paging: false, "footerCallback": function ( row, data, start, end, display ) {
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
                pageTotal +' VND'
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
         var price = table.row(row).data()[3];
         price = parseInt(price)*msg;
         table.cell(row, 4).data(price + ' VND').draw();
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
         var price = table.row(row).data()[3];
         price = parseInt(price)*msg;
         table.cell(row, 4).data(price + ' VND').draw();
         var rowId = table.row(row).data()[6];
         updateCart(rowId, msg);
      });
   
   table.on( 'click', 'a.item-delete' , function () {
      table
        .row( $(this).parents('tr') )
        .remove()
        .draw();
   });

    function updateCart(rowId, qty) {
      var markers = { "rowId": rowId, "qty": qty };

      $.ajax({

          type: "POST",
          url: "api/update-cart",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: markers }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){console.log(data);},
          failure: function(errMsg) {
              console.log(errMsg);
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