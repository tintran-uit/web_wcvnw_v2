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

      <meta property="og:title" content="{{$title}}" />
      <meta property="og:url" content="http://www.cfarm.vn" />
      <meta property="og:image" content="http://cfarm.vn/uploads/seo/Fb-cover.jpg" />
      <meta property="og:description" content="Kết nối người tiêu dùng với những lương nông trên nền tảng công nghệ. Bạn có thể đặt mua thực phẩm sạch hoặc hữu cơ trực tiếp từ những trang trại thông qua www.cfarm.vn hoặc (Android & iOS App)" />
      <meta property="og:site_name" content="Thực phẩm sạch Cfarm" />
      <!-- Use title if it's in the page YAML frontmatter -->
      <title>@yield('title')</title>
      <link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic-ext,latin" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/normalize.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/animate.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/all.css" rel="stylesheet" type="text/css" />
      <link href="{{url('')}}/assets/stylesheets/main.css?v=1" rel="stylesheet" type="text/css" />
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
      <!-- Facebook Pixel Code -->
      <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '139066876764191');
        fbq('track', 'PageView');
      </script>
      <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=139066876764191&ev=PageView&noscript=1"
      /></noscript>
      <!-- End Facebook Pixel Code -->
      


      <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K9HFW5P');</script>
      <!-- End Google Tag Manager -->

      @yield('headInput')
      
   </head>
   <body class="index">
      <div id="chat" class="box-chat col-sm-5 col-md-4 col-lg-2 hidden-xs">
         <div class="clearfix">
            <div class="pull-left" id="chat-title"><b>{{ trans('head.chatBoxTitle') }}</b></div>
            <div class="pull-right">
               <a class="btn-link button-show" href="#">        <i class="glyphicon glyphicon-plus"></i>
               </a>    
            </div>
         </div>
         <div class="content" style="display: none; padding: 0;">
            <h5>{{ trans('head.chatBoxDescript') }}</h5>
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
            <div class="pull-left" style="position: sticky;">
               <a class="btn-block" id="label-subscribe" href="{{url('')}}">        <img alt="subscribe newsletter" src="{{url('')}}/assets/images/icons/btn-cart.png" />
               </a>    
            </div>
            <div class="content pull-left hidden" id="subscribe-nl" >
               <h2 class="no-margin-top"  id="cart-status2" style="color: #B62029">@if(count($cart) == 0)
                                 {{ trans('head.cartStatus0') }}
                                 @else
                                 {{ trans('head.cartStatus1_1') }} {{count($cart)}} {{ trans('head.cartStatus1_2') }}!
                                 @endif</h2>
               <form action="/#" accept-charset="UTF-8" method="post" style="width:253px;">
                  <fieldset>
                     
                     <ul id='cart-list-product2' class="products-list list-unstyled">
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
                       <hr>
                       <div class="subtotale pull-right no-margin" style="margin-right: 32px">
                          {{ trans('head.cartTotal') }}: &nbsp;&nbsp;&nbsp;<span class="price" id="cart-status-totalz">{{number_format($total)}} VND</span>
                        </div>
                       <br><br>
                       <div class="button-basket text-right">
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/gio-hang-thuc-pham-sach')}}">{{ trans('head.cartView') }} </a>
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/thanh-toan')}}">{{ trans('head.cartCheckOut') }} </a>
                        </div>
                     <div class="text-right">
                      <br>
                      <br>
                      <a href="/">{{ trans('head.cartStatus3') }} </a>
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
          <h4 class="modal-title email-icon" id="modalSignupLabel">{{ trans('auth.register') }}</h4>
        </div>
        <div class="modal-body clearfix">
          <div class="col-md-12 no-padding">
