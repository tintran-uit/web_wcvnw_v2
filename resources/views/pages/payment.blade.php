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
                                  min: 2,
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
                                  @if(!Auth::check())
                                    <p>Bạn đã có tài khoản? <a style="color: #0071b6; font-weight: 700;" href="{{url('/login')}}">Đăng nhập</a></p>
                                    <p>Vui lòng nhập địa chỉ! <a style="color: #0071b6; font-weight: 700;" href="{{url('/register')}}">Đăng ký tài khoản</a> để nhận ưu đãi và mua hàng nhanh chóng hơn!</p>
                                  @endif
                                    <div class="form-group">
                                       <!-- <label>First and Last Name</label> -->
                                       <input name="ten" type="text" value="@if($auth) {{$customer->name}} @endif" class="form-control input-lg" placeholder="Họ tên khách hàng (*)">
                                    </div>
                                 </div>
                                 </article>
                                 <article class="col-sm-12">
                                 <article class="col-sm-6">
                                       <div class="form-group">
                                          <label>Địa chỉ giao hàng</label>
                                          <input name="diaChi" type="text" class="form-control input-lg" value="@if($auth) {{$customer->address}} @endif" placeholder="Nhập địa chỉ (*)">
                                       </div>
                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                             <select id="selectQuan" name="selectQuan" class="form-control" onchange="setShipping()">
                                                <option value="">Chọn Quận/Huyện (*)</option>
                                                @foreach($districts as $district)
                                                <option value="{{$district->id}}"@if($auth) @if($district->id == $customer->district)
                                                    selected="selected"
                                                @endif @endif>{{$district->name}} 
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
                                                <input name="sdt" value="@if($auth) {{$customer->phone}} @endif" type="text" class="form-control input-lg">
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
                                                <input name="email" type="text" value="@if($auth) {{$customer->email}} @endif" class="form-control input-lg">
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
                                         <!--  <h4 class="no-margin">
                                             <b>Chuyển khoản ngân hàng</b>
                                          </h4>
                                          <p class="no-margin">Cảm ơn bạn đã lựa chọn mua sắm tại We Care VN, <br>
Nhân viên của chúng tôi sẽ sớm liên lạc với bạn qua điện thoại để <br>
XÁC NHẬN ĐƠN HÀNG <br>
trước khi giao hàng!</p> --><h4 class="no-margin">
                                             <b>Thanh toán khi nhận hàng</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin" style="color: #000">Cảm ơn bạn đã lựa chọn mua sắm tại Cfarm, <br>
                                              Nhân viên của chúng tôi sẽ sớm liên lạc với bạn qua điện thoại để <br>
                                              XÁC NHẬN ĐƠN HÀNG <br>
                                              trước khi giao hàng!</p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img alt="credit cards"  class="image-responsive" src="{{url('')}}/assets/images/icons/credit-cards/giao-rau-sach.jpg">
                                       </div>
                                    </a>
                                 </div>
                                 <!-- <div id="payment-1" class="choose deselected">
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
                                 </div> -->
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
                              <p><b>Mã đơn đặt hàng: #<span id="order_id"></span>.</b><br>Cảm ơn bạn đã mua thực phẩm an toàn tại CFarm.vn.</p>
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
         
      </div>
   </section>
   @include('layouts.banner_bottom')
</main>

@endsection
@section('scrip_code')

<script type="text/javascript">
      var spacerToal = '{{$subtotal}}';
      spacerToal = parseInt(spacerToal);
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
          var auth = '{{$auth}}';
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
      
      setTimeout(function(){ setShipping(); }, 1000);
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
              text = "20.000 VNĐ";
              spacerToalNow = spacerToal + 20000;
              break;
          case '2':
          case '6':
          case '11':
          case '17':
          case '16':
          case '14':
              text = "25.000 VNĐ";
              spacerToalNow = spacerToal + 25000;
              break;
          case '9':
          case '12':
          case '15':
          case '19':
              text = "30.000 VNĐ";
              spacerToalNow = spacerToal + 30000;
              break;
          default:
              text = "35.000 VNĐ";
              spacerToalNow = spacerToal + 35000;
              break;
          
      }
      console.log(spacerToalNow);
      spacerToalNow = spacerToalNow + '';
      document.getElementById("spacer-ship").innerHTML = text;
      $('#spacer-toal').html(numberWithCommas(spacerToalNow) + ' VN');
    }
</script>
@endsection