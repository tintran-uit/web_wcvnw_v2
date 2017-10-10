<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="{{ $page->meta_description }}">
      <meta name="title" content="{{ $page->meta_title }}">
      <meta name="keywords" content="{{ $page->meta_keywords }}">
      <meta name="csrf_token" content="{{ csrf_token() }}">
      <meta name="author" content="">
      <!-- Use title if it's in the page YAML frontmatter -->
      <title>@yield('title')</title>
      <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic-ext,latin" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/normalize.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/animate.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/all.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/main.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/loader.css" rel="stylesheet" type="text/css" />
      <link rel="apple-touch-icon" sizes="57x57" href="{{url('')}}/assets/images/favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="{{url('')}}/assets/images/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="{{url('')}}/assets/images/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="{{url('')}}/assets/images/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="{{url('')}}/assets/images/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="{{url('')}}/assets/images/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="{{url('')}}/assets/images/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="{{url('')}}/assets/images/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="{{url('')}}/assets/images/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="{{url('')}}/assets/images/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="{{url('')}}/assets/images/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="{{url('')}}/assets/images/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="{{url('')}}/assets/images/favicon/favicon-16x16.png">
      <link rel="manifest" href="{{url('')}}/assets/images/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
      <script src="{{url('')}}/assets/javascripts/vendor/jquery-2.1.3.min.js" type="text/javascript"></script>
      <script src="{{url('')}}/assets/javascripts/vendor/bootstrap/bootstrap.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="{{url('')}}/assets/stylesheets/vendor/bootstrap/css/bootstrapValidator.min.css"/>
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/bootstrap/bootstrapValidator.min.js"></script>
      <script src="{{url('')}}/assets/javascripts/utility.js" type="text/javascript"></script>
      <script src="{{url('')}}/assets/javascripts/all.js" type="text/javascript"></script>
      <script src="{{url('')}}/assets/javascripts/load.js" type="text/javascript"></script>
      <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script> -->
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      @yield('headInput')
       
   </head>
   <body class="index">
      <div id="chat" class="box-chat col-sm-5 col-md-4 col-lg-2 hidden-xs">
         <div class="clearfix">
            <div class="pull-left" id="chat-title">Bạn cần hỗ trợ?</div>
            <div class="pull-right">
               <a class="btn-link button-show" href="#">        <i class="glyphicon glyphicon-plus"></i>
               </a>    
            </div>
         </div>
         <div class="content" style="display: none">
            <h5>CFarm sẽ trả lời yêu cầu của bạn sớm nhất!</h5>
            <script type="text/javascript">
              window.fbAsyncInit = function () {
                  FB.init({
                      appId: '657549527725084',
                      xfbml: true,
                      version: 'v2.6'
                  });
              };
              (function (d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) {
                      return;
                  }
                  js = d.createElement(s);
                  js.id = id;
                  js.src = "//connect.facebook.net/en_US/sdk.js";
                  fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));
          </script>
          <div class="fb-page"
               data-href="https://www.facebook.com/Cfarm.vn/"
               data-tabs="messages"
               data-width="321"
               data-height="300"
               data-small-header="true">
              <div class="fb-xfbml-parse-ignore">
                  <blockquote></blockquote>
              </div>
          </div>
         </div>
      </div>
      <div class="affix" id="nl-box-slider" style="right: -305px;">
         <div class="clearfix">
            <div class="pull-left">
               <a class="btn-block" id="label-subscribe" href="#">        <img alt="subscribe newsletter" src="{{url('')}}/assets/images/icons/btn-nl.png" />
               </a>    
            </div>
            <div class="content pull-left" id="subscribe-nl">
               <h2 class="no-margin-top">Cơ hội nhận nhiều ưu đãi</h2>
               <form action="/#" accept-charset="UTF-8" method="post">
                  <fieldset>
                     <div>
                        <label for="email_address">Nhập email: </label>
                     </div>
                     <div class="form-inline">
                        <div class="form-group">
                           <input type="email" class="form-control" name="emailCus" />
                        </div>
                        <a onclick="addEmailCus()" class="btn btn-light no-margin">
                        <i class="fa fa-chevron-right"></i>
                        </a>
                     </div>
                     <div class="checkbox">
                        <label>
                        <input type="checkbox" name="receiveEmailCus" value="1" checked/> Đồng ý nhận thông tin khuyến mãi!
                        </label>
                     </div>
                     <div class="text-right">
                     <a href="/">CFarm Việt Nam</a>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>

       <!-- Modal Signin -->
