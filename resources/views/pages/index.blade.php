@extends('layouts.customer')
@section('title')
hello!
@endsection
@section('main class')
<!-- Modal advertising -->
<section id="main-slideshow" class="carousel slide carousel-fade">
   <div class="container-fluid no-padding">
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
         <div class="item">
            <a href="#">          <img alt="slide" src="assets/images/slides/slide1.jpg" />
            </a>      
         </div>
         <div class="item">
            <a href="#">          <img alt="slide" src="assets/images/slides/slide3.jpg" />
            </a>        
            <div class="label-slide hidden-sm hidden-xs slideInDown animated">
               <div>
                  <h2 class="no-margin-bottom">NEW</h2>
                  <h5 class="no-margin-top">COLLECTION</h5>
               </div>
               <p class="text-center">SPRING<BR>SUMMER</p>
               <h1 class="text-right">‘15</h1>
            </div>
         </div>
         <div class="item active">
            <a href="#">          <img alt="slide" src="assets/images/slides/slide4.jpg" />
            </a>      
         </div>
         <div class="item">
            <a href="#">          <img alt="slide" src="assets/images/slides/slide5.jpg" />
            </a>      
         </div>
         <div class="item">
            <a href="#">          <img alt="slide" src="assets/images/slides/slide2.jpg" />
            </a>        
            <div class="carousel-caption">
               <h3>Didascalia</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
         </div>
      </div>
      <!-- end -->
      <!-- Indicatori di posizione -->
      <ol class="carousel-indicators">
         <li data-target="#main-slideshow" data-slide-to="0" class="active"></li>
         <li data-target="#main-slideshow" data-slide-to="1"></li>
         <li data-target="#main-slideshow" data-slide-to="2"></li>
      </ol>
      <!-- end -->
      <!-- Controlli -->
      <a class="left carousel-control" href="#main-slideshow" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="right carousel-control" href="#main-slideshow" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      </a>
      <!-- end -->
   </div>
</section>
<!-- insert background-color bg-light in the section container and class space-divider -->
<section class="subscribe-type-one spacer-30">
   <div class="container">
      <!--     <h2 class="title-font-handwritten text-center space-only-bottom">Subscribe Freely</h2> -->
   </div>
