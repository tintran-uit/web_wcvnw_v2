@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')
<script type="text/javascript">
            $(document).ready(function() {
              $('#form-payment-1').bootstrapValidator({
                  message: '',
                  feedbackIcons: {
                      valid: 'glyphicon glyphicon-ok',
                      invalid: 'glyphicon glyphicon-remove',
                      validating: 'glyphicon glyphicon-refresh'
                  },
                  fields: {
                      ten: {
                          message: '',
                          validators: {
                              notEmpty: {
                                  message: 'Vui lòng nhập họ tên.'
                              },
                              stringLength: {
                                  min: 5,
                                  max: 35,
                                  message: 'Họ tên không dưới 5 ký tự'
                              }
                          }
                      },
                      sdt: {
                          validators: {
                              notEmpty: {
                                  message: 'Vui lòng nhập số điện thoại.'
                              },
                              numeric: {
                                   message: 'Vui lòng nhập chính xác số điện thoại.',
                              }
                          }
                      },
                      email: {
                          validators: {
                              emailAddress: {
                                  message: 'Vui lòng nhập chính xác địa chỉ eamil.'
                              }
                          }
                      },
                      diaChi: {
                          validators: {
                            notEmpty: {
                                  message: 'Vui lòng nhập địa chỉ.'
                              }
                          }
                      },
                      selectQuan: {
                          validators: {
                            notEmpty: {
                                  message: 'Vui lòng chọn quận.'
                              }
                          }
                      }
                  }
              }).on('error.form.bv', function (e) {
                generateCaptcha();
              });
          });
      </script>
@endsection


