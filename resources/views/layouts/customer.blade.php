<!doctype html>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Template">
      <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, bootstrap, front-end, frontend, web development">
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
      <script src="assets/javascripts/utility.js" type="text/javascript"></script>
      <script src="assets/javascripts/all.js" type="text/javascript"></script>
      <script src="assets/javascripts/load.js" type="text/javascript"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="index">
      <div id="chat" class="box-chat col-sm-5 col-md-4 col-lg-2 hidden-xs">
         <div class="clearfix">
            <div class="pull-left" id="chat-title">Do you have questions?</div>
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
               <h2 class="no-margin-top">SUBSCRIBE TO NEWSLETTER</h2>
               <form action="/#" accept-charset="UTF-8" method="post">
                  <fieldset>
                     <div>
                        <label for="email_address">Email address: </label>
                     </div>
                     <div class="form-inline">
                        <div class="form-group">
                           <input type="email" class="form-control" id="email_address" />
                        </div>
                        <button type="submit" class="btn btn-light no-margin">
                        <i class="fa fa-chevron-right"></i>
                        </button>
                     </div>
                     <div class="checkbox">
                        <label>
                        <input type="checkbox" name="Privacy" value="1" /> Acetto le politiche della privacy
                        </label>
                     </div>
                     <div class="text-right">
           bạn          <a href="/#.html">SHOW MORE</a>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
      </div>
      <!--     <section id="choose-color-theme" style="left: -168px" class="hidden-xs">
         <div class="clearfix">
           <div id="list-colors" class="pull-left body">
             <h4 class="no-margin-top">Choose color</h4>
             <ul class="color-list clearfix list-unstyled">
               <li>
                 <a href="#" data-name="choose" data-color="cyan" style="background-color: #a1cfd4;"></a>
               </li>
               <li>
                 <a href="#" data-name="choose" data-color="grey" style="background-color: #95a3c7;"></a>
               </li>
               <li>
                 <a href="#" data-name="choose" data-color="yellow" style="background-color: #fbb628;"></a>
               </li>
               <li>
                 <a href="#" data-name="choose" data-color="pink" style="background-color: #ef4163;"></a>
               </li>
             </ul>
           </div>
           <div class="pull-left">
         <a class="btn-link btn-cog" id="btn-swap" href="#">        <i class="fa fa-cog fa-spin"></i>
         </a>    </div>
         </div>
         </section>
         -->
      <!-- Modal Subscribe newsletter -->
      <div class="modal fade style-base-modal" id="modal-subscribe-nl" tabindex="-1" role="dialog" aria-labelledby="modalSubscribeNewsletter" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="inner-container">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times"></i>
                     </span>
                     </button>
                     <h4 class="modal-title email-icon" id="modalSubscribeNewsletter">subscribe newsletter</h4>
                  </div>
                  <div class="modal-body">
                     <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec fringilla diam.
                        Quisque sed sagittis sem. Nulla ultrices tortor eu ligula pulvinar rutrum.
                     </p>
                     <form action="/#" accept-charset="UTF-8" method="post" class="form-style-base">
                        <fieldset>
                           <div class="form-group">
                              <input type="email" class="form-control input-lg" placeholder="Enter email" />
                           </div>
                           <div class="checkbox">
                              <label class="small-text">
                              <input type="checkbox" name="1" value="1" /> Accetto le politiche della <a class="btn-link" href="#">privacy</a>
                              </label>
                           </div>
                        </fieldset>
                        <fieldset>              <input type="submit" value="SUBSCRIBE YOU" class="btn btn-warning btn-lg no-margin" /></fieldset>
                     </form>
                  </div>
               </div>
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
                     <h4 class="modal-title email-icon" id="modalSigninLabel">login</h4>
                  </div>
                  <div class="modal-body clearfix">
                     <div class="col-md-7 no-padding">
                        <form action="/#" accept-charset="UTF-8" method="post" class="form-style-base">
                           <fieldset>
                              <div class="form-group">
                                 <input type="email" class="form-control input-lg" placeholder="Enter email" />
                              </div>
                              <div class="form-group">
                                 <input type="password" class="form-control input-lg" placeholder="Password" />
                              </div>
                              <div class="checkbox">
                                 <label class="btn-link small">
                                 <input type="checkbox" name="Remenber password" value="1" /> Remenber password
                                 </label>
                              </div>
                           </fieldset>
                           <fieldset>                <button type="submit" class="btn btn-warning btn-lg btn-block">
                              <i class="glyphicon glyphicon-log-in"></i> Login
                              </button>
                           </fieldset>
                           <div class="small text-center spacer-bottom-10">
                              <a class="btn-link" href="reset-password.html">Forgot your password?</a>
                           </div>
                        </form>
                     </div>
                     <div class="col-md-5 no-padding">
                        <div class="text-center">
                           <h4 class="no-margin-top">
                              Use your social network<br>account to signin
                           </h4>
                           <div class="socials btn-group clearfix">
                              <!--
                                 Exsample:
                                 var social = facebook, twitter, pinterest, google, linkedin or youtube
                                 var smaller = smaller or nil
                                 var link = link
                                 -->
                              <a class="btn-social btn-facebook " href="#">  <i class="fa fa-facebook fa-1x"></i>
                              </a>
                              <!--
                                 Exsample:
                                 var social = facebook, twitter, pinterest, google, linkedin or youtube
                                 var smaller = smaller or nil
                                 var link = link
                                 -->
                              <a class="btn-social btn-twitter " href="#">  <i class="fa fa-twitter fa-1x"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal Signin -->
      <div class="modal fade simple-modal" id="modal-simple-signin" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-sm">
            <div class="modal-content">
               <div class="inner-container bg-white">
                  <div class="modal-body clearfix">
                     <form action="#" accept-charset="UTF-8" method="post" class="form-style-base">
                        <fieldset>
                           <div class="input-group">
                              <span class="input-group-addon">
                              <i class="fa fa-user"></i>
                              </span>
                              <input type="email" class="form-control input-lg" placeholder="Enter email" />
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon">
                              <i class="fa fa-lock"></i>
                              </span>
                              <input type="password" class="form-control input-lg" placeholder="Password" />
                           </div>
                           <div class="checkbox">
                              <label>
                              <input type="checkbox" name="Remenber password" value="1" /> Remenber password
                              </label>
                           </div>
                        </fieldset>
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                        Login
                        </button>
                        <div class="small text-center">
                           <a class="btn-link" href="reset-password.html">Forgot your password?</a>
                        </div>
                     </form>
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
                     <h4 class="modal-title email-icon" id="modalSignupLabel">create account</h4>
                  </div>
                  <div class="modal-body clearfix">
                     <div class="col-md-7 no-padding">
                        <form action="/#" accept-charset="UTF-8" method="post" class="form-style-base">
                           <div class="form-group">
                              <input type="email" class="form-control input-lg" placeholder="Email" />
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon">
                              <i class="fa fa-user"></i>
                              </span>
                              <input type="text" class="form-control input-lg" placeholder="Username" />
                           </div>
                           <div class="input-group">
                              <span class="input-group-addon">
                              <i class="fa fa-unlock-alt"></i>
                              </span>
                              <input type="password" class="form-control input-lg" placeholder="Password" />
                           </div>
                           <div class="input-group">
                              <input type="text" class="form-control input-lg" placeholder="INSERT CAPTCHA" />
                              <span class="input-group-addon">
                              <a href="#">                    <i class="fa fa-repeat"></i>
                              </a>                </span>
                           </div>
                           <div class="required-fields text-right spacer-bottom-5">
                              * Required fields
                           </div>
                           <div>
                              <div class="checkbox">
                                 <label class="small">
                                 <input type="checkbox" name="Iscriviti" value="1" /> Subscribe to the newsletter
                                 </label>
                              </div>
                              <div class="checkbox">
                                 <label class="small">
                                 <input type="checkbox" name="privacy" value="1" /> I agree to the policies of the <a class="btn-link" href="#">privacy</a>
                                 </label>
                              </div>
                           </div>
                           <div>
                              <button type="submit" class="btn btn-warning btn-lg btn-block">
                              <i class="fa fa-user"></i> Create your Account
                              </button>
                           </div>
                           <p class="text-center small no-margin">
                              Already are you member? <a class="btn-link" href="signin.html">Sign in</a>
                           </p>
                        </form>
                     </div>
                     <div class="col-md-5 spacer-30">
                        <div class="text-center">
                           <h4 class="no-margin-top">
                              Use your social network<br>account to signin
                           </h4>
                           <div class="socials btn-group clearfix">
                              <!--
                                 Exsample:
                                 var social = facebook, twitter, pinterest, google, linkedin or youtube
                                 var smaller = smaller or nil
                                 var link = link
                                 -->
                              <a class="btn-social btn-facebook " href="#">  <i class="fa fa-facebook fa-1x"></i>
                              </a>
                              <!--
                                 Exsample:
                                 var social = facebook, twitter, pinterest, google, linkedin or youtube
                                 var smaller = smaller or nil
                                 var link = link
                                 -->
                              <a class="btn-social btn-twitter " href="#">  <i class="fa fa-twitter fa-1x"></i>
                              </a>
                           </div>
                        </div>
                     </div>
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
                     <h4 class="modal-title email-icon" id="modalResetPsw">Reset your password</h4>
                  </div>
                  <div class="modal-body">
                     <p>
                        To reset your password, enter the email address you use to sign in to site.<br>
                        We will then send you a new password.
                     </p>
                     <form action="#" accept-charset="UTF-8" method="post" class="form-style-base">
                        <input type="hidden" name="_method" value="put" />
                        <fieldset>
                           <div class="row clearfix">
                              <div class="form-group col-sm-9">
                                 <input type="email" class="form-control input-lg" placeholder="Enter email" />
                              </div>
                              <div class="col-sm-3">
                                 <input type="submit" value="SEND" class="btn btn-warning no-margin btn-block" />
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
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
                        <i class="fa fa-truck"></i> FREE SHIPPING WORLDWIDE
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
                  <article class="col-sm-12 col-md-4 col-lg-3">
                     <form id="search" class="bg-white">
                        <div class="input-group">
                           <input type="text" class="form-control" name="search" placeholder="Search the whole shop" />
                           <span class="input-group-addon">
                           <button class="btn-link no-margin" type="button">
                           <i class="fa fa-search"></i>
                           </button>
                           </span>
                        </div>
                     </form>
                  </article>
                  <article class="col-sm-12 col-md-4 col-lg-6" id="logo">
                     <a href="./">          <img class="image-responsive center-block" alt="Kids Store" src="assets/images/logo.png" />
                     </a>      
                  </article>
                  <article class="col-sm-12 col-md-4 col-lg-3 hidden-xs">
                     <div class="dropdown bg-white" id="basket">
                        <div class="shadow-wrap-box">
                           <a href="#" class="checkout-basket dropdown-toggle btn-block clearfix" data-toggle="dropdown" aria-expanded="true">
                              <div class="pull-left bg-super-light">
                                 <i class="fa fa-shopping-cart"></i>
                              </div>
                              <div class="info-basket pull-left">
                                 <span data-name="item">3 item(s) - </span>
                                 <span data-name="price">
                                 <strong>$50.00</strong>
                                 </span>
                              </div>
                              <div class="pull-right arrow">
                                 <i class="glyphicon glyphicon-chevron-down"></i>
                              </div>
                           </a>
                           <div class="block-basket wrap-radius btn-block dropdown-menu col-lg-4 col-xs-12 col-md-4" role="menu">
                              <div class="content-basket">
                                 <ul class="products-list list-unstyled">
                                    <li class="item">
                                       <div class="clearfix row">
                                          <div class="col-xs-10 product-details">
                                             <div class="clearfix row">
                                                <p class="col-xs-8 product-name no-margin">
                                                   Pigiama bambina
                                                </p>
                                                <p class="col-xs-4 price no-margin text-right no-padding">
                                                   $15
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-xs-2 no-padding-left">
                                             <button type="button" class="close" data-dismiss="modal">
                                             <i class="fa fa-times"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="item">
                                       <div class="clearfix row">
                                          <div class="col-xs-10 product-details">
                                             <div class="clearfix row">
                                                <p class="col-xs-8 product-name no-margin">
                                                   Dress blue
                                                </p>
                                                <p class="col-xs-4 price no-margin text-right no-padding">
                                                   $15
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-xs-2 no-padding-left">
                                             <button type="button" class="close" data-dismiss="modal">
                                             <i class="fa fa-times"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="item">
                                       <div class="clearfix row">
                                          <div class="col-xs-10 product-details">
                                             <div class="clearfix row">
                                                <p class="col-xs-8 product-name no-margin">
                                                   Pigiama bambino
                                                </p>
                                                <p class="col-xs-4 price no-margin text-right no-padding">
                                                   $15
                                                </p>
                                             </div>
                                          </div>
                                          <div class="col-xs-2 no-padding-left">
                                             <button type="button" class="close" data-dismiss="modal">
                                             <i class="fa fa-times"></i>
                                             </button>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                                 <div class="summary clearfix">
                                    <p class="amount pull-left no-margin">2 Items</p>
                                    <p class="subtotale pull-right no-margin">
                                       Tot:&nbsp;&nbsp;&nbsp;<span class="price">€ 40,90</span>
                                    </p>
                                 </div>
                                 <div class="button-basket text-right">
                                    <a class="btn btn-warning btn-sm no-margin" href="cart.html">view cart</a>
                                    <a class="btn btn-warning btn-sm no-margin" href="payment.html">Checkout</a>
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
                                 <li class="active">
                                    <a href="{{url('/')}}">Trang chủ</a>
                                 </li>
                                 <li>
                                    <a href="about-us.html">Thông tin</a>
                                 </li>
                                 <li>
                                    <a role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> Mua hàng <i class="fa fa-angle-down"></i>
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
                     <a class="navbar-brand" href="basket.html">
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
      <main class="bg-extra-light-grey">
         @yield('main class')
      </main>
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
   </body>
</html>