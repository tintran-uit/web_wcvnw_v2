@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main class="bg-extra-light-grey">
<!-- Modal advertising -->
<section id="main-slideshow" class="carousel slide carousel-fade">
   <div class="container-fluid no-padding">
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
         <div class="item active">
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
<section id="category-content">
   <div class="container">
      
      <section class="text-center spacer-bottom-20">
         <h3 class="no-margin" style="font-size: 20px; color: #0071b6"><b>Thực phẩm sạch</b></h3>
         <h5 class="no-margin"></h5>
         <br>
         <ul class="nav nav-tabs nav-justified">
           <!--  <li class="active"><a data-toggle="tab" href="#home" aria-expanded="false">Gói sản phẩm</a></li>
            <li><a data-toggle="tab" href="#home" aria-expanded="false">Thịt heo</a></li>
            <li><a data-toggle="tab" href="#menu1s">Thịt bò</a></li>
            <li><a data-toggle="tab" href="#menu2">Thịt gà và trứng gà</a></li>
            <li><a data-toggle="tab" href="#menu3">Rau củ theo mùa</a></li>
            <li><a data-toggle="tab" href="#menu4">Đồ khô</a></li>
            <li><a data-toggle="tab" href="#menu5s">Thủy hải sản</a></li>
            <li><a data-toggle="tab" href="#menu6s">Hoa quả</a></li> -->
            <?php  
               $counter = 0; 

               foreach($categories as $category) {

                 $selected = ''; 

                 if ( !empty($category) ) {
                   $selected = ($counter === 0) ? 'class="active"' : ''; 
                   $output  = '';
                   $output .= '<li '. $selected .'>'; 
                   $output .= '<a data-toggle="tab" href="#category'.$category->id.'" class="scroll">' . $category->name . '</a>';
                   $output .= '</li>';
                   echo($output);
                   $counter++; 

                 }

               }
            ?>
        </ul>
      </section>
      <section class="clearfix row" id="product-content">
         <section class="col-md-12 col-lg-12">
            <div class="product-box">
               <div class="row">
                  <div class="tab-content">
                  <?php $counter = 0; ?>
                  @foreach ($categories as $category)
                     <?php 
                        $selected = ($counter === 0) ? 'active in' : ''; 
                        $counter++;
                     ?>
                      <div id="category{{$category->id}}" class="tab-pane fade {{$selected}}">
                        
                      </div>
                  @endforeach
                   
                 </div>
                  
               </div>
            </div>
         </section>
      </section>
     
   </div>
</section>
<section class="purchase-benefits spacer-30 " id="ttt">
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
         Góc kinh nghiệm
      </h3>
      <div class="row">
         <article class="col-xs-12 col-sm-6 col-md-4">
            <div class="content-new bg-white">
               <div class="thumbnail">
                  <section class="caption top">
                     <figure>
                        <a href="post.html">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo4.jpg" />
                           <h4 class="title">Mẹo vặt đi chợ</h4>
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
                           <h4 class="title">Phân biệt thực phẩm sạch</h4>
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
                           <h4 class="title">Kinh nghiệm nhà nông</h4>
                        </a>
                     </figure>
                  </section>
               </div>
            </div>
         </article>
      </div>
   </div>
</section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript">

         var isShop = {{$isShop or '0'}};
         loadProdList();
         isMuaHang(isShop);

         jQuery(document).ready(function ($) {

            if (isMobile()) {
   
              $('.nav a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
               })  
                
                $('a.scroll').on('click', function (e) {
                    var href = $(this).attr('href');
                     $('html, body').animate({
                        scrollTop: $('#product-content').offset().top
                    }, 'slow');
                    e.preventDefault();
                    
                  });
                  
               } 

            $('#menu-Muahang').on('click', function (e) {
                  scrollToMuaHang();
                  e.preventDefault();
               });

         });

         function isMuaHang(isShop) {
            if(isShop == '1'){
               scrollToMuaHang();
            }
         }

         function isMobile() {
            if($(window).width() < 768)
               return true;
            return false;
         }

         function scrollToMuaHang() {

            $('html, body').animate({
                        scrollTop: $('#category-content').offset().top
                    }, 'slow');
                     $('.navbar-nav li.active').removeClass('active');
                     $(this).addClass('active');
                    
         }

         function loadProdList() {
         
              /* set no cache */
           $.ajaxSetup({ cache: false });
           var url = "/api/products"; 
           $.getJSON(url, function(data){ 
               var html = [];
    
               /* loop through array */
               $.each(data, function(index, data){ 
                  var html = '';
                  $.each(data, function(i, d){
                     html = html + '<article class=\"col-sm-6 col-lg-3\">\r\n                           <div class=\"relative\">\r\n                              <div class=\"ribbon ribbon-new\">\r\n                                 <span class=\"ribbonBadge new text-uppercase\">\r\n                                 NEW\r\n                                 <\/span>\r\n                              <\/div>\r\n                                                           <div class=\"content-product\">\r\n                                 <div class=\"thumbnail\">\r\n                                    <figure class=\"image-product\">\r\n                                       <div class=\"btn-view\">\r\n                                          <a class=\"white\" href=\"product-details.html\">    <i class=\"fa fa-search\"><\/i>\r\n                                          <\/a>\r\n                                       <\/div>\r\n                                       <a class=\"center-block\" href=\"/product&slug='+d.slug+'\">        <img class=\"img-responsive center-block small-img\" alt=\"product\" src=\"http://wecarevn.com/uploads'+d.image+'\" \/>\r\n                                       <\/a>    \r\n                                    <\/figure>\r\n                                    <div class=\"caption text-center\">\r\n                                       <article class=\"copy\">\r\n                                          <h4 class=\"no-margin-top\">'+d.name+'<\/h4>\r\n                                          <p>\r\n                                             Size: 12 - 18 mounths<br>\r\n                                             Discount end to 50%\r\n                                          <p>\r\n                                       <\/article>\r\n                                       <article class=\"price\">\r\n                                                            <span class=\"new-price\" style=\"padding-left: 0px;\">\r\n                                          <strong>'+numberWithCommas(d.price)+' VND<\/strong>\r\n                                          <\/span>\r\n                                       <\/article>\r\n                                            <article class=\"button-group clearfix\">\r\n                                          <div class=\"pull-left\">\r\n                                             <a class=\"btn btn-info no-margin\" href=\"\">            <i class=\"fa fa-heart\"><\/i>\r\n                                             <\/a><a class=\"btn btn-info no-margin\" href=\"\">            <i class=\"fa fa-eye\"><\/i>\r\n                                             <\/a>        \r\n                                          <\/div>\r\n                                          <div class=\"pull-right\">\r\n                                             <a class=\"btn btn-primary no-margin\" href=\"/product&slug='+d.slug+'\">            Add to cart\r\n                                             <\/a>        \r\n                                          <\/div>\r\n                                       <\/article>\r\n                                    <\/div>\r\n                                 <\/div>\r\n                              <\/div>\r\n                           <\/div>\r\n                        <\/article>';
                  });
                  $('#category'+index).html(html);
               });
    
               
               $("#div381").html(html.join('')).css("background-color", "orange");
           }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
               /* alert(jqXHR.responseText) */
               console.log("error occurred!");
           });
         }

         function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }
      </script>

@endsection