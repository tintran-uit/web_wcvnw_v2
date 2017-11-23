@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')
<link rel="stylesheet" type="text/css" href="{{url('')}}/assets/stylesheets/vendor/bootstrap-select.min.css">
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/bootstrap-select.min.js"></script>
<script type="text/javascript">
            $(document).ready(function() {
              $('#tab-1').bootstrapValidator({
                  framework: 'bootstrap',
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
                                  min: 1,
                                  max: 35,
                                  message: 'Họ tên không dưới 2 ký tự.'
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
                              },
                              stringLength: {
                                  min: 10,
                                  max: 13,
                                  message: 'Vui lòng nhập chính xác số điện thoại.'
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
              $('#liTab1').click(function() {
                checkForm2();
                $('#payment-next-button').html('Tiếp tục');
              });
              $('#liTab2').click(function() {
                checkForm2();

              });
              $('#liTab3').click(function() {
                getFormValue('#tab-2');
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
               @include('layouts.menu_user')
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
                  <div class="col-xs-6">Phí vận chuyển (*):</div>
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
                  
                  <a href="{{url('')}}/chinh-sach-giao-hang">
                    <u>(*) Miễn phí giao hàng với đơn hàng có giá trị trên 500.000 VND</u>
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
                           <li href="#tab-1" class="active text-center" data-toggle="tab" id="liTab1">
                              <a data-toggle="tab" aria-expanded="false">
                              <span class="numberCircle">1</span><br class="visible-xs">
                              <label class="visible-xs">Thông tin</label>
                              <label class="hidden-xs">Thông tin giao hàng</label>
                              </a>
                           </li>
                           <li data-toggle="tab" class="text-center" id="liTab2">
                              <a id="aTab2" data-toggle="tab" href="#tab-2" class="li-disabled">
                              <span class="numberCircle">2</span><br class="visible-xs">
                              <label class="visible-xs">Thanh toán</label>
                              <label class="hidden-xs">Phương thức thanh toán</label>
                              </a>
                           </li>
                           <li href="#tab-3" class="text-center" data-toggle="tab" id="liTab3">
                              <a data-toggle="tab">
                              <span class="numberCircle">3</span><br class="visible-xs">
                              <label class="visible-xs">Hoàn tất</label>
                              <label class="hidden-xs">Hoàn tất</label>
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
                                  @if(!Auth::check())
                                    <p>Bạn đã có tài khoản? <a data-toggle="modal" data-target="#modal-signin" style="color: #0071b6; font-weight: 700;" href="#">Đăng nhập</a></p>
                                    <p><a data-toggle="modal" data-target="#modal-signup" style="color: #0071b6; font-weight: 700;" href="#">Đăng ký tài khoản</a> <b>để nhận ưu đãi, đánh giá, kiểm tra tình trạng đơn hàng và mua sản phẩm nhanh chóng hơn!</b></p>
                                  @endif
                                    
                                 </div>
                                 </article>
                                 <article class="col-sm-12">

                                  <article class="col-sm-6" style="margin-top: 6px">
                                       <div class="form-group">
                                          <label>Thông tin liên hệ:</label>
                                       </div>
                                          <div class="form-group">
                                             <!-- <label>First and Last Name</label> -->
                                             <input name="sdt" value="@if($auth) {{$customer->phone}} @endif" type="text" class="form-control input-lg" placeholder="Số điện thoại: (*)" oninput="getCustomer(this)">
                                          </div>
                                          <div class="form-group">
                                                <input name="ten" type="text" value="@if($auth) {{$customer->name}} @endif" class="form-control input-lg" placeholder="Họ tên khách hàng (*)">
                                          </div>
                                          <div class="form-group">
                                                <input name="email" type="text" value="@if($auth) {{$customer->email}} @endif" class="form-control input-lg" placeholder="Email">
                                          </div>
                                   </article>
                                 <article class="col-sm-6" style="margin-top: 6px">
                                      <div class="form-group">
                                          <label>Địa chỉ giao hàng:</label>
                                      </div>
                                       <div class="form-group">
                                          <input name="diaChi" type="text" class="form-control input-lg" value="@if($auth) {{$customer->address}} @endif" placeholder="Nhập địa chỉ (*)">
                                       </div>
                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                             <select id="selectQuan" name="selectQuan" class="selectpicker show-tick form-control" onchange="setShipping()">
                                                <option value="">Chọn Quận/Huyện (*)</option>
                                                @foreach($districts as $district)
                                                <option value="{{$district->id}}" @if($auth) @if($district->id == $customer->district)
                                                    selected="selected"
                                                @endif @endif >{{$district->name}} 
                                                </option>
                                                @endforeach
                                             </select>
                                             
                                       </div>

                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                          <div class="selecter  closed" tabindex="0">
                                             <span class="selecter-selected">Hồ Chí Minh</span>
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
                              <!-- <h4 class="nomargin spacer-bottom-15">Phương thức thanh toán:</h4> -->
                              <div class="form-group no-margin">
                                 <p class="required-fields no-margin">* Nhấn "tiếp tục" để hoàn tất quá trình mua hàng</p>
                              </div>
                              <div class="payment-method-box">
                                 <div id="payment-0" class="choose selected">
                                    <a class="clearfix" onclick="payment(0)">
                                       <div class="pull-left">
                                          <span class="fa-stack spacer-15" id="tick-pay-0">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                                          </span>
                                       </div>
                                       <div class="col-xs-9">
                                          <h4 class="no-margin">
                                             <b>Thanh toán khi nhận hàng</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin" style="color: #222222">

                                              Nhân viên chúng tôi sẽ giao hàng và nhận thanh toán vào ngày thứ Bảy.<br> Vui lòng giữ liên lạc qua điện thoại.
                                              <!-- Cảm ơn bạn đã lựa chọn mua sắm tại Cfarm <br>
Nhân viên của chúng tôi sẽ sớm liên lạc với bạn qua điện thoại để <br>
XÁC NHẬN ĐƠN HÀNG
trước khi giao hàng! --></p>
                                          </p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img class="image-responsive" alt="giao hang tan noi" src="{{url('')}}/assets/images/icons/credit-cards/giao-rau-sach.png" style="width: 25%; margin-left: 50px;">
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
                                             <b>Thanh toán chuyển khoản ngân hàng</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin" style="color: #222222">
                                                Quý khách khàng vui lòng thanh toán qua một trong các tài khoản ngân hàng bên dưới:<br>
                                            </p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img class="image-responsive" alt="giao hang tan noi" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-online.png" style="width: 40%; margin-left: 50px;margin-top: 10px;">
                                       </div>
                                    </a>
                                 </div>
                              </div>
                              
                              <section>
                                 <h4>Bạn có mã giảm giá?</h4>
                                 <div class="row clearfix">
                                    <div class="col-xs-6 form-group">
                                       <input name="maGiamGia" type="text" class="form-control input-lg" placeholder="Nhập mã giảm giá (nếu có)">
                                    </div>
                                    <div class="col-xs-4 form-group no-padding-left">
                                    <a onclick="checkMaGiamGia()" class="btn btn-warning btn-block btn-lg no-margin">
                                      Thêm mã
                                    </a>
                                  </div>
                                 </div>
                              </section>
                              <section style="margin-top: 20px">
                                  <h4>Ghi chú thêm (nếu có)</h4>
                                  <div class="form-group row clearfix">
                                     <div class="col-sm-9">
                                        <textarea rows="4" name="note" class="form-control" placeholder="Nhập ghi chú thêm (nếu có)"></textarea>
                                     </div>
                                  </div>
                               </section>
                              <div class="form-group no-margin">
                                <p></p>
                                 <p class="required-fields text-right no-margin">* Nhấn "tiếp tục" để hoàn tất quá trình mua hàng</p>
                              </div>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-3">
                           <div class="text-center">
                              <i class="fa fa-check fa-4x alert-success"></i>
                              <h3>Đặt hàng thành công!</h3>
                              <p><b>Mã đơn đặt hàng: #<span id="order_id"></span>.</b><br>
                              Tất cả đơn hàng sẽ được giao vào ngày Thứ Bảy vì chúng tôi muốn nhận những <span style="color: #B62029; font-weight: 600">sản phẩm tươi ngon nhất, vừa thu hoạch và gửi trực tiếp đến bạn từ nông trại vào thứ Bảy hàng tuần.</span> Cảm ơn bạn đã mua thực phẩm sạch tại CFarm.vn.</p>
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
                        <a class="btn btn-primary btn-lg" onclick="nextStep()" id="nextButtonStep">                  <span class="hidden-xs" id="payment-next-button">Tiếp tục</span> <i class="fa fa-angle-double-right"></i>
                        </a>              
                     </div>
                  </div>
               </section>
            </article>
         </div>
         
      </div>
   </section>
   @include('layouts.banner_bottom')
</main>

<!-- Modal Dat hang -->
<div class="modal fade style-base-modal" id="modalOrderStatus" tabindex="-1" role="dialog" aria-labelledby="modalSubscribeNewsletter" aria-hidden="true">
  <div class="modal-dialog" style="">
    <div class="modal-content">
      <div class="inner-container">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title email-icon">Thông tin đặt hàng</h4>
        </div>
        <div class="modal-body row" style="margin: 0">
          <p>
            Đặt hàng thành công!
          </p>
          <p>
            Trạng thái: <b>chờ xác nhận.</b>
          </p>
          <p>
            Quý khách vui lòng chuyển khoản trước <b>6h:00pm thứ Năm, để xác nhận đơn hàng.</b> (*)
          </p>
          <p>
            Nội dung chuyển khoản bao gồm mã đơn hàng của bạn: <span id="order_id_modal" style="font-weight: bold;"></span>
            <br> Thông tin chuyển khoản:
          </p>
          <div class="banks">
              <div class="col-md-6 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-vcb.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">Ngân hàng Ngoại thương Việt Nam - VietComBank - Chi nhánh Phan Đăng Lưu</h4>

                    <p>Tài khoản: <strong>Phan Dinh Vuong</strong><br>
                        Số tài khoản: <strong>0441000644128</strong></p>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-hsbc.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">Ngân hàng TNHH một thành viên HSBC Việt Nam - Chi nhánh Etown Tân Bình</h4>

                    <p>Tài khoản: <strong>Phan Dinh Vuong</strong><br>
                        Số tài khoản: <strong>001 680883 041</strong></p>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-paypal.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">Thanh toán Paypal (Dành cho khách hàng ngoài Việt Nam)</h4>

                    <p>Tài khoản: <strong>dinhvuong1206@gmail.com</strong><br></p>
                </div>
              </div>
          </div>

          <div style="margin-top: 10px;float: left;">
              <p>(*) Sau khi nhận được thanh toán, nhân viên của Cfarm sẽ liên lạc qua điện thoại để xác nhận đơn hàng. Cảm ơn quý khách đã đồng hành cùng Cfarm xây dựng cộng đồng nuôi trồng thực phẩm sạch và hữu cơ.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scrip_code')

<script type="text/javascript">
  // $('#modalOrderStatus').modal('show');
      var spacerToal = '{{$subtotal}}';
      spacerToal = parseInt(spacerToal);
      var auth = '{{$auth}}';
      var dataPost = {};
      dataPost['thanhToan'] = 1;
      isMobilePayment();
      // var t=setInterval(checkForm1,900);
      function getCustomer(input) {
      $('#selectQuan').val('1');

          var checkSDT = input.value;
          if(checkSDT.length>=10){
            checkSDT = checkSDT.replace(" ", "");
            var url = 'api/customerinfo/phone='+checkSDT;
            $.getJSON( url )
            .done(function( data ) {
              data = data[0];
              if('name' in data){
                  $("input[name=ten]").val(data.name).trigger('change');
                  $("input[name=diaChi]").val(data.address);
                  $("input[name=email]").val(data.email);
                  $("#selectQuan").val(data.district).trigger('change');
                  auth = true;
              }
            })
            .fail(function( jqxhr, textStatus, error ) {
              var err = textStatus + ", " + error;
              console.log( "Request Failed: " + err );
          });
          }
      }
      
      function backStep() {
            var period_val = activaTab();
            switch (period_val){
               case "liTab1":
                  break;
               case "liTab2":
                  $('[href="#tab-1"]').tab('show');
                  $('#payment-next-button').html('Tiếp tục');
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
                      $('#payment-next-button').html('Tiếp tục');
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
         var tick = '<i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i>';
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
          
          if(auth)
          {
            return true;
          }
          return $(ntab).data('bootstrapValidator').isValid();
      }

      function checkForm2() {
        var check1 = checkForm('#tab-1');
        console.log(check1);
              if(check1==true)
              {
                $('[href="#tab-2"]').tab('show');
                $("#aTab2").removeClass("li-disabled");
                $('#payment-next-button').html('Tiếp tục');
                getFormValue('#tab-1');
              }else{
                var message = 'VUI LÒNG NHẬP ĐỦ THÔNG TIN BẮT BUỘC (*)';
                $('#modalMessage').html(message);
                $('#modalAlert').modal('show');
                $('#payment-next-button').html('Tiếp tục');
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
          alert('Mã giảm giá không đúng! Vui lòng kiểm tra.');
          // $.ajaxSetup({ cache: false });
          // $('#modalLoader').modal('show');
          // $.getJSON(url, function(data){
          //       $('#modalLoader').modal('hide');
          //       console.log(data);
          //       showTotal(data);
          //    }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
          //       $('#modalLoader').modal('hide');
          //        alert("Vui lòng kiểm tra kết nối internet.");
          //    });
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
            if(dataPost['thanhToan']==2){
              $('#modalOrderStatus').modal('show');
              document.getElementById("order_id_modal").textContent=data.order_id;
            }
            // if(dataPost['thanhToan']==)
            document.getElementById('btnStep').style.visibility = 'hidden';
            console.log(data);
            document.getElementById("order_id").textContent=data.order_id;
            updateCartStatus(data.Cart);
            
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
              $('#modalLoader').modal('hide');
              console.log(textStatus);
              alert("Vui lòng kiểm tra kết nối Internet!");
          }
        });
      }


      @if(Auth::check())
      setTimeout(function(){ setShipping(); }, 1000);
      @endif

    function setShipping() {
      var idDitris = document.getElementById("selectQuan").value;
      // idDitris = fr idDitris;
      var text;
      var spacerToalNow = spacerToal;
      console.log(idDitris);
      switch(idDitris) {
          case '1':
          case '3':
          case '4':
          case '5':
          case '7':
          case '8':
          case '10':
              text = "25.000 VND";
              spacerToalNow = spacerToal + 25000;
              break;
          case '2':
          case '6':
          case '11':
          case '17':
          case '16':
          case '14':
              text = "30.000 VND";
              spacerToalNow = spacerToal + 30000;
              break;
          case '9':
          case '12':
          case '15':
          case '19':
              text = "35.000 VND";
              spacerToalNow = spacerToal + 35000;
              break;
          case '13':
          case '20':
          case '21':
          case '22':
              text = "40.000 VND";
              spacerToalNow = spacerToal + 40000;
              break;
          default:
              text = "0 VND";
              spacerToalNow = spacerToal;
              break;
          
      }
      if(spacerToal>500000){
        text = "0 VND";
        spacerToalNow = spacerToal;
      }
      spacerToalNow = spacerToalNow + '';
      document.getElementById("spacer-ship").innerHTML = text;
      $('#spacer-toal').html(numberWithCommas(spacerToalNow) + ' VN');
    }

</script>
<script type="text/javascript">
  

</script>
@endsection