@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            <aside class="col-sm-12 col-md-3">
               <div class="block block-nav spacer-15">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Đơn hàng</h4>
                  </div>
                  <div class="content">
                     <ul class="list-unstyled">
                        <li>
                           <a href="account.html">          <i class="fa fa-angle-right"></i> Tài khoản
                           </a>      
                        </li>
                        <li>
                           <a href="{{url('gio-hang-thuc-pham-sach')}}">          <i class="fa fa-angle-right"></i> Đơn hàng
                           </a>      
                        </li>
                        <li>
                           <a class="current" href="{{url('thanh-toan')}}">          <i class="fa fa-angle-right"></i> Thông tin giao hàng
                           </a>      
                        </li>
                     </ul>
                  </div>
               </div>
               <section class="wrap wrap-border internal-padding spacer-bottom-15">
              <h4 class="text-uppercase no-margin">Giỏ thực phẩm an toàn</h4>
              <div class="spacer-top-5" style="margin-top: 5px;">
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6">Tạm tính:</div>
                  <div class="col-xs-6 text-right" id="spacer-subtoal">
                    <?php 
                      $subtotal = 0; 
                      foreach ($cart as $item) {
                        $subtotal += $item->subtotal;
                      }
                      echo(number_format($subtotal));
                      echo " VND";
                    ?>
                  </div>
                </div>
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6">Phí vận chuyển:</div>
                  <div class="col-xs-6 text-right" id="spacer-ship">
                    
                  </div>
                </div>
                <hr>
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6 highlighted"><strong>Thành tiền:</strong></div>
                  <div class="col-xs-6 text-right" id="spacer-toal"><?php echo(number_format($subtotal));
                      echo " VND"; ?></div>
                </div>
                <p class="small no-margin spacer-top-15">
                  Đã bao gồm thuế VAT.
                  <a href="terms-conditions.html">
                    <u></u>
                  </a>
                </p>
              </div>
            </section>
            </aside>
            <article class="col-sm-12 col-md-9">
               <section id="module-payment" class="bg-white style-wrap-type-2 wrap-radius up">
                  <div class="content-top">
                     <section id="steps-order">
                        <!-- Nav with Number -->
                        <ul class="nav nav-tabs" id="tab-payment">
                           <!-- <li class="active" id="1">
                              <a href="#tab-1" data-toggle="tab" aria-expanded="true">
                              <span class="numberCircle">1</span>
                              <label class="hidden-xs">Thông tin khách hàng</label>
                              </a>
                           </li> -->
                           <li class="active" id="2">
                              <a href="#tab-2" data-toggle="tab" aria-expanded="false">
                              <span class="numberCircle">1</span>
                              <label class="hidden-xs">Thông tin giao hàng</label>
                              </a>
                           </li>
                           <li id="3">
                              <a href="#tab-3" data-toggle="tab">
                              <span class="numberCircle">2</span>
                              <label class="hidden-xs">Phương thức thanh toán</label>
                              </a>
                           </li>
                           <li id="4">
                              <a href="#tab-4" data-toggle="tab">
                              <span class="numberCircle">3</span>
                              <label class="hidden-xs">Hoàn thành</label>
                              </a>
                           </li>
                        </ul>
                        
                     </section>
                  </div>
                  <div class="content-body">
                     <section class="tab-content">
                        <form id="form-payment-1" class="tab-pane active" id="tab-2">
                           <div accept-charset="UTF-8" class="form-style-base">
                              
                              <div class="row clearfix">
                                 <article class="col-sm-12">
                                 <div class="col-sm-6">
                                    <p>Bạn đã có tài khoản? <a style="color: #0071b6; font-weight: 700;" href="{{url('/login')}}">Đăng nhập</a></p>
                                    <p>Vui lòng nhập địa chỉ! <a style="color: #0071b6; font-weight: 700;" href="{{url('/register')}}">Đăng ký tài khoản</a> để nhận ưu đãi và mua hàng nhanh chóng hơn!</p>
                                    <div class="form-group">
                                       <!-- <label>First and Last Name</label> -->
                                       <input name="ten" type="text" class="form-control input-lg" placeholder="Họ tên khách hàng (*)">
                                    </div>
                                 </div>
                                 </article>
                                 <article class="col-sm-12">
                                 <article class="col-sm-6">
                                       <div class="form-group">
                                          <label>Địa chỉ giao hàng</label>
                                          <input name="diaChi" type="text" class="form-control input-lg" placeholder="Nhập địa chỉ (*)">
                                       </div>
                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                             <select name="selectQuan" class="form-control">
                                                <option value="">Chọn Quận/Huyện (*)</option>
                                               <option value="Quận 1">Quận 1</option>
                                               <option value="Quận 2">Quận 2</option>
                                               <option value="Quận 3">Quận 3</option>
                                               <option value="Quận 4">Quận 4</option>
                                               <option value="Quận 5">Quận 5</option>
                                               <option value="Quận 6">Quận 6</option>
                                               <option value="490">Quận 7</option>
                                               <option value="491">Quận 8</option>
                                               <option value="492">Quận 9</option>
                                               <option value="493">Quận 10</option>
                                               <option value="494">Quận 11</option>
                                               <option value="495">Quận 12</option>
                                               <option value="496">Quận Bình Tân</option>
                                               <option value="497">Quận Bình Thạnh</option>
                                               <option value="498">Quận Gò Vấp</option>
                                               <option value="499">Quận Phú Nhuận</option>
                                               <option value="500">Quận Tân Bình</option>
                                               <option value="501">Quận Tân Phú</option>
                                               <option value="502">Quận Thủ Đức</option>
                                               <option value="503">Huyện Bình Chánh</option>
                                               <option value="504">Huyện Cần Giờ</option>
                                               <option value="505">Huyện Củ Chi</option>
                                               <option value="506">Huyện Hóc Môn</option>
                                               <option value="507">Huyện Nhà Bè</option>
                       
                                             </select>
                                       </div>
                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                          <div class="selecter  closed" tabindex="0">
                                             <span class="selecter-selected">Hồ Chí Minh</span>
                                          </div>
                                       </div>
                                    
                                    
                                 </article>
                                 <article class="col-sm-6">
                                       <div class="spacer-20">
                                       <div class="form-group">
                                          <label>Người nhận hàng</label>
                                       </div>
                                          <div class="form-group row clearfix">
                                             <div class="col-sm-4">
                                                <div class="spacer-10">
                                                   <div class="picker picker-radio  checked">
                                                      <label class="picker-label">Số điện thoại: (*)</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-8">
                                                <input name="sdt" type="text" class="form-control input-lg">
                                             </div>
                                          </div>
                                          <div class="form-group row clearfix">
                                             <div class="col-sm-4">
                                                <div class="spacer-10">
                                                   <div name="email" class="picker picker-radio ">
                                                      <label class="picker-label">Email:</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-sm-8">
                                                <input name="email" type="text" class="form-control input-lg">
                                             </div>
                                          </div>
                                       </div>
                                 </article>
                                 </article>
                              </div>
                              <div class="form-group no-margin">
                                 <p class="required-fields text-right no-margin">* Bắt buộc</p>
                              </div>
                           </div>
                        </form>
                        <div class="tab-pane" id="tab-3">
                           <form action="#" accept-charset="UTF-8" method="post" id="form-payment" class="form-style-base">
                              <h4 class="nomargin spacer-bottom-15">Phương thức thanh toán:</h4>
                              <div class="payment-method-box">
                                 <div id="payment-0" class="choose selected">
                                    <a class="clearfix" onclick="payment(0)">
                                       <div class="pull-left">
                                          <span class="fa-stack spacer-15" id="tick-pay-0">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                                          </span>
                                       </div>
                                       <div class="col-xs-9">
                                          <h4 class="no-margin">
                                             <b>Chuyển khoản ngân hàng</b>
                                          </h4>
                                          <p class="no-margin">Cảm ơn bạn đã lựa chọn mua sắm tại We Care VN, <br>