<div class="modal fade style-base-modal" id="modal-signin" tabindex="-1" role="dialog" aria-labelledby="modalSigninLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container clearfix bg-white">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title email-icon" id="modalSigninLabel">{{ trans('head.login') }}</h4>
        </div>
        <div class="modal-body clearfix">
          <div class="col-xs-12 col-md-7 vcenter">
<form action="{{url('')}}/admin/login" accept-charset="UTF-8" method="post" class="form-style-base" style="margin-top: 15px">
  {{ csrf_field() }}
  <fieldset>    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="email" class="form-control input-lg" name="email" placeholder="Enter email" value="{{ old('email') }}" />
                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <input type="password" class="form-control input-lg" placeholder="Password" name="password"/>
                  @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                </div>

                <div class="checkbox">
                  <label class="btn-link small">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>Nhớ mật khẩu
                  </label>
                </div>

</fieldset>
<fieldset>                <button type="submit" class="btn btn-warning btn-lg btn-block">
                  <i class="glyphicon glyphicon-log-in"></i> {{ trans('head.login') }}
                </button>
</fieldset>
              <div class="small text-center spacer-bottom-10">
                <a class="btn-link" data-toggle="modal" data-target="#modal-reset-psw" href="" data-dismiss="modal">Quên mật khẩu?</a>
              </div>

</form>
          </div>
          <div class="hidden-xs col-md-5 vcenter" style="width:40%">
            <div class="text-center">
            <!-- <h4 class="no-margin-top">
              Use your social network<br>account to signin
            </h4>
            <div class="socials btn-group clearfix">
              
          <a class="btn-social btn-facebook " href="#">  <i class="fa fa-facebook fa-1x"></i>
          </a>
              
          <a class="btn-social btn-twitter " href="#">  <i class="fa fa-twitter fa-1x"></i>
          </a>
            </div> -->
            <img class="image-responsive" alt="Kids Store" src="{{url('')}}/assets/images/logo.png" style="height: 56px">
            <h5 class="no-margin-top">
              {{ trans('head.slogan1') }} <br>
              {{ trans('head.slogan2') }}
            </h5>

          </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

       <!-- Modal Signup -->
<div class="modal fade style-base-modal" id="modal-signup" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modalSignupLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container clearfix">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title email-icon" id="modalSignupLabel">Tạo tài khoản</h4>
        </div>
        <div class="modal-body clearfix">
          <div class="col-md-12 no-padding">
<form action="{{url('')}}/admin/register" accept-charset="UTF-8" method="post" class="form-style-base">              
{{ csrf_field() }}   
               <div class="form-group">
                <input type="email" class="form-control input-lg" placeholder="Email" name="email"/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="name" placeholder="Tên {{ trans('head.login') }}" />
                 @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt"></i>
                </span>
                <input type="password" class="form-control input-lg" placeholder="Mật khẩu" name="password"/>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>

              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt"></i>
                </span>
                <input type="password" class="form-control input-lg" placeholder="Nhập lại mật khẩu" name="password_confirmation"/>
              </div>

              <div class="required-fields text-right spacer-bottom-5">
                Vui lòng nhập thông tin
              </div>

              <div>
                
              </div>

              <div>
                <button type="submit" class="btn btn-warning btn-lg btn-block">
                  <i class="fa fa-user"></i> Tạo tài khoản
                </button>
              </div>
              <p class="text-center small no-margin">
                Bạn đã có tài khoản? <a class="btn-link" data-toggle="modal" data-target="#modal-signin" href="" data-dismiss="modal">{{ trans('head.login') }}</a>
              </p>
