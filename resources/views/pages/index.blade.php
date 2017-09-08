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
<!-- Modal chon nong dan -->
      <div class="modal fade simple-modal" id="modalChooseFarmer" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog">
              <div class="modal-content">
                 <div class="inner-container">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">
                       <i class="fa fa-times"></i>
                       </span>
                       </button>
                       <h4 class="modal-title email-icon" id="modalSubscribeNewsletter">Chọn nhà cung cấp</h4>
                    </div>
                    <div class="modal-body">
                       <table class="table table-striped">
                          <thead>
                            <tr>
                              <th class="col-sm-1">Chọn</th>
                              <th class="col-sm-3">Nông trại</th>
                              <th class="col-sm-2">Đáp ứng</th>
                              <th class="col-sm-3">
                               Đánh giá
                              </th>
                              <th class="col-sm-3"> </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="radio" name="optradio"></td>
                              <td>Nông trại anh Tài</td>
                              <td>500 kg</td>
                              <td>
                                <div id="colorstar" class="starrr ratable">
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                </div>
                              </td>
                              <td><a>Xem nguồn gốc</a></td>
                            </tr>
                            <tr>
                              <td><input type="radio" name="optradio"></td>
                              <td>Nông trại Trung Thực</td>
                              <td>500 kg</td>
                              <td>
                                <div id="colorstar" class="starrr ratable">
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                </div>
                              </td>
                              <td><a>Xem nguồn gốc</a></td>
                            </tr>
                            <tr>
                              <td><input type="radio" name="optradio"></td>
                              <td>Nông trại tươi xanh</td>
                              <td>500 kg</td>
                              <td>
                                <div id="colorstar" class="starrr ratable">
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                </div>
                              </td>
                              <td><a>Xem nguồn gốc</a></td>
                            </tr>
                          </tbody>
                      </table>
                      <div class="row">
                      <section class="choose col-sm-10 col-xs-9">
                          <div class="col-sm-2 vcenter">
                            <h5 class="">
                              <b>Số lượng:</b>
                            </h5>
                          </div>
                          <div class="stepper col-sm-5 vcenter"><input type="number" class="form-control stepper-input" id="stepper" value="1" min="1" max="20" step="1"><span class="stepper-arrow up" onclick="stepperUp()">Up</span><span class="stepper-arrow down" onclick="stepperDown()">Down</span>
                          </div>
                      </section>
                      <section class="choose col-sm-2 col-xs-3">
                            <a class="btn btn-info btn-lg" onclick="addCart()">Thêm</a>
                      </section>
                      </div>
                    </div>
                 </div>
              </div>
           </div>
      </div>
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
               /* loop through array */
               $.each(data, function(index, data){ 
                  var length = data.length;
                  var html = '<div id=\"myCarousel'+index+'\" class=\"carousel slide\">\r\n ';
                  //thanh so
                  html += '\r\n <ul class=\"pagination\">\r\n    <li>\r\n<a href=\"#myCarousel'+index+'\" data-slide=\"prev\">        <span aria-hidden=\"true\" class=\"fa fa-chevron-left\"><\/span>\r\n<\/a>    <\/li>\r\n';
                  var n = length/8;
                  var numClick = '';
                  for(var i = 0; i<=n; i++)
                    {
                      numClick += ' <li data-target=\"#myCarousel'+index+'\" data-slide-to=\"'+i+'\" class=\"active\"><a href=\"#\">'+(i+1)+'<\/a><\/li>';
                      }
                  html += numClick;
                  html += '<li>\r\n      <a href=\"#myCarousel'+index+'\" data-slide=\"next\">\r\n        <span aria-hidden=\"true\" class=\"fa fa-chevron-right\"><\/span>\r\n      <\/a>\r\n    <\/li>\r\n  <\/ul>';

                  html += '<!-- Wrapper for slides -->\r\n    <div class=\"carousel-inner\">';
                  $.each(data, function(i, d){

                     var prodHtml = '<article class=\"col-xs-6 col-sm-4 col-lg-3\">\r\n                           <div class=\"relative\">\r\n                              <div class=\"ribbon ribbon-new\">\r\n                                 <span class=\"ribbonBadge new text-uppercase\">\r\n                                 Hữu cơ\r\n                                 <\/span>\r\n                              <\/div>\r\n                                                           <div class=\"content-product\">\r\n                                 <div class=\"thumbnail\">\r\n                                    <figure class=\"image-product\">\r\n                                       <div class=\"btn-view\">\r\n                                          <a class=\"white\" href=\"product&slug='+d.slug+'\">    <i class=\"fa fa-search\"><\/i>\r\n                                          <\/a>\r\n                                       <\/div>\r\n                                       <a class=\"center-block\" href=\"/product&slug='+d.slug+'\">        <img class=\"img-responsive center-block small-img\" alt=\"product\" src=\"http://wecarevn.com/uploads'+d.image+'\" \/>\r\n                                       <\/a>    \r\n                                    <\/figure>\r\n                                    <div class=\"caption text-center\">\r\n                                       <article class=\"copy\">\r\n                                          <h4 class=\"no-margin-top\"><a href=\"product&slug='+d.slug+'\">'+d.name+'</a><\/h4>\r\n                                          <p>\r\n                                             Size: 12 - 18 mounths<br>\r\n                                             Discount end to 50%\r\n                                          <p>\r\n                                       <\/article>\r\n                                       <article class=\"price\">\r\n                                                            <span class=\"new-price\" style=\"padding-left: 0px;\">\r\n                                          <strong>'+numberWithCommas(d.price)+' VND<\/strong>\r\n                                          <\/span>\r\n                                       <\/article>\r\n                                            <article class=\"button-group clearfix\">\r\n                                          <div class=\"pull-left\">\r\n                                             <a class=\"btn btn-info no-margin\" href=\"\">            <i class=\"fa fa-heart\"><\/i>\r\n                                             <\/a><a class=\"btn btn-info no-margin\" href=\"\">            <i class=\"fa fa-eye\"><\/i>\r\n                                             <\/a>        \r\n                                          <\/div>\r\n                                          <div class=\"pull-right\">\r\n                                             <a class=\"btn btn-primary no-margin\" onclick=\"clickFarm('+d.id+')\">            Thêm vào giỏ\r\n                                             <\/a>        \r\n                                          <\/div>\r\n                                       <\/article>\r\n                                    <\/div>\r\n                                 <\/div>\r\n                              <\/div>\r\n                           <\/div>\r\n                        <\/article>';

                     switch (i){
                         case 0:
                            html += '<div class=\"item active\">\r\n';
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                         case 8:
                            html += '\r\n <\/div>\r\n<div class=\"item\">\r\n';
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                         case 16:
                            html += '\r\n <\/div>\r\n<div class=\"item\">\r\n';
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                         case 24:
                            html += '\r\n <\/div>\r\n<div class=\"item\">\r\n';
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                         case 32:
                            html += '\r\n <\/div>\r\n<div class=\"item\">\r\n';
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                         default:
                            html += prodHtml;
                            if(i==length)
                            {
                              html += '\r\n <\/div>';
                            }
                            break;
                      }   

                  });

                  html += '<\/div>\r\n <\/div> \r\n <ul class=\"pagination\">\r\n    <li>\r\n<a href=\"#myCarousel'+index+'\" data-slide=\"prev\">        <span aria-hidden=\"true\" class=\"fa fa-chevron-left\"><\/span>\r\n<\/a>    <\/li>\r\n';
                  var numClick2 = '';
                  for(var i = 0; i<=n; i++)
                    {
                      numClick2 += ' <li data-target=\"#myCarousel'+index+'\" data-slide-to=\"'+i+'\" class=\"active\"><a href=\"#\">'+(i+1)+'<\/a><\/li>';
                      }
                  html += numClick2;
                  html += '<li>\r\n      <a href=\"#myCarousel'+index+'\" data-slide=\"next\">\r\n        <span aria-hidden=\"true\" class=\"fa fa-chevron-right\"><\/span>\r\n      <\/a>\r\n    <\/li>\r\n  <\/ul>';
                  $('#category'+index).html(html);
               });
    
               
               // $("#div381").html(html.join('')).css("background-color", "orange");
           }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
               /* alert(jqXHR.responseText) */
               console.log("error occurred!");
           });
         }

         function stepperUp() {
            var num = document.getElementById('stepper').value;
            num = parseInt(num);
            document.getElementById('stepper').value = num + 1; 

          }

          function stepperDown() {
            var num = document.getElementById('stepper').value;
            num = parseInt(num);
            if(num>0)
            {
            document.getElementById('stepper').value = num - 1; 
            }
          }

          function clickFarm(id) {
            console.log(id);
            var url = 'api/payment/checkMa=ma';
            $.ajaxSetup({ cache: false });
            $('#modalLoader').modal('show');
            $.getJSON(url, function(data){
                  $('#modalLoader').modal('hide');
                  $('#modalChooseFarmer').modal('show');
                  console.log(data);
               }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  $('#modalLoader').modal('hide');
                   alert("Vui lòng kiểm tra kết nối internet.");
               });
            
          }

          function addCart() {
              var id = 1;
              var qty = document.getElementById('stepper').value;
              var data = { "id": id, "qty": qty };
                  $.ajax({
                      type: "POST",
                      url: "api/cart/add-item",
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                      },
                      // The key needs to match your method's input parameter (case-sensitive).
                      data: JSON.stringify({ data: data }),
                      contentType: "application/json; charset=utf-8",
                      dataType: "json",
                      success: function(data){
                        updateCartStatus(data);
                        console.log(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          console.log(textStatus);
                          alert("Vui lòng kiểm tra kết nối Internet!");
                      }
                  });
          }


         function numberWithCommas(x) {
             return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
         }
      </script>

@endsection