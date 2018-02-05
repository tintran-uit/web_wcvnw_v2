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
                                  message: "{{ trans('head.pleaseInputYourFullName') }}"
                              },
                              stringLength: {
                                  min: 2,
                                  max: 35,
                                  message: "{{ trans('head.pleaseInputYourCorrectName') }}"
                              }
                          }
                      },
                      sdt: {
                          validators: {
                              notEmpty: {
                                  message: "{{ trans('head.pleaseInputYourPhoneNumber') }}"
                              },
                              numeric: {
                                   message: "{{ trans('head.pleaseInputYourCorrectPhoneNumber') }}",
                              },
                              stringLength: {
                                  min: 10,
                                  max: 13,
                                  message: "{{ trans('head.pleaseInputYourCorrectPhoneNumber') }}"
                              }
                          }
                      },
                      diaChi: {
                          validators: {
                            notEmpty: {
                                  message: "{{ trans('head.pleaseInputYourDeliveryAddress') }}"
                              }
                          }
                      },
                      selectQuan: {
                          validators: {
                            notEmpty: {
                                  message: "{{ trans('head.pleaseSelectDeliveryDistrict') }}"
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
              <h4 class="text-uppercase no-margin">{{ trans('head.foodBag') }}</h4>
              <div class="spacer-top-5" style="margin-top: 5px;">
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6">{{ trans('head.estimation') }}</div>
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
                  <div class="col-xs-6">{{ trans('head.deliveryFee') }} (*):</div>
                  <div class="col-xs-6 text-right" id="spacer-ship">
                    
                  </div>
                </div>
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6">{{ trans('head.promotion') }}:</div>
                  <div class="col-xs-6 text-right" id="spacer-coupon">
                    
                  </div>
                </div>
                <hr>
                <div class="row spacer-bottom-5">
                  <div class="col-xs-6 highlighted"><strong>{{ trans('head.total') }}:</strong></div>
                  <div class="col-xs-6 text-right" id="spacer-toal"><?php echo(number_format($subtotal));
                      echo " VND"; ?></div>
                </div>
                <p class="small no-margin spacer-top-15">
                  
                  <a href="{{url('')}}/chinh-sach-giao-hang">
                    <u>(*) {{ trans('head.freeShip') }}</u>
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
                              <label class="visible-xs">{{ trans('head.information') }}</label>
                              <label class="hidden-xs">{{ trans('head.deliveryInformation') }}</label>
                              </a>
                           </li>
                           <li data-toggle="tab" class="text-center" id="liTab2">
                              <a id="aTab2" data-toggle="tab" href="#tab-2" class="li-disabled">
                              <span class="numberCircle">2</span><br class="visible-xs">
                              <label class="visible-xs">{{ trans('head.payment') }}</label>
                              <label class="hidden-xs">{{ trans('head.paymentMethod') }}</label>
                              </a>
                           </li>
                           <li href="#tab-3" class="text-center" data-toggle="tab" id="liTab3">
                              <a data-toggle="tab">
                              <span class="numberCircle">3</span><br class="visible-xs">
                              <label class="visible-xs">{{ trans('head.complete') }}</label>
                              <label class="hidden-xs">{{ trans('head.complete') }}</label>
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
                                    <p>{{ trans('head.alreadyHaveAccount') }}? <a data-toggle="modal" data-target="#modal-signin" style="color: #0071b6; font-weight: 700;" href="#">{{ trans('head.login') }}</a></p>
                                    <p><a data-toggle="modal" data-target="#modal-signup" style="color: #0071b6; font-weight: 700;" href="#">{{ trans('head.registerAccount') }}</a> <b>{{ trans('head.registerAccountMsg') }}!</b></p>
                                  @endif
                                    
                                 </div>
                                 </article>
                                 <article class="col-sm-12">

                                  <article class="col-sm-6" style="margin-top: 6px">
                                       <div class="form-group">
                                          <label>{{ trans('head.contactInformation') }}:</label>
                                       </div>
                                          <div class="form-group">
                                             <!-- <label>First and Last Name</label> -->
                                             <input name="sdt" value="@if($auth){{$customer->phone}}@endif" type="text" class="form-control input-lg" placeholder="{{ trans('head.phoneNumber') }}: (*)" oninput="getCustomer(this)">
                                          </div>
                                          <div class="form-group">
                                                <input name="ten" type="text" value="@if($auth){{$customer->name}}@endif" class="form-control input-lg" placeholder="{{ trans('head.deliveryFullNamHolder') }} (*)">
                                          </div>
                                          <div class="form-group">
                                                <input name="email" type="text" value="@if($auth){{$customer->email}}@endif" class="form-control input-lg" placeholder="Email">
                                          </div>
                                   </article>
                                 <article class="col-sm-6" style="margin-top: 6px">
                                      <div class="form-group">
                                          <label>{{ trans('head.deliveryAddress') }}:</label>
                                      </div>
                                       <div class="form-group">
                                          <input name="diaChi" type="text" class="form-control input-lg" value="@if($auth){{$customer->address}}@endif" placeholder="{{ trans('head.deliveryAddress') }} (*)">
                                       </div>
                                       <div class="form-group">
                                          <!-- <label>State</label>-->
                                             <select id="selectQuan" name="selectQuan" class="selectpicker show-tick form-control" onchange="setShipping()">
                                                <option value="">{{ trans('head.deliveryDistrict') }} </option>
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
                                             <span class="selecter-selected">{{ trans('head.HCMC') }}</span>
                                          </div>
                                       </div>
                                    
                                    
                                 </article>
                                 
                                   
                                 </article>
                              </div>
                              <div class="form-group no-margin">
                                 <p class="required-fields text-right no-margin">* {{ trans('head.mandatory') }}</p>
                              </div>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-2">
                           <form action="#" accept-charset="UTF-8" method="post" id="tab-2" class="form-style-base">
                              <!-- <h4 class="nomargin spacer-bottom-15">Phương thức thanh toán:</h4> -->
                              <div class="form-group no-margin">
                                 <p class="required-fields no-margin">* {{ trans('head.nextMsg') }}</p>
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
                                             <b>{{ trans('head.paymentOnCollection') }}</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin" style="color: #222222">{{ trans('head.pocMsg') }} </p>
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
                                             <b>{{ trans('head.payByBankTransfer') }}</b>
                                          </h4>
                                          <p class="no-margin">
                                             <p class="no-margin" style="color: #222222">{{ trans('head.payByBankMsg') }}:<br>
                                            </p>
                                       </div>
                                       <div class="pull-right hidden-xs">
                                          <img class="image-responsive" alt="giao hang tan noi" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-online.png" style="width: 40%; margin-left: 50px;margin-top: 10px;">
                                       </div>
                                    </a>
                                 </div>
                              </div>
                              
                              <section>
                                 <h4>{{ trans('head.youHavePromotionCode') }}?</h4>
                                 <div class="row clearfix">
                                    <div class="col-xs-6 form-group">
                                       <input name="maGiamGia" type="text" class="form-control input-lg" placeholder="{{ trans('head.inputPromotionIfHave') }}">
                                    </div>
                                    <div class="col-xs-4 form-group no-padding-left">
                                    <a onclick="checkMaGiamGia()" class="btn btn-warning btn-block btn-lg no-margin">
                                      {{ trans('head.orderNote') }}
                                    </a>
                                  </div>
                                 </div>
                              </section>
                              <section style="margin-top: 20px">
                                  <h4>{{ trans('head.orderNoteTitle') }}</h4>
                                  <div class="form-group row clearfix">
                                     <div class="col-sm-9">
                                        <textarea rows="4" name="note" class="form-control" placeholder="{{ trans('head.orderNote') }}"></textarea>
                                     </div>
                                  </div>
                               </section>
                              <div class="form-group no-margin">
                                <p></p>
                                 <p class="required-fields text-right no-margin">* {{ trans('head.nextMsg') }}</p>
                              </div>
                           </form>
                        </div>
                        <div class="tab-pane" id="tab-3">
                           <div class="text-center">
                              <i class="fa fa-check fa-4x alert-success"></i>
                              <h3>{{ trans('head.orderSuccess') }}!</h3>
                              <p><b>{{ trans('head.orderID') }}: #<span id="order_id"></span>.</b><br>
                              {{ trans('head.orderSuccessMsg') }}.</p>
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
                        <a class="btn btn-info btn-lg" onclick="backStep()">                  <i class="fa fa-angle-double-left"></i> <span class="hidden-xs">{{ trans('head.back') }}</span>
                        </a>
                        <a class="btn btn-primary btn-lg" onclick="nextStep()" id="nextButtonStep">                  <span class="hidden-xs" id="payment-next-button">{{ trans('head.next') }}</span> <i class="fa fa-angle-double-right"></i>
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
          <h4 class="modal-title email-icon">{{ trans('head.orderInformation') }}</h4>
        </div>
        <div class="modal-body row" style="margin: 0">
          <p>
            {{ trans('head.orderSuccess') }}!
          </p>
          <p>
            {{ trans('head.orderStatus') }}: <b>{{ trans('head.waitingForConfirmation') }}.</b>
          </p>
          <p>
            {{ trans('head.transferDeadline') }}.</b> (*)
          </p>
          <p>
            {{ trans('head.transferContent') }}: <span id="order_id_modal" style="font-weight: bold;"></span>
            <br> {{ trans('head.transferInformation') }}:
          </p>
          <div class="banks">
              <div class="col-md-6 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="mua thực phẩm sạch online" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-vcb.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">{{ trans('head.VCBBankTitle') }}</h4>

                    <p>{{ trans('head.bankAccountName') }}: <strong>Phan Dinh Vuong</strong><br>
                        {{ trans('head.bankAccountNumber') }}: <strong>0441000644128</strong></p>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-hsbc.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">HSBCBankTitle</h4>

                    <p>{{ trans('head.bankAccountName') }}: <strong>Phan Dinh Vuong</strong><br>
                        {{ trans('head.bankAccountNumber') }}: <strong>001 680883 041</strong></p>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 bank">
                <div class="image">
                    <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-paypal.png">
                </div>
                <div class="contentBank">
                    <h4 class="title">{{ trans('head.paypalBankTitle') }}</h4>

                    <p>{{ trans('head.bankAccountNumber') }}: <strong>dinhvuong1206@gmail.com</strong><br></p>
                </div>
              </div>
          </div>

          <div style="margin-top: 10px;float: left;">
              <p>(*) {{ trans('head.bankTransferMsg') }}.</p>
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
                  $('#payment-next-button').html("{{ trans('head.next') }}");
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
                      $('#payment-next-button').html("{{ trans('head.next') }}");
                      getFormValue('#tab-1');
                      console.log(dataPost);
                    }
                  else{
                      var message = "{{ trans('head.pleaseInputAllMandatoryInformation') }}";
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
      if(spacerToal>=500000){
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