</form>          </div>
          <!-- <div class="col-md-5 spacer-30">
            <div class="text-center">
              <h4 class="no-margin-top">
                Use your social network<br>account to signin
              </h4>
              <div class="socials btn-group clearfix">
                
            <a class="btn-social btn-facebook " href="#">  <i class="fa fa-facebook fa-1x"></i>
            </a>
                
            <a class="btn-social btn-twitter " href="#">  <i class="fa fa-twitter fa-1x"></i>
            </a>
              </div>
            </div>

          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal reset psw -->
<div class="modal fade style-base-modal" id="modal-reset-psw" tabindex="-1" role="dialog" aria-labelledby="modalResetPsw" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title email-icon" id="modalResetPsw">{{ trans('head.reswtpass') }}</h4>
        </div>
        <div class="modal-body">
          <p>
            {{ trans('head.reswtpass_status') }}
          </p>
<form action="{{ url('admin/password/email') }}" role="form" method="POST" class="form-style-base">{{ csrf_field() }}  <fieldset>              <div class="row clearfix">
                <div class="form-group col-sm-9">
                  <input type="email" class="form-control input-lg" placeholder="Enter email" name="email" value="{{ old('email') }}"/>
                </div>
                <div class="col-sm-3">
                  <input type="submit" value="SEND" class="btn btn-warning no-margin btn-block" />
                </div>
              </div>
</fieldset></form>        </div>
      </div>
    </div>
  </div>
