@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')

<script type="text/javascript">
            $(document).ready(function() {
              $('#tab-1').bootstrapValidator({
                  excluded: ':disabled',
                  feedbackIcons: {
                      valid: 'glyphicon glyphicon-ok',
                      invalid: 'glyphicon glyphicon-remove',
                      validating: 'glyphicon glyphicon-refresh'
                  },
                  fields: {
                      ten: {
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
                  },

              }).on('error.form.bv', function(e) {
                console.log(e);
              });
              $('#liTab2').click(function() {
                checkForm2();
              });
              $('#liTab3').click(function() {
                postDataPay();
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
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6">Khuyến mãi:</div>
                  <div class="col-xs-6 text-right" id="spacer-coupon">
                    
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
                           <li href="#tab-1" class="active" data-toggle="tab" id="liTab1">
                              <a data-toggle="tab" aria-expanded="false">
                              <span class="numberCircle">1</span>
                              <label class="hidden-xs">Thông tin giao hàng</label>
                              </a>
                           </li>
                           <li data-toggle="tab" id="liTab2">
                              <a id="aTab2" data-toggle="tab" href="#tab-2" class="li-disabled">
                              <span class="numberCircle">2</span>
                              <label class="hidden-xs">Phương thức thanh toán</label>
                              </a>
                           </li>
                           <li href="#tab-3" data-toggle="tab" id="liTab3">
                              <a data-toggle="tab">
                              <span class="numberCircle">3</span>
                              <label class="hidden-xs">Hoàn thành</label>
                              </a>
                           </li>
                        </ul>
                        
                     </section>
                  </div>
                  <div class="content-body">
                     <section class="tab-content">
                        <div class="tab-pane active" id="tab-1">
                           <form accept-charset="UTF-8" class="form-style-base" data-bv-onerror="onFormError" data-bv-onsuccess="onFormSuccess">
                              
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
                                       <div class="form-group">
                                          <label>Thông tin liên lạc</label>
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
                                   </article>
                                 </article>
                              </div>
                              <div class="form-group no-margin">
                                 <p class="required-fields text-right no-margin">* Bắt buộc</p>
                              </div>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-2">
                           <form action="#" accept-charset="UTF-8" method="post" id="tab-2" class="form-style-base">
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
                                       <input name="maGiamGia" type="text" class="form-control input-lg" placeholder="Nhập mã giảm giá">
                                    </div>
                                    <div class="col-xs-4 form-group no-padding-left">
                                    <a onclick="checkMaGiamGia()" class="btn btn-warning btn-block btn-lg no-margin">
                                      Thêm mã
                                    </a>
                                  </div>
                                 </div>
                              </section>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-3">
                           <div class="text-center">
                              <i class="fa fa-check fa-4x alert-success"></i>
                              <h3>Đặt hàng thành công!</h3>
                              <p><b>Mã đơn đặt hàng: #34232323.</b><br>Cảm ơn bạn đã mua thực phẩm an toàn tại CFarm.vn.</p>
                           </div>
                        </div>

                     </section>
                  </div>
               </section>
               <section class="row">
                  <div class="col-xs-6">
                  </div>
                  <div class="col-xs-6">
                     <div class="pull-right" id="btnStep">
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
   @include('layouts.bottom')
</main>

@endsection
@section('scrip_code')

<script type="text/javascript">
      var dataPost = {};
      dataPost['thanhToan'] = 1;
      isMobilePayment();
      // var t=setInterval(checkForm1,900);
      function backStep() {
            var period_val = activaTab();
            switch (period_val){
               case "liTab1":
                  break;
               case "liTab2":
                  $('[href="#tab-1"]').tab('show');
                  break;
               case "liTab3":
                  $('[href="#tab-2"]').tab('show');
                  break;
               case "4":
                  break;
            }             
          }

      function nextStep() {
             var period_val = activaTab();

            switch (period_val){
               case "liTab1":
                  var check = checkForm('#tab-1');
                  console.log(check);
                  if(check==true)
                    {
                      $('[href="#tab-2"]').tab('show');
                      getFormValue('#tab-1');
                      console.log(dataPost);
                    }
                  else{
                      var message = 'VUI LÒNG NHẬP ĐỦ THÔNG TIN BẮT BUỘC (*)';
                      $('#modalMessage').html(message);
                      $('#modalAlert').modal('show');
                    }
                  break;
               case "liTab2":
                  getFormValue('#tab-2');
                  console.log(dataPost);
                  postDataPay();
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
            dataPost['thanhToan'] = 1;
         }
         else{
            $('#payment-0').addClass('choose deselected');
            $('#payment-1').removeClass('deselected').addClass('selected');
            $('#tick-pay-0').html(notick);
            $('#tick-pay-1').html(tick);
            dataPost['thanhToan'] = 2;
         }
      }

      function isMobilePayment() {
            $('html, body').animate({
                        scrollTop: $('#module-payment').offset().top
                    }, 'slow');
         }

      function checkForm(ntab) {
          return $(ntab).data('bootstrapValidator').isValid();
      }

      function checkForm2() {
        var check1 = checkForm('#tab-1');
        console.log(check1);
              if(check1==true)
              {
                $('[href="#tab-2"]').tab('show');
                $("#aTab2").removeClass("li-disabled");
                getFormValue('#tab-1');
              }else{
                var message = 'VUI LÒNG NHẬP ĐỦ THÔNG TIN BẮT BUỘC (*)';
                $('#modalMessage').html(message);
                $('#modalAlert').modal('show');

                setTimeout(function(){ 
                  $("#liTab2").removeClass("active");
                  $("#liTab1").addClass("active");
                 }, 1000);
              }
      }


      function getFormValue(formID) {
        var $inputs = $(formID+' :input');

        $inputs.each(function() {
            dataPost[this.name] = $(this).val();
        });
      }
   
      function checkMaGiamGia() {
        var ma = $("input[name=maGiamGia]").val();
        var url = 'api/payment/checkMa=' + ma;
        if(ma=='')
          alert('Bạn cần nhập mã!');
        else{
          $.ajaxSetup({ cache: false });
          $('#modalLoader').modal('show');
          $.getJSON(url, function(data){
                $('#modalLoader').modal('hide');
                console.log(data);
                showTotal(data);
             }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                $('#modalLoader').modal('hide');
                 alert("Vui lòng kiểm tra kết nối internet.");
             });
        }
      }

      function showTotal(data) {
         // $('#spacer-subtoal').html(data.subtotal + ' VND');
         $('#spacer-coupon').html('-' + data.giam + ' VND');
         $('#spacer-toal').html(numberWithCommas(data.subtotal) + ' VND');
      }

      function postDataPay() {
        $('#modalLoader').modal('show');
        $.ajax({
          type: "POST",
          url: "api/payment/add",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
          },
          // The key needs to match your method's input parameter (case-sensitive).
          data: JSON.stringify({ data: dataPost }),
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function(data){
            $('#modalLoader').modal('hide');
            $('[href="#tab-3"]').tab('show');
            document.getElementById('btnStep').style.visibility = 'hidden';
            console.log(data);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              $('#modalLoader').modal('hide');
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
        });
      }
      
</script>
@endsection