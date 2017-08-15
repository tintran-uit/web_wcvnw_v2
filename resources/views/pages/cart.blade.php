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
                     Giỏ hàng thực phẩm an 
                  </h3>
                  <form action="/destroy" accept-charset="UTF-8" class="form-style-base" method="post">
                     <input type="hidden" name="_method" value="delete">
                     <fieldset>
                        <div class="table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th class="bg-extra-light-grey"></th>
                                    <th class="bg-extra-light-grey">Sản Phẩm</th>
                                    <th class="bg-extra-light-grey">Số Lượng</th>
                                    <th class="bg-extra-light-grey">Giá</th>
                                    <th class="bg-extra-light-grey">Tổng</th>
                                    <th class="bg-extra-light-grey"></th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach($cart as $item)
                                 <tr>
                                    <td class="align-middle">
                                       <a href="product-details.html">                            <img class="img-responsive center-block extra-small-img" alt="product" src="assets/images/products/product-01.png">
                                       </a>                        
                                    </td>
                                    <td class="align-middle">
                                       {{$item->name}}
                                    </td>
                                    <td class="align-middle">
                                       <div class="stepper "><input type="number" class="form-control stepper-input" value="1" min="1" max="20" step="1"><span class="stepper-arrow up">Up</span><span class="stepper-arrow down">Down</span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                       $20.00
                                    </td>
                                    <td class="align-middle text-center">
                                       50%
                                    </td>
                                    <td class="align-middle text-center">
                                       $10.00
                                    </td>
                                    <td class="align-middle text-center">
                                       <a class="btn btn-info text-center no-margin" href="#">                            <i class="fa fa-trash"></i>
                                       </a>                        
                                    </td>
                                 </tr>
                                 
                              </tbody>
                           </table>
                        </div>
                     </fieldset>
                     <hr>
                     <fieldset class="buttons">
                        <div class="pull-right">
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="shop.html">Back to shopping</a>
                           <a class="btn btn-info btn-lg lg-2x text-uppercase" href="payment.html">Purchase it</a>
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

<script type="text/javascript">

function stepperUp() {
  var num = document.getElementById('stepper').value;
  num = parseInt(num);
  document.getElementById('stepper').value = num + 1; 

}

function stepperDown() {
  var num = document.getElementById('stepper').value;
  num = parseInt(num);
  document.getElementById('stepper').value = num - 1; 
}
   
</script>

@endsection