<form action="{{url('')}}/admin/register" accept-charset="UTF-8" method="post" class="form-style-base">              
{{ csrf_field() }}   
               <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control input-lg" placeholder="{{ trans('auth.email') }}" name="email"/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="name" placeholder="{{ trans('auth.name') }}" />
              </div>
              @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt"></i>
                </span>
                <input type="password" class="form-control input-lg" placeholder="{{ trans('auth.password') }}" name="password"/>
              </div>
              @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-unlock-alt"></i>
                </span>
                <input type="password" class="form-control input-lg" placeholder="{{ trans('auth.re_password') }}" name="password_confirmation"/>
              </div>
            </div>
              <div class="required-fields text-right spacer-bottom-5">
                * {{ trans('auth.required') }}
              </div>

              <div>
                
              </div>

              <div>
                <button type="submit" class="btn btn-warning btn-lg btn-block">
                  <i class="fa fa-user"></i> {{ trans('auth.register') }}
                </button>
              </div>
              <p class="text-center small no-margin">
                {{ trans('auth.haveAcc') }} <a class="btn-link" data-toggle="modal" data-target="#modal-signin" href="" data-dismiss="modal">{{ trans('head.login') }}</a>
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
          
          @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
          @else
          <p>
            {{ trans('head.reswtpass_status') }}
          </p>
<form action="{{ url('admin/password/email') }}" role="form" method="POST" class="form-style-base">{{ csrf_field() }}  <fieldset>              <div class="row clearfix">
                <div class="form-group col-sm-9{{ $errors->has('email') ? ' has-error' : '' }}">
                  <input type="email" class="form-control input-lg" placeholder="Enter email" name="email" value="{{ old('email') }}"/>
                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="col-sm-3">
                  <input type="submit" value="SEND" class="btn btn-warning no-margin btn-block" />
                </div>
              </div>
</fieldset></form>    
          @endif
    