</div>
      
      <!-- modal loading -->
      <div class="modal fade style-base-modal modalLoader" id="modalLoader" tabindex="-1" role="dialog" aria-labelledby="modalResetPsw" aria-hidden="true">
         <div class="modal-dialog">
            
         </div>
      </div>
      <!-- modal Alert -->
       <div class="modal fade simple-modal" id="modalAlert" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 35%">
               <div class="inner-container" style="border-color: #b50000">
                  <div class="modal-header text-center">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times"></i>
                     </span>
                     </button>
                     <h4 class="modal-title fa fa-exclamation-triangle" style="color: #b50000;"></h4>
                     <h4 id="modalMessage" style="color: #b50000;"></h4>
                  </div>
               </div>
            </div>
         </div>
      </div><!-- modal Finish-->
       <div class="modal fade simple-modal" id="modalAlertFinish" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content" style="margin-top: 35%">
               <div class="inner-container" style="border-color: #3399FF">
                  <div class="modal-header text-center">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times"></i>
                     </span>
                     </button>
                     <h4 class="modal-title fa fa-flag-checkered" style="color: #3399FF;"></h4>
                     <h4 id="modalMessageFinish" style="color: #3399FF;"></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal buy voucher -->
      
      <header class="bg-white">
         <section id="pre-header">
            <div class="container">
               <div class="row clearfix">
                  <div class="col-sm-6">
                     <p class="hidden-xs spacer-top-10">
                        <i class="fa fa-truck"></i> GIAO HÀNG TẬN NƠI
                     </p>
                  </div>
                  <div class="col-sm-6">
                     <div class="pull-right">
                        <nav class="no-margin pull-left">
                           <div id="nav-sign" class="collapse navbar-collapse">
                              <ul class="nav navbar-nav">
                                 <li>
                                    <a>                    <i class="fa fa-heart"></i>
                                    </a>                
                                 </li>
                                 <li class="spacer-10">|</li>
                                 @if(!isset(Auth::user()->name)) 
                                 <li>
                                    <button type="button" data-toggle="modal" data-target="#modal-signup">
                                    {{ trans('head.register') }}
                                    </button>
                                 </li>
                                 <li class="spacer-10">|</li>
                                 <li>
                                    <button type="button" data-toggle="modal" data-target="#modal-signin">
                                    {{ trans('head.login') }}
                                    </button>
                                 </li>
                                 @else
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin chào <strong> {{Auth::user()->name}} </strong> <i class="fa fa-chevron-down"></i>
                                    </a>          
                                    <ul class="dropdown-menu" role="menu">
                                       <!-- <li>
                                          <a href="account.html">Edit profile</a>
                                       </li>
                                        -->
                                       <li>
                                          <a href="{{url('')}}/admin/logout">Log out</a>
                                       </li>
                                    </ul>
                                  </li>
                                 @endif
                              </ul>
                           </div>
                        </nav>
                        <article class="hidden-xs pull-left">
                           <div class="dropdown language">
                            @if(App::isLocale('vi'))
                              <a data-toggle="dropdown" class="dropdown-toggle" href="{{URL::asset('')}}language/vi">                <img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-vietnam.jpg" />
                              <span id="country-lang">Tiếng Việt</span>
                              <i class="fa fa-angle-down"></i>
                              </a>              
                              <ul class="dropdown-menu list-unstyled">
                                 <li>
                                    <a class="text-center" href="{{url('')}}/language/en"><img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-england.jpg" />
                                      <span id="country-lang"> English</span>
                                    </a>                
                                 </li>
                              </ul>
                            @else
                              <a data-toggle="dropdown" class="dropdown-toggle" href="{{URL::asset('')}}language/en">                <img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-england.jpg" />
                              <span id="country-lang">English</span>
                              <i class="fa fa-angle-down"></i>
                              </a>              
                              <ul class="dropdown-menu list-unstyled">
                                 <li>
                                    <a class="text-center" href="{{url('')}}/language/vi"><img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-vietnam.jpg" />
                                      <span id="country-lang">Tiếng Việt</span>
                                    </a>                
                                 </li>
                              </ul>
                            @endif
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section id="main-header">
            <div class="container">
               <div class="row clearfix">
                  <article class="col-sm-12 col-md-4 col-lg-3" id="logo">
                    <a href="./">          <img class="image-responsive" alt="Kids Store" src="{{url('')}}/assets/images/logo.png" style="height: 86px" />
                     </a>
                  </article>
                  
                  <article class="col-sm-12 col-md-4 col-lg-3 hidden-xs col-md-offset-6">
                     
                     <div class="dropdown bg-white" id="basket">
                        <div class="shadow-wrap-box">
                           <a href="#" class="checkout-basket dropdown-toggle btn-block clearfix" data-toggle="dropdown" aria-expanded="true">
                              <div class="pull-left bg-super-light" style="background-color: #64903E !important">
                                 <i class="fa fa-shopping-cart"></i>
                              </div>
                              <div class="info-basket pull-left">
                                 <span id="cart-status" data-name="item" style="font-weight: 700; color: #fff">
                                 @if(count($cart) == 0)
                                 Giỏ hàng rỗng
                                 @else
                                 Bạn có {{count($cart)}} nông sản sạch!
                                 @endif
                                 </span>
                                 <span data-name="price">
                                 <strong></strong>
                                 </span>
                              </div>
                              <div class="pull-right arrow">
                                 <i class="glyphicon glyphicon-chevron-down"></i>
                              </div>
                           </a>
                           <div class="block-basket wrap-radius btn-block dropdown-menu col-lg-4 col-xs-12 col-md-4" role="menu">
                              <div class="content-basket">
                                 <ul id='cart-list-product' class="products-list list-unstyled">
                                 <?php $total = 0;?>
                                 @foreach($cart as $item)
                                    <li class="item">
                                       <div class="clearfix row">
                                          <div class="col-xs-10 product-details">
                                             <div class="clearfix row">
                                                <p class="col-xs-8 product-name no-margin">
                                                   {{$item->name}}  x{{$item->qty}}
                                                </p>
                                                <p class="col-xs-4 price no-margin text-right no-padding">
                                                   {{number_format($item->subtotal)}} VND
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-xs-2 no-padding-left">
                                             <a type="button" class="close" data-dismiss="modal" onclick="deleteItem('{{$item->rowId}}')">
                                             <i class="fa fa-times"></i>
                                             </a>
                                          </div>
                                       </div>
                                    </li>
                                    <?php $total += $item->subtotal; ?>
                                 @endforeach
                                 </ul>
                                 <div class="summary clearfix">
                                    <p class="amount pull-left no-margin"></p>
                                    <p class="subtotale pull-right no-margin">
                                       Tổng:&nbsp;&nbsp;&nbsp;<span class="price" id="cart-status-total">{{number_format($total)}} VND</span>
                                    </p>
                                 </div>
                                 <div class="button-basket text-right">
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/gio-hang-thuc-pham-sach')}}">Xem giỏ hàng</a>
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/thanh-toan')}}">Thanh toán</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
               </div>
            </div>
         </section>
         <section id="main-nav-bar" class="hidden-xs">
          <hr>
            <div class="container">
               <div class="row">
                  <article class="col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
                     <nav class="navbar navbar-default" id="main-nav">
                        <div class="nav-bar navbar-default dropdown-main-nav">
                           <div class="collapse navbar-collapse">
                              <ul class="nav nav-justified" id="mainMN">
                                 <li id="litrangchu" class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{url('/')}}">{{ trans('head.home') }}</a>
                                 </li>
                                 <li class="{{ Request::is('thong-tin-nha-phan-phoi-we-cae-vn') ? 'active' : '' }} {{ Request::is('dia-chi-lien-he-wecarevn') ? 'active' : '' }} {{ Request::is('chinh-sach-lien-ket-nong-dan') ? 'active' : '' }}  {{ Request::is('huong-dan-mua-thuc-pham-sach') ? 'active' : '' }}  {{ Request::is('chinh-sach-doi-tra') ? 'active' : '' }}">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.about') }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                       <li class="clearfix row">
                                          <div class="col-sm-12">
                                             <ul class="list-unstyled">
                                                <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-we-cae-vn">{{ trans('head.about1') }}</a> </li>     
                                                <li><a href="{{url('')}}/dia-chi-lien-he-wecarevn">{{ trans('head.about2') }}</a>      </li>
                                                <li><a href="{{url('')}}/chinh-sach-lien-ket-nong-dan"> {{ trans('head.about3') }}</a>  </li> 
                                             </ul>
                                          </div>
                                       </li>
                                    </ul>
                                 </li>
                                 <li class="">
                                    <a role="button" class="dropdown-toggle" href="{{url('/mua-thuc-pham-sach')}}" id="menu-Muahang"> {{ trans('head.product') }}
                                    </a>                  
                                 </li>
                                 <li class="@if($page->template == 'blog') active @endif">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.blog') }} <i class="fa fa-angle-down"></i></a> 
                                    <ul class="dropdown-menu">
                                       <li class="clearfix row">
                                          <div class="col-sm-12">
                                             <ul class="list-unstyled">
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=3">{{ trans('head.blog1') }}</a> </li>     
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=4">{{ trans('head.blog2') }}</a>      </li>
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=5">{{ trans('head.blog3') }}</a>  </li> 
                                             </ul>
                                          </div>
                                       </li>
                                    </ul>
                                 </li>
                                 <li class="dropdown box-extended {{ Request::is('thong-tin-trang-trai-an-toan') ? 'active' : '' }}">
                                    <a href="{{url('')}}/thong-tin-trang-trai-an-toan">{{ trans('head.farmerlist') }}
                                    </a>                  
                                    
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </nav>
                  </article>
                  
               </div>
            </div>
         </section>
         <!--Menu responsive-->
         <section class="visible-xs">
            <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #f8f8f8; border-color: #e7e7e7;">
              <div class="container" style="background-color: rgba(106,184,69, 0.5);">
                <div class="col-xs-6 vcenter" style="font-style: 12px; color: #777">
                 @if(!isset(Auth::user()->name)) 
                    <button type="button" data-toggle="modal" data-target="#modal-signup">
                    {{ trans('head.register') }}
                    </button>
                   <span class="spacer-10">|</span>
                      <button type="button" data-toggle="modal" data-target="#modal-signin">
                      {{ trans('head.login') }}
                      </button>
                   @else
                   <li>
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin chào <strong> {{Auth::user()->name}} </strong> <i class="fa fa-chevron-down"></i>
                      </a>          
                      <ul class="dropdown-menu" role="menu">
                         <!-- <li>
                            <a href="account.html">Edit profile</a>
                         </li>
                          -->
                         <li>
                            <a href="{{url('')}}/admin/logout">Log out</a>
                         </li>
                      </ul>
                  </li>
                 @endif
                 </div>
                <div class="col-xs-5 vcenter">
                  <div style="float: right; font-style: 12px; color: #777">
                            @if(App::isLocale('vi'))
                              <a data-toggle="dropdown" class="dropdown-toggle" href="{{URL::asset('')}}language/vi">                <img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-vietnam.jpg" />
                              <span id="country-lang">Tiếng Việt</span>
                              <i class="fa fa-angle-down"></i>
                              </a>              
                              <ul class="dropdown-menu list-unstyled">
                                 <li>
                                    <a class="text-center" href="{{url('')}}/language/en"><img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-england.jpg" />
                                      <span id="country-lang"> English</span>
                                    </a>                
                                 </li>
                              </ul>
                            @else
                              <a data-toggle="dropdown" class="dropdown-toggle" href="{{URL::asset('')}}language/en">                <img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-england.jpg" />
                              <span id="country-lang">English</span>
                              <i class="fa fa-angle-down"></i>
                              </a>              
                              <ul class="dropdown-menu list-unstyled">
                                 <li>
                                    <a class="text-center" href="{{url('')}}/language/vi"><img alt="England" src="{{url('')}}/assets/images/icons/flags/flag-vietnam.jpg" />
                                      <span id="country-lang">Tiếng Việt</span>
                                    </a>                
                                 </li>
                              </ul>
                            @endif
                           </div>
                </div>
              </ul>
              </div>
               <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     </button>
                     <a class="navbar-brand" href="{{url('/gio-hang-thuc-pham-sach')}}">
                     <i class="fa fa-shopping-cart"></i> <span class="badge">{{count($cart)}}</span>
                     </a>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{url('/')}}">{{ trans('head.home') }}</a>
                        </li>
                        <li class="{{ Request::is('thong-tin-nha-phan-phoi-we-cae-vn') ? 'active' : '' }} {{ Request::is('dia-chi-lien-he-wecarevn') ? 'active' : '' }} {{ Request::is('chinh-sach-lien-ket-nong-dan') ? 'active' : '' }}  {{ Request::is('huong-dan-mua-thuc-pham-sach') ? 'active' : '' }}  {{ Request::is('chinh-sach-doi-tra') ? 'active' : '' }}">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.about') }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                                <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-we-cae-vn">{{ trans('head.about1') }}</a> </li>     
                                                <li><a href="{{url('')}}/dia-chi-lien-he-wecarevn">{{ trans('head.about2') }}</a>      </li>
                                                <li><a href="{{url('')}}/chinh-sach-lien-ket-nong-dan"> {{ trans('head.about3') }}</a>  </li> 
                                    </ul>
                                 </li>
                                 <li class="">
                                    <a role="button" class="dropdown-toggle" href="{{url('/mua-thuc-pham-sach')}}" id="menu-Muahang"> {{ trans('head.product') }}
                                    </a>                  
                                 </li>
                                 <li class="">
                                    <a href="#">Thư viện ảnh</a> 
                                 </li>
                                 <li class="dropdown box-extended {{ Request::is('thong-tin-trang-trai-an-toan') ? 'active' : '' }}">
                                    <a href="{{url('')}}/thong-tin-trang-trai-an-toan">{{ trans('head.farmerlist') }}<i class="fa fa-angle-down"></i>
                                    </a>                  
                                    
                                 </li>
                     </ul>
                  </div>
                  <!-- /.navbar-collapse -->
               </div>
            </nav>
         </section>
      </header>
      
      @yield('main class')
      
      <footer id="footer">
         <section id="contact-footer">
            <section class="info-box">
               <div class="container">
                  <div class="row">
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="tel" src="{{url('')}}/assets/images/icons/icon-tel.png" height="39" />
                           <span data-info="text-info">Hotline: +0 888 9090 909</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="time" src="{{url('')}}/assets/images/icons/icon-shipping.png" height="39" />
                           <span data-info="text-info">Giao hàng tận nơi</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="email" src="{{url('')}}/assets/images/icons/icon-mail.png" height="39" />
                           <span data-info="text-info">
                           Hỗ trợ: support@cfarm.vn
                           </span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="location" src="{{url('')}}/assets/images/icons/icon-location.png" height="39" />
                           <span data-info="text-info">167 Trần Trọng Cung, Q.7</span>
                        </div>
                     </article>
                  </div>
               </div>
            </section>
         </section>
         <section class="footer-widgets bg-white spacer-20">
            <div class="container">
               <div class="row clearfix">
                  <article class="col-xs-12 col-sm-7">
                     <div class="clearfix row">
                        <div class="col-sm-5">
                           <ul class="footer-widget-list list-unstyled"><li><strong>C-farm! </strong></li></ul>
                           Kết nối người tiêu dùng với những lương nông trên nền tảng công nghệ. Bạn có thể đặt mua thực phẩm sạch hoặc hữu cơ trực tiếp từ những trang trại thông qua <a href="{{url('')}}">www.cfarm.vn</a> hoặc (Android & iOS App)
                        </div>
                        <div class="col-sm-3 col-sm-offset-1">
                           <ul class="footer-widget-list list-unstyled spacer-bottom-5">
                              <li>
                                 <strong>Thông tin</strong>
                              </li>
                           <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-we-cae-vn">{{ trans('head.about1') }}</a> </li>     
                           <li><a href="{{url('')}}/dia-chi-lien-he-wecarevn">{{ trans('head.about2') }}</a>      </li>
                           <li><a href="{{url('')}}/chinh-sach-lien-ket-nong-dan"> {{ trans('head.about3') }}</a>  </li>    
                           </ul>
                        </div>
                        <div class="col-sm-3">
                           <ul class="footer-widget-list list-unstyled">
                              <li>
                                 <strong>Chăm sóc khách hàng</strong>
                              </li>
                              <li>
                                 <a class="" href="{{url('')}}/huong-dan-mua-thuc-pham-sach">Hướng dẫn {{ trans('head.product') }}
                           </a>
                              </li>
                              <li>
                                 <a class="" href="{{url('')}}/chinh-sach-doi-tra">Chính sách đổi trả
                           </a>
                              </li>
                             
                           </ul>
                        </div>
                     </div>
                  </article>
                  <article class="col-xs-12 col-sm-3 col-sm-offset-2">
                     <div class="">
                        <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1820603798154432";
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                     </div>
                  </article>
               </div>
            </div>
         </section>
         <section id="copyright" class="bg-white">
            <div class="container">
               <div class="row clearfix">
                  <!-- <article class="col-sm-7">
                     <nav class="footer-links">
                        <ul class="clearfix list-unstyled">
                           <li class="pull-left">
                              <a href="#">General Conditions</a>
                           </li>
                           <li class="pull-left separator">|</li>
                           <li class="pull-left">
                              <a href="#">Shipping</a>
                           </li>
                           <li class="pull-left separator">|</li>
                           <li class="pull-left">
                              <a href="#">Refounds</a>
                           </li>
                           <li class="pull-left separator">|</li>
                           <li class="pull-left">
                              <a href="#">Payments</a>
                           </li>
                           <li class="pull-left separator">|</li>
                           <li class="pull-left">
                              <a href="#">Privacy Policy</a>
                           </li>
                        </ul>
                     </nav>
                  </article> -->
                  <article class="col-sm-5">
                     <p data-text="copyright" class="text-left no-margin">
                        Copyright © 2017. Developed by <b>CFarm Technical Team</b>
                     </p>
                  </article>
               </div>
               <hr>
               
            </div>
         </section>
      </footer>


      @yield('scrip_code')
      <script type="text/javascript">
        checkActiveMenu();
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
               updateCartStatus(data);
             },
             error: function(XMLHttpRequest, textStatus, errorThrown) {
                 console.log(textStatus);
                 alert("Vui lòng kiểm tra kết nối Internet!");
             }
         });
         }
      function updateCartStatus(data) {
         var length = Object.keys(data).length;
         if(length == 0)
            $('#cart-status').html("Giỏ hàng rỗng");
         else
            $('#cart-status').html("bạn có " + length + " nông sản sạch!");

         var code = "";
         var total = 0;
         $.each( data, function( key, value ) {
           code += "<li class=\"item\">\r\n                                       <div class=\"clearfix row\">\r\n                                          <div class=\"col-xs-10 product-details\">\r\n                                             <div class=\"clearfix row\">\r\n                                                <p class=\"col-xs-8 product-name no-margin\">"+ value.name + '  x' + value.qty +"<\/p>\r\n                                                <p class=\"col-xs-4 price no-margin text-right no-padding\"> "+ numberWithCommas(value.subtotal) +" VND<\/p>\r\n                                             <\/div>\r\n                                          <\/div>\r\n                                          <div class=\"col-xs-2 no-padding-left\">\r\n                                             <a type=\"button\" class=\"close\" data-dismiss=\"modal\" onclick=\"deleteItem(\'"+value.rowId+"\')\">\r\n                                             <i class=\"fa fa-times\"><\/i>\r\n                                             <\/a>\r\n                                          <\/div>\r\n                                       <\/div>\r\n                                    <\/li>";
           total += value.subtotal;
         });
         $('#cart-list-product').html(code);

         $('#cart-status-total').html(numberWithCommas(total) + " VND");
      }

      function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }

      function addEmailCus() {
         var emailCus = $("input[name=emailCus]").val();
         var receiveEmailCus = $("input[name=receiveEmailCus]").val();
         if(emailCus != ''){
            var url = '{{url('')}}/api/customer/addEmailCus=' + emailCus + '&receiveEmailCus=' +receiveEmailCus;
           $.ajaxSetup({ cache: false });
           $.getJSON(url, function(data){

                 console.log(data);
              }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  console.log(textStatus);
                  $('#modalMessage').html("Vui lòng kiểm tra kết nối Internet!");
                  $('#modalLoader').modal('hide');
                  $('#modalAlert').modal('show');
              });
           }else{
                $('#modalMessage').html("Vui lòng nhập đúng email!");
                  $('#modalLoader').modal('hide');
                  $('#modalAlert').modal('show');
           }
         
      }

      //quan tam san pham
          function interest(id) {
            var url = '{{url('')}}/api/products/interest/product_id=' + id;
            $.getJSON(url, function(data){
                  $('#modalLoader').modal('hide');
                  console.log(data);
                  if(data.error == '1')
                  {
                    $('#modalMessage').html(data.status);
                    $('#modalLoader').modal('hide');
                    $('#modalAlert').modal('show');
                  }else if(data.error == '0'){
                    $('#modalMessageFinish').html(data.status);
                    $('#modalLoader').modal('hide');
                    $('#modalAlertFinish').modal('show');
                  }
                  // loadModal(data);
                  // $('#modalChooseFarmer').modal('show');
               }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  console.log(textStatus);
                  $('#modalMessage').html("Vui lòng kiểm tra kết nối Internet!");
                  $('#modalLoader').modal('hide');
                  $('#modalAlert').modal('show');
               });
          }

      function checkActiveMenu() {
        // var interest = $('ul#mainMN').find('li.active');
        var interest = $('ul#mainMN li.active a').html();
        // console.log(interest);
        if(interest == null){
          $('#litrangchu').addClass("active");
        }
      }

      function isFloat(n){
          return Number(n) === n && n % 1 !== 0;
      }
      // function converUnit(quantity, unit) {
      //   if(unit != 'g'){
      //     return quantity + ' ' + unit;
      //   }
      //   else if (quantity >= 1000) {
      //     quantity = quantity/1000;
      //     return quantity + ' kg';
      //   }
      //   else if(quantity < 100){
      //     return quantity + ' kg';
      //   }
      //   else{
      //     return quantity + ' g';
      //   }

      // }
      </script>
   </body>
</html>