Nhân viên của chúng tôi sẽ sớm liên lạc với bạn qua điện thoại để <br>
XÁC NHẬN ĐƠN HÀNG <br>
trước khi giao hàng!</p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img alt="credit cards" src="assets/images/icons/credit-cards/credit-cards.jpg">
                                       </div>
                                    </a>
                                 </div>
                                 <div id="payment-1" class="choose deselected">
                                    <a class="clearfix" onclick="payment(1)">
                                       <div class="pull-left">
                                          <span class="fa-stack spacer-15" id="tick-pay-1">
                                          <i class="fa fa-circle-o fa-stack-2x"></i>
                                          </span>
                                       </div>
                                       <div class="col-xs-9">
                                          <h4 class="no-margin">
                                             <b>Thanh toán khi nhận hàng</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin">Cảm ơn bạn đã lựa chọn mua sắm tại We Care VN, <br>
Nhân viên của chúng tôi sẽ sớm liên lạc với bạn qua điện thoại để <br>
XÁC NHẬN ĐƠN HÀNG <br>
trước khi giao hàng!</p>
                                          </p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img alt="paypal" src="assets/images/icons/credit-cards/paypal.png">
                                       </div>
                                    </a>
                                 </div>
                              </div>
                              
                              <section>
                                 <h4>Bạn có mã giảm giá?</h4>
                                 <div class="row clearfix">
                                    <div class="col-xs-6 form-group">
                                       <input name="ma-giam-gia" type="text" class="form-control input-lg" placeholder="Nhập mã giảm giá">
                                    </div>
                                 </div>
                              </section>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-4">
                           <div class="text-center">
                              <i class="fa fa-check fa-4x alert-success"></i>
                              <h3>Đặt hàng thành công!</h3>
                              <p><b>Mã đơn đặt hàng: #34232323.</b><br>Cảm ơn bạn đã mua thực phẩm an toàn tại WeCareVN.</p>
                           </div>
                        </div>

                     </section>
                  </div>
               </section>
               <section class="row">
                  <div class="col-xs-6">
                  </div>
                  <div class="col-xs-6">
                     <div class="pull-right">
                        <a class="btn btn-info btn-lg" onclick="backStep()">                  <i class="fa fa-angle-double-left"></i> <span class="hidden-xs">Quay lại</span>
                        </a>
                        <a class="btn btn-primary btn-lg" onclick="nextStep()" id="nextButtonStep">                  <span class="hidden-xs" id="payment-next-button">Tiếp theo</span> <i class="fa fa-angle-double-right"></i>
                        </a>              
                     </div>
                  </div>
               </section>
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

      isMobilePayment();

      function backStep() {
            var period_val = activaTab();
            switch (period_val){
               case "1":
                  break;
               case "2":
                  break;
               case "3":
                  $('[href="#tab-2"]').tab('show');
                  break;
               case "4":
                  $('[href="#tab-3"]').tab('show');
                  break;
            }             
          }

      function nextStep() {
             var period_val = activaTab();
             var ten = $("input[name=ten]").val();
             var diaChi = $("input[name=diaChi]").val();
             var quan = $( "select[name=select-quan]" ).val();
             var sdt = $("input[name=sdt]").val();
             var email = $("input[name=email]").val();

            switch (period_val){
               case "1":
                  var validator = $('#Users').data('bootstrapValidator');
        validator.validate();
        if (validator.isValid()) {
            // Make the ajax call here.
        }
                  $('[href="#tab-2"]').tab('show');
                  break;
               case "2":
                  $('[href="#tab-3"]').tab('show');
                  break;
               case "3":
                  $('[href="#tab-4"]').tab('show');
                  break;
               case "4":
                  $('span#payment-next-button').text('Hoàn thành');
                  break;
            }  
          }    
   
      function activaTab(){
          var period_val = $("#tab-payment .active").attr('id');
          return period_val;
      };
   
      function payment(argument) {
         var tick = '<i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-check fa-stack-1x fa-inverse"></i>';
         var notick = '<i class="fa fa-circle fa-stack-2x"></i>';
         if(argument == 0){
            $('#payment-0').removeClass('deselected').addClass('selected');
            $('#payment-1').addClass('choose deselected');
            $('#tick-pay-0').html(tick);
            $('#tick-pay-1').html(notick);
         }
         else{
            $('#payment-0').addClass('choose deselected');
            $('#payment-1').removeClass('deselected').addClass('selected');
            $('#tick-pay-0').html(notick);
            $('#tick-pay-1').html(tick);
         }
      }

      function isMobilePayment() {
            $('html, body').animate({
                        scrollTop: $('#module-payment').offset().top
                    }, 'slow');
         }
   
      
</script>
@endsection