</section>
<section>
   <div class="container">
      <section class="clearfix row spacer-bottom-30">
         <article class="col-md-8 col-lg-7">
            <div class="spacer-bottom-10">
               <div id="slideshow-products" class="carousel slide">
                  <div class="carousel-inner">
                     <div class="item active">
                        <a href="#">                    <img alt="slide" src="assets/images/slides/slide6.jpg" />
                        </a>                
                     </div>
                     <div class="item">
                        <a href="#">                    <img alt="slide" src="assets/images/slides/slide7.jpg" />
                        </a>                
                     </div>
                     <div class="item">
                        <a href="#">                    <img alt="slide" src="assets/images/slides/slide7.jpg" />
                        </a>                
                     </div>
                  </div>
                  <!-- Indicatori di posizione -->
                  <ol class="carousel-indicators">
                     <li data-target="#slideshow-products" data-slide-to="0" class="active"></li>
                     <li data-target="#slideshow-products" data-slide-to="1"></li>
                     <li data-target="#slideshow-products" data-slide-to="2"></li>
                  </ol>
               </div>
            </div>
         </article>
         <article class="col-md-4 col-lg-5">
            <div class="block-evaluation wrap internal-padding bg-white">
               <p class="text-center spacer-bottom-10">
                  Rating buyers Kids Store
               </p>
               <div class="block-content">
                  <div class="clearfix">
                     <div class="pull-left">
                        <h3 class="no-margin general-vote">Ottimo</h3>
                        <span class="stars">
                        <i class="fa fa-star-o fa-lg"></i>
                        <i class="fa fa-star-o fa-lg"></i>
                        <i class="fa fa-star-o fa-lg"></i>
                        <i class="fa fa-star-half-o fa-lg"></i>
                        </span>
                     </div>
                     <div class="pull-right">
                        <img alt="hight quality" src="assets/images/icons/icon-quality.png" />
                     </div>
                  </div>
                  <p class="spacer-top-10 comments">
                     <i class="fa fa-quote-left"></i> Had an amazing time. Great service! <i class="fa fa-quote-right"></i>
                  </p>
                  <div class="text-right">
                     <a class="btn-link" href="#">READ ALL COMMENTS</a>
                  </div>
               </div>
            </div>
            <section class="wrap internal-padding bg-white subscribe-type-2">
               <div class="text-center spacer-bottom-10">
                  <i class="fa fa-hand-o-down fa-2x"></i>
               </div>
               <p class="text-center title">
                  SUBSCRIBE TO THE NEWSLETTER<br>
                  AND GET A GOOD FROM € 10
               </p>
               <form action="/#" accept-charset="UTF-8" method="post" class="form-style-base">
                  <div class="input-group">
                     <input type="email" class="form-control input-lg" placeholder="Enter your adress email" />
                     <span class="input-group-addon">
                     <button class="btn-link">
                     <i class="fa fa-arrow-circle-o-right"></i>
                     </button>
                     </span>
                  </div>
               </form>
            </section>
         </article>
      </section>
      <section class="text-center spacer-bottom-20">
         <h3 class="no-margin">Thực phẩm sạch</h3>
         <h5 class="no-margin">Tốt cho sức khỏe gia đình bạn</h5>
      </section>
      <section class="clearfix row">
         <section class="col-md-12 col-lg-12">
            <div class="product-box">
               <div class="row">
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="ribbon ribbon-new">
                           <span class="ribbonBadge new text-uppercase">
                           NEW
                           </span>
                        </div>
                        <div class="simple-wishlist">
                           <a class="" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-02.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Yellow Suit</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="simple-wishlist">
                           <a class="" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-03.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Blue Dress</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="simple-wishlist">
                           <a class="" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-04.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Jeans</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="simple-wishlist">
                           <a class="" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-05.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Dress Sailor</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="simple-wishlist">
                           <a class="selected" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-07.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Summer top</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
                  <article class="col-sm-6 col-lg-3">
                     <div class="relative">
                        <div class="simple-wishlist">
                           <a class="" href="#">    <i class="fa fa-heart"></i>
                           </a>
                        </div>
                        <div class="ribbon ribbon-sale">
                           <span class="ribbonBadge sale text-uppercase">
                           50% OFF
                           </span>
                        </div>
                        <div class="content-product">
                           <div class="thumbnail">
                              <figure class="image-product">
                                 <div class="btn-view">
                                    <a class="white" href="product-details.html">    <i class="fa fa-search"></i>
                                    </a>
                                 </div>
                                 <a class="center-block" href="product-details.html">        <img class="img-responsive center-block small-img" alt="product" src="assets/images/products/product-08.png" />
                                 </a>    
                              </figure>
                              <div class="caption text-center">
                                 <article class="copy">
                                    <h4 class="no-margin-top">Grey Suit</h4>
                                    <p>
                                       Size: 12 - 18 mounths<br>
                                       Discount end to 50%
                                    <p>
                                 </article>
                                 <article class="price">
                                    <span class="old-price">
                                    $10.50
                                    </span>
                                    <span class="new-price">
                                    <strong>$5.50</strong>
                                    </span>
                                 </article>
                                 <article class="color-section">
                                    <i class="label-color" style="background-color: #ff7473"></i>
                                    <i class="label-color" style="background-color: #f8c931"></i>
                                    <i class="label-color" style="background-color: #14cfc4"></i>
                                    <i class="label-color" style="background-color: #b04072"></i>
                                 </article>
                                 <article class="button-group clearfix">
                                    <div class="pull-left">
                                       <a class="btn btn-info no-margin" href="#">            <i class="fa fa-heart"></i>
                                       </a><a class="btn btn-info no-margin" href="product-details.html">            <i class="fa fa-eye"></i>
                                       </a>        
                                    </div>
                                    <div class="pull-right">
                                       <a class="btn btn-primary no-margin" href="product-details.html">            Add to cart
                                       </a>        
                                    </div>
                                 </article>
                              </div>
                           </div>
                        </div>
                     </div>
                  </article>
               </div>
            </div>
         </section>
      </section>
   </div>
</section>
<section class="purchase-benefits spacer-30 ">
   <div class="bg-white spacer-10">
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
<section class="news-box spacer-bottom-30">
   <div class="container">
      <h3 class="text-uppercase text-center spacer-bottom-20 no-margin">
         From the Blog
      </h3>
      <div class="row">
         <article class="col-xs-12 col-sm-6 col-md-4">
            <div class="content-new bg-white">
               <div class="thumbnail">
                  <section class="caption top">
                     <figure>
                        <a href="post.html">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo4.jpg" />
                           <h4 class="title">Title articles</h4>
                        </a>
                     </figure>
                  </section>
               </div>
            </div>
         </article>
         <article class="col-xs-12 col-sm-6 col-md-4">
            <div class="content-new bg-white">
               <div class="thumbnail">
                  <section class="caption top">
                     <figure>
                        <a href="post.html">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo5.jpg" />
                           <h4 class="title">Title articles</h4>
                        </a>
                     </figure>
                  </section>
               </div>
            </div>
         </article>
         <article class="col-xs-12 col-sm-12 col-md-4">
            <div class="content-new bg-white">
               <div class="thumbnail">
                  <section class="caption top">
                     <figure>
                        <a href="post.html">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo6.jpg" />
                           <h4 class="title">Title articles</h4>
                        </a>
                     </figure>
                  </section>
               </div>
            </div>
         </article>
      </div>
   </div>
</section>
@endsection