</div>
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
                        <i class="fa fa-truck"></i> {{ trans('head.right_title') }}
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
                                    <a href="#" data-toggle="modal" data-target="#modal-signup">
                                    {{ trans('head.register') }}
                                    </a>
                                 </li>
                                 <li class="spacer-10">|</li>
                                 <li>
                                    <a href="#" data-toggle="modal" data-target="#modal-signin">
                                    {{ trans('head.login') }}
                                    </a>
                                 </li>
                                 @else
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('head.hello') }} <strong> {{Auth::user()->name}} </strong> <i class="fa fa-chevron-down"></i>
                                    </a>          
                                    <ul class="dropdown-menu" role="menu">
                                       <!-- <li>
                                          <a href="{{url('')}}/user/edit">{{ trans('head.editProfile') }}</a>
                                       </li> -->
                                       @if(Auth::user()->account_type=='Farmer')
                                       <li>
                                          <a href="{{url('')}}/farmer/dashboard">{{ trans('head.farmer') }}</a>
                                       </li>
                                       @endif
                                       <li>
                                          <a href="{{url('')}}/user/account">{{ trans('user.wallet') }}</a>
                                       </li>
                                       <li>
                                          <a href="{{url('')}}/user/rate">{{ trans('head.rate') }}</a>
                                       </li>
                                       
                                       <li>
                                          <a href="{{url('')}}/admin/logout">{{ trans('auth.logout') }} </a>
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
                    <a href="{{url('')}}">          <img class="image-responsive" alt="Kids Store" src="{{url('')}}/assets/images/logo.png" style="height: 86px" />
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
                                 {{ trans('head.cartStatus0') }}
                                 @else
                                 {{ trans('head.cartStatus1_1') }} {{count($cart)}} {{ trans('head.cartStatus1_2') }}
                                 @endif
                                 </span>
                                 <span data-name="price">
                                 <strong></strong>
                                 </span>
                              </div>
                              <div class="pull-right arrow" id="check_show_cart">
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
                                       {{ trans('head.cartTotal') }}:&nbsp;&nbsp;&nbsp;<span class="price" id="cart-status-total">{{number_format($total)}} VND</span>
                                    </p>
                                 </div>
                                 <div class="button-basket text-right">
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/gio-hang-thuc-pham-sach')}}">{{ trans('head.cartView') }}</a>
                                    <a class="btn btn-warning btn-sm no-margin" href="{{url('/thanh-toan')}}">{{ trans('head.cartCheckOut') }}</a>
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
                                 <li class="@if($page->template=='about_us' || $page->template=='services') active @endif">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.about') }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                       <li class="clearfix row">
                                          <div class="col-sm-12">
                                             <ul class="list-unstyled">
                                                <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-thuc-pham-sach-Cfarm">{{ trans('head.about1') }}</a> </li>     
                                                <li><a href="{{url('')}}/dia-chi-lien-he-Cfarm">{{ trans('head.about2') }}</a>      </li>
                                                <li><a href="{{url('')}}/thong-tin-chuyen-khoan"> {{ trans('head.about4') }}</a>  </li> 
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
                                 <li class="dropdown box-extended @if($page->template=='farm_information') active @endif">
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
                <div class="col-xs-12" style="font-style: 12px; color: #777; float: right; padding: 10px 5px;">
                 @if(!isset(Auth::user()->name)) 
                    <button type="button" data-toggle="modal" data-target="#modal-signup">
                    {{ trans('head.register') }}
                    </button>
                   <span class="spacer-10">|</span>
                      <button type="button" data-toggle="modal" data-target="#modal-signin">
                      {{ trans('head.login') }}
                      </button>
                   @else
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('head.hello') }}<strong> {{Auth::user()->name}} </strong> <i class="fa fa-chevron-down" style="color: #A52223"></i>
                      </a>          
                      <ul class="dropdown-menu" role="menu">
                        @if(Auth::user()->account_type=='Farmer')
                         <li>
                            <a href="{{url('')}}/farmer/dashboard">{{ trans('head.farmer') }}</a>
                         </li>
                         @endif
                         <li>
                            <a href="{{url('')}}/user/account">{{ trans('user.wallet') }}</a>
                         </li>
                         <li>
                            <a href="{{url('')}}/user/rate">{{ trans('head.rate') }}</a>
                         </li>
                         <li>
                            <a href="{{url('')}}/admin/logout">Log out</a>
                         </li>
                      </ul>
                 @endif

                 <div class="dropdown language pull-right">
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
`
                 </div>

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
                     <i class="fa fa-shopping-cart"></i> <span class="badge" id="cartMobile" >{{ trans('head.order') }}: {{count($cart)}}</span>
                     </a>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{url('/')}}">{{ trans('head.home') }}</a>
                        </li>
                        <li class="{{ Request::is('thong-tin-nha-phan-phoi-thuc-pham-sach-Cfarm') ? 'active' : '' }} {{ Request::is('dia-chi-lien-he-Cfarm') ? 'active' : '' }} {{ Request::is('chinh-sach-lien-ket-nong-dan') ? 'active' : '' }}  {{ Request::is('huong-dan-mua-thuc-pham-sach') ? 'active' : '' }}  {{ Request::is('chinh-sach-doi-tra') ? 'active' : '' }}">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.about') }} <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                                <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-thuc-pham-sach-Cfarm">{{ trans('head.about1') }}</a> </li>     
                                                <li><a href="{{url('')}}/dia-chi-lien-he-Cfarm">{{ trans('head.about2') }}</a>      </li>
                                                <li><a href="{{url('')}}/thong-tin-chuyen-khoan"> {{ trans('head.about4') }}</a>  </li>
                                                <li><a href="{{url('')}}/chinh-sach-lien-ket-nong-dan"> {{ trans('head.about3') }}</a>  </li> 
                                    </ul>
                                 </li>
                                 <li class="">
                                    <a role="button" class="dropdown-toggle" href="{{url('/mua-thuc-pham-sach')}}" id="menu-Muahang2"> {{ trans('head.product') }}
                                    </a>                  
                                 </li>
                                 <li class="@if($page->template == 'blog') active @endif">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">{{ trans('head.blog') }} <i class="fa fa-angle-down"></i></a> 
                                    <ul class="dropdown-menu">
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=3">{{ trans('head.blog1') }}</a> </li>     
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=4">{{ trans('head.blog2') }}</a>      </li>
                                                <li><a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=5">{{ trans('head.blog3') }}</a>  </li> 
                                    </ul>
                                 </li>
                                 <li class="dropdown box-extended @if($page->template=='farm_information') active @endif">
                                    <a href="{{url('')}}/thong-tin-trang-trai-an-toan">{{ trans('head.farmerlist') }}
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
                        <div class="info-col bg-super-light text-center">
                           <img class="hidden-sm hidden-md" alt="tel" src="{{url('')}}/assets/images/icons/icon-tel.png" height="39" />
                           <span data-info="text-info">{{ trans('head.bannerFooter_1') }}</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light text-center">
                           <img class="hidden-sm hidden-md" alt="time" src="{{url('')}}/assets/images/icons/icon-shipping.png" height="39" />
                           <span data-info="text-info">{{ trans('head.bannerFooter_2') }}</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3 text-center">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="email" src="{{url('')}}/assets/images/icons/icon-mail.png" height="39" />
                           <span data-info="text-info">
                           {{ trans('head.bannerFooter_3') }}
                           </span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light text-center">
                           <img class="hidden-sm hidden-md" alt="location" src="{{url('')}}/assets/images/icons/icon-location.png" height="39" />
                           <span data-info="text-info">{{ trans('head.bannerFooter_4') }}</span>
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
                           <ul class="footer-widget-list list-unstyled"><li><strong>Cfarm! </strong></li></ul>
                           {{ trans('head.footerIntro') }} <a href="{{url('')}}">www.cfarm.vn</a> {{ trans('head.or') }} (Android & iOS App)
                        </div>
                        <div class="col-sm-3 col-sm-offset-1">
                           <ul class="footer-widget-list list-unstyled spacer-bottom-5">
                              <li>
                                 <strong>Thông tin</strong>
                              </li>
                           <li><a href="{{url('')}}/thong-tin-nha-phan-phoi-thuc-pham-sach-Cfarm">{{ trans('head.about1') }}</a> </li>     
                           <li><a href="{{url('')}}/dia-chi-lien-he-Cfarm">{{ trans('head.about2') }}</a>      </li>
                           <li><a href="{{url('')}}/chinh-sach-lien-ket-nong-dan"> {{ trans('head.about3') }}</a>  </li>    
                           </ul>
                        </div>
                        <div class="col-sm-3">
                           <ul class="footer-widget-list list-unstyled">
                              <li>
                                 <strong>{{ trans('head.footer0') }} </strong>
                              </li>
                              <li>
                                 <a class="" href="{{url('')}}/huong-dan-mua-thuc-pham-sach">{{ trans('head.footer1') }}
                           </a>
                              </li>
                              <li>
                                 <a class="" href="{{url('')}}/chinh-sach-doi-tra">{{ trans('head.footer2') }}
                           </a>
                              </li>
                              <li>
                                 <a class="" href="{{url('')}}/chinh-sach-giao-hang">{{ trans('head.footer3') }}
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
                  
                  <article class="col-sm-5">
                     <p data-text="copyright" class="text-left no-margin">
                        Copyright © 2017. Developed by <b style="color: #B62029">CFarm Technical Team</b>
                     </p>
                  </article>
               </div>
               <hr>
               
            </div>
         </section>
      </footer>


      @yield('scrip_code')
      <script type="text/javascript">
        $(document).ready(function(){
         // $('#article').children('p').children('img').each(function(){
         //   $(this).addClass('img-responsive');
         //   $(this).css("height", "auto");
         // });

         // $('#article div').children('p').children('img').each(function(){
         //   $(this).addClass('img-responsive');
         //   $(this).css("height", "auto");
         // });

         // $('#article').children('img').each(function(){
         //   $(this).addClass('img-responsive');
         //   $(this).css("height", "auto");
         // });

         $("#article img").each(function(){
            $(this).addClass('img-responsive');
           $(this).css("height", "auto");
          })


       });
      </script>
      <script type="text/javascript">
        checkActiveMenu();
        showCart();
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
         if(length == 0){
            $('#cart-status').html("{{ trans('head.cartStatus0') }}");
            $('#cart-status2').html("{{ trans('head.cartStatus0') }}");
            $('#cartMobile').html("{{ trans('head.cartStatus0') }}");
         }
         else{
            $('#cart-status').html("{{ trans('head.cartStatus1_1') }} " + length + " {{ trans('head.cartStatus1_2') }}!");
            $('#cart-status2').html("{{ trans('head.cartStatus1_1') }} " + length + " {{ trans('head.cartStatus1_2') }}!");
            $('#cartMobile').html("Đặt hàng: " + length);
         }

         var code = "";
         var total = 0;
         $.each( data, function( key, value ) {
           code += "<li class=\"item\">\r\n                                       <div class=\"clearfix row\">\r\n                                          <div class=\"col-xs-10 product-details\">\r\n                                             <div class=\"clearfix row\">\r\n                                                <p class=\"col-xs-8 product-name no-margin\">"+ value.name + '  x' + value.qty +"<\/p>\r\n                                                <p class=\"col-xs-4 price no-margin text-right no-padding\"> "+ numberWithCommas(value.subtotal) +" VND<\/p>\r\n                                             <\/div>\r\n                                          <\/div>\r\n                                          <div class=\"col-xs-2 no-padding-left\">\r\n                                             <a type=\"button\" class=\"close\" data-dismiss=\"modal\" onclick=\"deleteItem(\'"+value.rowId+"\')\">\r\n                                             <i class=\"fa fa-times\"><\/i>\r\n                                             <\/a>\r\n                                          <\/div>\r\n                                       <\/div>\r\n                                    <\/li>";
           total += value.subtotal;
         });
         $('#cart-list-product').html(code);
         $('#cart-list-product2').html(code);

         $('#cart-status-total').html(numberWithCommas(total) + " VND");
         $('#cart-status-totalz').html(numberWithCommas(total) + " VND");

         if(!detectmob()){
          Slide.run("#nl-box-slider", {right: 0}, 300);
         setTimeout(function(){ Slide.run("#nl-box-slider", {right: -305}, 300); }, 2300);
         }
         
      }


      function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }

      function floatWithCommas(x) {
             return parseFloat(x).toFixed(2);
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

      function showCart() {
        window.addEventListener('scroll', function(e) {
          var check = isScrolledIntoView('#check_show_cart');
          // console.log(check);
          if(check){
            $("#subscribe-nl").addClass('hidden');
          }else{
            $("#subscribe-nl").removeClass('hidden');
          }
        });
      }
      function isScrolledIntoView(elem)
      {
          var docViewTop = $(window).scrollTop();
          var docViewBottom = docViewTop + $(window).height();

          var elemTop = $(elem).offset().top;
          var elemBottom = elemTop + $(elem).height();

          return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
      }
      function detectmob() {
         if(window.innerWidth <= 720) {
           return true;
         } else {
           return false;
         }
      }
      </script>
      <script type="text/javascript">
          @if ($errors->has('email'))
            @if(Session::get('modal')=='login')
              $('#modal-signin').modal('show');
            @elseif(Session::get('modal')=='register')
              $('#modal-signup').modal('show');
            @elseif(Session::get('modal')=='resetspasswords')
              $('#modal-reset-psw').modal('show');
            @endif
          @elseif($errors->has('password'))
              $('#modal-signup').modal('show');
          @endif
          @if (session('status'))
              $('#modal-reset-psw').modal('show');
                        
          @endif
       </script>
       
   </body>
</html>