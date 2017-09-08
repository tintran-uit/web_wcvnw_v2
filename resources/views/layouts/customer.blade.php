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
      <link href="assets/stylesheets/vendor/normalize.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/vendor/animate.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/all.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/main.css" rel="stylesheet" type="text/css" />
      <link href="assets/stylesheets/loader.css" rel="stylesheet" type="text/css" />
      <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
      <link rel="manifest" href="assets/images/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
      <script src="assets/javascripts/vendor/jquery-2.1.3.min.js" type="text/javascript"></script>
      <script src="assets/javascripts/vendor/bootstrap/bootstrap.min.js" type="text/javascript"></script>
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/css/bootstrapValidator.min.css"/>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/js/bootstrapValidator.min.js"></script>
      <script src="assets/javascripts/utility.js" type="text/javascript"></script>
      <script src="assets/javascripts/all.js" type="text/javascript"></script>
      <script src="assets/javascripts/load.js" type="text/javascript"></script>
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
            <h4>Welcome to Kids Store live chat</h4>
            <p>At the moment there are no operators in chat but you can send your request by email!</p>
            <form action="#" accept-charset="UTF-8" method="post" id="form-payment" class="form-style-base">
               <div class="form-group">
                  <label for="name">Name: </label>
                  <input type="text" class="form-control" id="name" placeholder="Name" />
               </div>
               <div class="form-group">
                  <label for="user-email">Email: </label>
                  <input type="email" class="form-control" id="user-email" placeholder="Enter email" />
               </div>
               <div class="form-group">
                  <label>Message</label>
                  <textarea class="your-message" rows="3" placeholder="Message"></textarea>
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-info">Submit</button>
               </div>
            </form>
         </div>
      </div>
      <div class="affix" id="nl-box-slider" style="right: -305px;">
         <div class="clearfix">
            <div class="pull-left">
               <a class="btn-block" id="label-subscribe" href="#">        <img alt="subscribe newsletter" src="assets/images/icons/btn-nl.png" />
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
                        <input type="checkbox" name="receiveEmailCus" value="1" /> Đồng ý nhận thông tin khuyến mãi!
                        </label>
                     </div>
                     <div class="text-right">
                     <a href="/">WE CARE VN</a>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
      
      <!-- modal loading -->
      <div class="modal fade style-base-modal modalLoader" id="modalLoader" tabindex="-1" role="dialog" aria-labelledby="modalResetPsw" aria-hidden="true">
         <div class="modal-dialog">
            
         </div>
      </div>
      <!-- Modal buy voucher -->
      <div class="modal fade style-base-modal" id="modal-buy-voucher" tabindex="-1" role="dialog" aria-labelledby="modalBuyVoucher" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="inner-container">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times"></i>
                     </span>
                     </button>
                     <h4 class="modal-title" id="modalBuyVoucher">BUY VOUCHER</h4>
                  </div>
                  <div class="modal-body">
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec fringilla diam.
                        Quisque sed sagittis sem. Nulla ultrices tortor eu ligula pulvinar rutrum.
                     </p>
                     <form action="#" accept-charset="UTF-8" class="form-style-base" method="post" id="buy-voucher">
                        <fieldset class="spacer-bottom-20">
                           <div class="row clearfix">
                              <div class="col-sm-6 form-group">
                                 <select name="select-amount" class="input-lg" id="select-amount">
                                    <option value="Select amount" selected="selected">Select amount</option>
                                    <option value="20">$ 20,00</option>
                                    <option value="30">$ 30,00</option>
                                    <option value="40">$ 40,00</option>
                                    <option value="50">$ 50,00</option>
                                    <option value="60">$ 60,00</option>
                                    <option value="0">Digita un altro importo</option>
                                 </select>
                              </div>
                              <div class="col-sm-6 form-group">
                                 <input type="text" class="form-control input-lg" id="input-other-amount" placeholder="$ 25,00" />
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-sm-6 form-group">
                                 <input type="email" class="form-control input-lg" placeholder="Email destinatorio" />
                              </div>
                              <div class="col-sm-6 form-group">
                                 <input type="text" class="form-control input-lg" placeholder="Inserisci il tuo nome" />
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12 form-group">
                                 <textarea class="your-message" rows="3" placeholder="Message"></textarea>
                              </div>
                           </div>
                           <div class="row clearfix">
                              <div class="col-sm-5">
                                 <div class="form-inline spacer-bottom-10">
                                    <div class="form-group no-margin">
                                       <p class="form-control-static">Quantity</p>
                                    </div>
                                    <div class="form-group no-margin">
                                       <input type="text" class="form-control input-lg small-field" placeholder="1" />
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-7">
                                 <div class="form-inline delivery-date">
                                    <div class="form-group no-margin">
                                       <p class="form-control-static">Delivery date</p>
                                    </div>
                                    <div class="form-group no-margin">
                                       <input type="text" class="form-control input-lg" placeholder="dd/mm/yyyy" />
                                    </div>
                                    <div class="form-group no-margin hidden-xs">
                                       <a class="btn-link" href="#">              <i class="glyphicon glyphicon-calendar"></i>
                                       </a>          
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="clearfix row">
                              <div class="col-sm-7 recap-info spacer-10">
                                 <span class="number-voucher">2 Vouchers:</span> <span class="price">$ 40,00</span>
                              </div>
                              <div class="col-sm-5">
                                 <div class="pull-right">
                                    <input type="submit" value="purchase it" class="btn btn-warning btn-lg lg-2x" />
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                     <p class="small-text no-margin-bottom">Gift certificates are subject to
                        <a class="btn-link" href="#">Terms and Conditions</a>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
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
                                    <a href="wishlist.html">                    <i class="fa fa-heart"></i>
                                    </a>                
                                 </li>
                                 <li class="spacer-10">|</li>
                                 <li>
                                    <button type="button" data-toggle="modal" data-target="#modal-signup">
                                    Đăng ký
                                    </button>
                                 </li>
                                 <li class="spacer-10">|</li>
                                 <li>
                                    <button type="button" data-toggle="modal" data-target="#modal-signin">
                                    Đăng nhập
                                    </button>
                                 </li>
                              </ul>
                           </div>
                        </nav>
                        <article class="hidden-xs pull-left">
                           <div class="dropdown language">
                              <a data-toggle="dropdown" class="dropdown-toggle" href="#">                <img alt="England" src="assets/images/icons/flags/flag-vietnam.jpg" />
                              <span id="country-lang">Tiếng Việt</span>
                              <i class="fa fa-angle-down"></i>
                              </a>              
                              <ul class="dropdown-menu list-unstyled">
                                 <li>
                                    <a class="text-center" href="#">                    <img alt="England" src="assets/images/icons/flags/flag-england.jpg" />
                                    </a>                
                                 </li>
                                 <li>
                                    <a class="text-center" href="#">                    <img alt="Italy" src="assets/images/icons/flags/flag-italia.png" />
                                    </a>                
                                 </li>
                                 <li>
                                    <a class="text-center" href="#">                    <img alt="France" src="assets/images/icons/flags/flag-francia.png" />
                                    </a>                
                                 </li>
                              </ul>
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
                    <a href="./">          <img class="image-responsive" alt="Kids Store" src="assets/images/baner.png" style="height: 86px" />
                     </a>
                  </article>
                  <article class="col-sm-12 col-md-4 col-lg-6" >
                           
                  </article>
                  <article class="col-sm-12 col-md-4 col-lg-3 hidden-xs">
                     <div class="dropdown bg-white" id="basket">
                        <div class="shadow-wrap-box">
                           <a href="#" class="checkout-basket dropdown-toggle btn-block clearfix" data-toggle="dropdown" aria-expanded="true">
                              <div class="pull-left bg-super-light">
                                 <i class="fa fa-shopping-cart"></i>
                              </div>
                              <div class="info-basket pull-left">
                                 <span id="cart-status" data-name="item" style="font-weight: 700; color: #008000">
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
                                                   {{$item->name}}
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
                                    <a class="btn btn-warning btn-sm no-margin" href="payment.html">Thanh toán</a>
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
            <div class="container">
               <div class="row">
                  <article class="col-sm-8 col-md-8">
                     <nav id="main-nav">
                        <div class="nav-bar navbar-default dropdown-main-nav">
                           <div class="collapse navbar-collapse">
                              <ul class="nav navbar-nav">
                                 <li class="{{ Request::is('/') ? 'active' : '' }}">
                                    <a href="{{url('/')}}">Trang chủ</a>
                                 </li>
                                 <li class="{{ Request::is('thong-tin-nha-phan-phoi-we-cae-vn') ? 'active' : '' }}">
                                    <a href="{{url('/thong-tin-nha-phan-phoi-we-cae-vn')}}">Thông tin</a>
                                 </li>
                                 <li class="">
                                    <a role="button" class="dropdown-toggle" href="{{url('/mua-thuc-pham-sach')}}" id="menu-Muahang"> Mua hàng <i class="fa fa-angle-down"></i>
                                    </a>                  
                                 <!--    <ul class="dropdown-menu">
                                       <li>
                                          <a href="#">Baby 0-24 months</a>
                                       </li>
                                       <li>
                                          <a href="#">Child 3-16 years</a>
                                       </li>
                                       <li>
                                          <a href="#">Baby Boy</a>
                                       </li>
                                       <li>
                                          <a href="#">Baby Girl</a>
                                       </li>
                                       <li>
                                          <a href="#">Infant Boy</a>
                                       </li>
                                    </ul> -->
                                 </li>
                                 <li class="">
                                    <a href="#">Thư viện ảnh</a> 
                                 </li>
                                 <li class="dropdown box-extended">
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Hệ thống trang trại<i class="fa fa-angle-down"></i>
                                    </a>                  
                                    <ul class="dropdown-menu">
                                       <li class="clearfix row">
                                          <div class="col-sm-4">
                                             <ul class="list-unstyled">
                                                <li class="dropdown-header">Modal</li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-subscribe-nl">
                                                   Subscribe to Newsletter
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-buy-voucher">
                                                   Buy voucher
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-signin">
                                                   Signin
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-simple-signin">
                                                   Simple Signin
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-signup">
                                                   Signup
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-reset-psw">
                                                   Reset password
                                                   </button>
                                                </li>
                                                <li>
                                                   <button type="button" data-toggle="modal" data-target="#modal-abvertising">
                                                   Modal Advertising
                                                   </button>
                                                </li>
                                             </ul>
                                          </div>
                                          <div class="col-sm-4">
                                             <ul class="list-unstyled">
                                                <li class="dropdown-header">Forms</li>
                                                <li>
                                                   <a href="signin.html">Signin</a>
                                                </li>
                                                <li>
                                                   <a href="signup.html">Signup</a>
                                                </li>
                                                <li>
                                                   <a href="login.html">Login</a>
                                                </li>
                                                <li>
                                                   <a href="payment.html">Payments</a>
                                                </li>
                                                <li>
                                                   <a href="reset-password.html">Reset Password</a>
                                                </li>
                                                <li>
                                                   <a href="buy-voucher.html">Buy Voucher</a>
                                                </li>
                                             </ul>
                                          </div>
                                          <div class="col-sm-4">
                                             <ul class="list-unstyled">
                                                <li class="dropdown-header">Pages</li>
                                                <li>
                                                   <a href="account.html">Account</a>
                                                </li>
                                                <li>
                                                   <a href="info-account.html">Info Account</a>
                                                </li>
                                                <li>
                                                   <a href="address.html">Address</a>
                                                </li>
                                                <li>
                                                   <a href="add-address.html">Add Address</a>
                                                </li>
                                                <li>
                                                   <a href="shop.html">Shop</a>
                                                </li>
                                                <li>
                                                   <a href="product-details.html">Product details</a>
                                                </li>
                                                <li>
                                                   <a href="wishlist.html">Wishlist</a>
                                                </li>
                                                <li>
                                                   <a href="orders.html">My orders</a>
                                                </li>
                                                <li>
                                                   <a href="cart.html">Cart</a>
                                                </li>
                                                <li>
                                                   <a href="empty-basket.html">Empty Basket</a>
                                                </li>
                                                <li>
                                                   <a href="error-404.html">Error Page</a>
                                                </li>
                                                <li>
                                                   <a href="get-inspired.html">Get Inspired</a>
                                                </li>
                                                <li>
                                                   <a href="contact.html">Contact us</a>
                                                </li>
                                                <li>
                                                   <a href="faq.html">Faq</a>
                                                </li>
                                                <li>
                                                   <a href="blog.html">Blog</a>
                                                </li>
                                                <li>
                                                   <a href="post.html">Post</a>
                                                </li>
                                                <li>
                                                   <a href="comments.html">Comments</a>
                                                </li>
                                                <li>
                                                   <a href="about-us.html">About us</a>
                                                </li>
                                                <li>
                                                   <a href="terms-conditions.html">Terms & Conditions</a>
                                                </li>
                                             </ul>
                                          </div>
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </nav>
                  </article>
                  <article class="col-xs-12 col-sm-4 col-md-4">
                     <div class="pull-right welcome-text">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">            Hello Clint! <strong>My account</strong> <i class="fa fa-chevron-down"></i>
                        </a>          
                        <ul class="dropdown-menu" role="menu">
                           <li>
                              <a href="account.html">Edit profile</a>
                           </li>
                           <li>
                              <a href="cart.html">My orders</a>
                           </li>
                           <li>
                              <a href="#">Help & support</a>
                           </li>
                           <li>
                              <a href="#">Log out</a>
                           </li>
                        </ul>
                     </div>
                  </article>
               </div>
            </div>
         </section>
         <!--Menu responsive-->
         <section class="visible-xs">
            <nav class="navbar navbar-default navbar-fixed-top">
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
                     <i class="fa fa-shopping-cart"></i> <span class="badge">3</span>
                     </a>
                  </div>
                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav">
                        <li class="active">
                           <a href="./">Home</a>
                        </li>
                        <li>
                           <a href="about-us.html">About us</a>
                        </li>
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">              Shop <i class="fa fa-angle-down"></i>
                           </a>            
                           <ul class="dropdown-menu">
                              <li>
                                 <a href="#">Baby 0-24 months</a>
                              </li>
                              <li>
                                 <a href="#">Child 3-16 years</a>
                              </li>
                              <li>
                                 <a href="#">Baby Boy</a>
                              </li>
                              <li>
                                 <a href="#">Baby Girl</a>
                              </li>
                              <li>
                                 <a href="#">Infant Boy</a>
                              </li>
                           </ul>
                        </li>
                        <li>
                           <a href="contact.html">Contact us</a>
                        </li>
                        <li class="dropdown">
                           <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">              Pages <i class="fa fa-angle-down"></i>
                           </a>            
                           <ul class="dropdown-menu">
                              <li>
                                 <a data-toggle="modal" data-target="#modal-subscribe-nl" href="#">Subscribe to Newsletter</a>
                              </li>
                              <li>
                                 <a data-toggle="modal" data-target="#modal-buy-voucher" href="#">Buy voucher</a>
                              </li>
                              <li>
                                 <a data-toggle="modal" data-target="#modal-signin" href="#">Signin</a>
                              </li>
                              <li>
                                 <a data-toggle="modal" data-target="#modal-simple-signin" href="#">Simple Signin</a>
                              </li>
                              <li>
                                 <a data-toggle="modal" data-target="#modal-signup" href="#">Signup</a>
                              </li>
                              <li>
                                 <a data-toggle="modal" data-target="#modal-reset-psw" href="#">Reset password</a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                 <a href="signin.html">Page Signin</a>
                              </li>
                              <li>
                                 <a href="signup.html">Page Signup</a>
                              </li>
                              <li>
                                 <a href="login.html">Page Login</a>
                              </li>
                              <li>
                                 <a href="payment.html">Page Payments</a>
                              </li>
                              <li>
                                 <a href="reset-password.html">Page Reset Password</a>
                              </li>
                              <li>
                                 <a href="buy-voucher.html">Page Buy Voucher</a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                 <a href="account.html">Your account</a>
                              </li>
                              <li>
                                 <a href="shop.html">Shop</a>
                              </li>
                              <li>
                                 <a href="product-details.html">Product details</a>
                              </li>
                              <li>
                                 <a href="wishlist.html">Wishlist</a>
                              </li>
                              <li>
                                 <a href="orders.html">Orders</a>
                              </li>
                              <li>
                                 <a href="cart.html">Cart</a>
                              </li>
                              <li>
                                 <a href="empty-basket.html">Empty Basket</a>
                              </li>
                              <li>
                                 <a href="get-inspired.html">Get Inspired</a>
                              </li>
                              <li>
                                 <a href="contact.html">Contact us</a>
                              </li>
                              <li>
                                 <a href="blog.html">Blog</a>
                              </li>
                              <li>
                                 <a href="post.html">Post</a>
                              </li>
                              <li>
                                 <a href="terms-conditions.html">Terms & Conditions</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                     <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown welcome-text">
                           <a class="dropdown-toggle" data-toggle="dropdown" href="#">              Hello Ilaria! <strong>My account</strong> <i class="fa fa-chevron-down"></i>
                           </a>            
                           <ul class="dropdown-menu" role="menu">
                              <li>
                                 <a href="account.html">Edit profile</a>
                              </li>
                              <li>
                                 <a href="cart.html">My orders</a>
                              </li>
                              <li>
                                 <a href="#">Help & support</a>
                              </li>
                              <li>
                                 <a href="#">Log out</a>
                              </li>
                           </ul>
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
                           <img class="hidden-sm hidden-md" alt="tel" src="assets/images/icons/icon-tel.png" />
                           <span data-info="text-info">+0 888 9090 909</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="time" src="assets/images/icons/icon-time.png" />
                           <span data-info="text-info">Every day, 9 am to 18 pm</span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="email" src="assets/images/icons/icon-mail.png" />
                           <span data-info="text-info">
                           margarita-barton@fastmail.com
                           </span>
                        </div>
                     </article>
                     <article class="col col-xs-12 col-sm-3">
                        <div class="info-col bg-super-light">
                           <img class="hidden-sm hidden-md" alt="location" src="assets/images/icons/icon-location.png" />
                           <span data-info="text-info">21 Nursary Lane, Manchester</span>
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
                        <div class="col-sm-3">
                           <ul class="footer-widget-list list-unstyled spacer-bottom-5">
                              <li>
                                 <strong>About us</strong>
                              </li>
                              <li>
                                 <a href="#.html">Outlet</a>
                              </li>
                              <li>
                                 <a href="#.html">Bands and Waist Bags</a>
                              </li>
                              <li>
                                 <a href="#.html">Our Brands</a>
                              </li>
                              <li>
                                 <a href="#.html">Blog</a>
                              </li>
                           </ul>
                        </div>
                        <div class="col-sm-3">
                           <ul class="footer-widget-list list-unstyled spacer-bottom-5">
                              <li>
                                 <strong>About us</strong>
                              </li>
                              <li>
                                 <a href="#.html">Outlet</a>
                              </li>
                              <li>
                                 <a href="#.html">Bands and Waist Bags</a>
                              </li>
                              <li>
                                 <a href="#.html">Our Brands</a>
                              </li>
                              <li>
                                 <a href="#.html">Blog</a>
                              </li>
                           </ul>
                        </div>
                        <div class="col-sm-3">
                           <ul class="footer-widget-list list-unstyled">
                              <li>
                                 <strong>Customer service</strong>
                              </li>
                              <li>
                                 <a href="/about.html">Terms and conditions</a>
                              </li>
                              <li>
                                 <a href="/about.html">Privacy</a>
                              </li>
                              <li>
                                 <a href="/about.html">Refound</a>
                              </li>
                              <li>
                                 <a href="/about.html">Size Guide</a>
                              </li>
                              <li>
                                 <a href="/about.html">Loyalty points</a>
                              </li>
                              <li>
                                 <a href="credit.html">Credit</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </article>
                  <article class="col-xs-12 col-sm-5">
                     <div class="spacer-top-20">
                        <ul class="follow-us clearfix list-unstyled list-inline">
                           <li>
                              <a class="facebook" href="#">      <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                              </span>
                              </a>  
                           </li>
                           <li>
                              <a class="linkedin" href="#">      <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                              </span>
                              </a>  
                           </li>
                           <li>
                              <a class="twitter" href="#">      <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                              </span>
                              </a>  
                           </li>
                           <li>
                              <a class="pinterest" href="#">      <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
                              </span>
                              </a>  
                           </li>
                           <li>
                              <a class="youtube" href="#">      <span class="fa-stack fa-lg">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                              </span>
                              </a>  
                           </li>
                        </ul>
                     </div>
                  </article>
               </div>
            </div>
         </section>
         <section id="copyright" class="bg-white">
            <div class="container">
               <div class="row clearfix">
                  <article class="col-sm-7">
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
                  </article>
                  <article class="col-sm-5">
                     <p data-text="copyright" class="text-left no-margin">
                        Copyright © 2014. All Rights Reserved
                     </p>
                  </article>
               </div>
               <hr>
               <div>
                  <ul class="clearfix creditcard pull-left list-unstyled">
                     <li class="pull-left">
                        <img alt="mastercard" src="assets/images/icons/credit-cards/mastercard.png" />
                     </li>
                     <li class="pull-left">
                        <img alt="american express" src="assets/images/icons/credit-cards/american-express.png" />
                     </li>
                     <li class="pull-left">
                        <img alt="maestro" src="assets/images/icons/credit-cards/maestro.png" />
                     </li>
                     <li class="pull-left">
                        <img alt="circus" src="assets/images/icons/credit-cards/circus.png" />
                     </li>
                     <li class="pull-left">
                        <img alt="visa" src="assets/images/icons/credit-cards/visa.png" />
                     </li>
                  </ul>
               </div>
            </div>
         </section>
      </footer>
      @yield('scrip_code')
      <script type="text/javascript">
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
           code += "<li class=\"item\">\r\n                                       <div class=\"clearfix row\">\r\n                                          <div class=\"col-xs-10 product-details\">\r\n                                             <div class=\"clearfix row\">\r\n                                                <p class=\"col-xs-8 product-name no-margin\">"+ value.name +"<\/p>\r\n                                                <p class=\"col-xs-4 price no-margin text-right no-padding\"> "+ numberWithCommas(value.subtotal) +" VND<\/p>\r\n                                             <\/div>\r\n                                          <\/div>\r\n                                          <div class=\"col-xs-2 no-padding-left\">\r\n                                             <a type=\"button\" class=\"close\" data-dismiss=\"modal\" onclick=\"deleteItem(\'"+value.rowId+"\')\">\r\n                                             <i class=\"fa fa-times\"><\/i>\r\n                                             <\/a>\r\n                                          <\/div>\r\n                                       <\/div>\r\n                                    <\/li>";
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
         var url = 'api/customer/addEmailCus=' + emailCus + '&receiveEmailCus=' +receiveEmailCus;
           $.ajaxSetup({ cache: false });
           $.getJSON(url, function(data){ 
                 console.log(data);
              }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  alert("Vui lòng kiểm tra kết nối internet.");
              });
      }
      </script>
   </body>
</html>