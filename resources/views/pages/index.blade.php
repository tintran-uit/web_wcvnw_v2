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
            <a href="#">          <img alt="slide" src="{{url('')}}/assets/images/slides/Artboard 4.png" />
            </a>
            <div class="label-slide hidden-sm hidden-xs slideInDown animated">
               <div>
                  <h2 class="no-margin-bottom">GÓI</h2>
                  <h5 class="no-margin-top">SẢN PHẨM</h5>
               </div>
               <p class="text-center">TIỆN DỤNG<BR>DINH DƯỠNG<BR>TIẾT KIỆM</p>
               <h1 class="text-right">5-10%</h1>
            </div>      
         </div>
         <div class="item">
            <a href="#" onclick="scrollToMuaHang()">          <img alt="slide" src="{{url('')}}/assets/images/slides/Artboard 3.png" />
            </a>        
            <div class="carousel-caption">
               <h4><b>Để đảm bảo đủ sản lượng thực phẩm nuôi trồng thuận tự nhiên & hữu cơ cung cấp cho khách hàng</b></h4>
               <h3><b>Cfarm chốt đơn vào 6h:00 PM Thứ Năm - Giao hàng tại nhà vào Thứ Bảy hàng tuần.</b></h3>
               <p>(Các đơn hàng đặt sau 6h00 PM Thứ Năm sẽ được giao vào thứ Bảy của tuần tiếp theo.<br> Cảm ơn quý khách đã đồng hành cùng Cfarm xây dựng cộng đồng nuôi trồng thực phẩm sạch & hữu cơ)</p>
            </div>
         </div>
         
         <div class="item">
            <a href="#">          <img alt="slide" src="{{url('')}}/assets/images/slides/Artboard 5.png" />
            </a>        
            <div class="carousel-caption">
               <h3>Chuyên sản phẩm sạch - hữu cơ</h3>
               <p>Kết nối lương nông - an lòng nội trợ.</p>
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

<section id="category-content" style="margin-top: 25px">
   <div class="container">
      
      <section class="text-center spacer-bottom-20">
         <h3 class="no-margin title-index" style="">{{ trans('head.productTab') }}</h3>
         <h5 class="no-margin"></h5>
         <br>
         <ul class="nav nav-tabs nav-justified">
            <?php  
                $url = 'http://'.$_SERVER['HTTP_HOST'];
               $counter = 0; 
               
               foreach($categories as $category) {
                  $img = '<img class="image-responsive" alt="Kids Store" src="'.$url.'/assets/images/icons/product-tab/'.$category->icon.'.png" height="25px"><br>';
                 $selected = ''; 

                 if ( !empty($category) ) {
                   $selected = ($counter === 0) ? 'class="active"' : ''; 
                   $output  = '';
                   $output .= '<li '. $selected .'>'; 
                   $output .= '<a data-toggle="tab" href="#category'.$category->id.'" class="scroll">' . $img . $category->name . '</a>';
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

@include('layouts.banner_bottom')

<section class="subscribe-type-one spacer-30">
   <div class="container">
          <h2 class="title-font-handwritten text-center space-only-bottom">Hành trình khảo sát và kết nối lương nông</h2>
          <div class="intro col-md-6 col-md-offset-3 text-center"><p>"...nhìn về tương lai nơi mà những khách hàng của Cfarm tiêu dùng những thực phẩm hữu cơ sạch, đáng tin cậy cho nhu cầu của gia đình và những lương nông sẽ sống khoẻ trên những mảnh vườn nuôi trồng sạch của mình..."</p></div>
          <div class="content col-md-12">
            <div class="col-md-6">
              <!-- <div class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube.com/embed/X0m6Rdhs1Nw" frameborder="0" allowfullscreen></iframe></div> -->
              <img class="image-responsive" style="width: 100%; padding-bottom: 15px;" src="{{url('')}}/uploads/anh-thuc-te/00_visit-farm-dalat.png">
            </div>
            <div class="col-md-6">
             <h2 class="title-font-handwritten"> CFARM - KẾT NỐI LƯƠNG NÔNG - AN LÒNG NỘI TRỢ</h2>
              <div id="introCfarm">
              <p>Team Cfarm ấp ủ và phát triển dự án với tầm nhìn kết nối những lương nông sản xuất và nuôi trồng hữu cơ, an toàn với người tiêu dùng trên nền tảng công nghệ để giải bài toán về thực phẩm sạch, rõ nguồn gốc trước tình trạng thực phẩm bẩn, tẩm hoá chất đang tràn lan ngoài thị trường. 
              </p>

              <p>Để chạm đến ước mơ và đạt được mục tiêu đòi hỏi một quá trình, nhiều nỗ lực bền bỉ và đặc biệt là những người cộng sự đồng lòng. Cuộc hành trình của Cfarm bắt đầu từ những buổi thảo luận, gặp gỡ và tìm hiểu thông tin từ các bạn bè, anh chị, và những bậc tiền bối trong lĩnh vực nuôi trồng và phân phối nông sản hữu cơ tại Sài Gòn, Lâm Đồng và một số tỉnh miền Tây.</p>

              <p>Câu chuyện về hành trình khảo sát và kết nối lương nông của chúng tôi bắt đầu như thế. Đến thăm những trang trại, gặp những lương nông, nghe những câu chuyện của họ và thực tế khảo sát, kiểm tra qui trình sản xuất và tuyển chọn những hộ lương nông này để lại cho chúng tôi nhiều kỷ niệm đẹp và đáng nhớ.
              </p>

              <p>Để những sản phẩm đến tay người tiêu dùng đúng chất lượng và đáng tin cậy, team Cfarm hiểu rằng mình cần phải thực tế, phải đi đến tận nguồn và khảo sát, lựa chọn.......</p>
              </div>
              <a href="{{url('')}}/hanh-trinh-khao-sat-va-ket-noi-luong-nong" class="btn btn-success">Chi tiết</a>
            </div>
          </div>
   </div>
</section>

<section class="news-box spacer-bottom-30">
   <div class="container">
      <h2 class="title-font-handwritten text-center space-only-bottom">Góc kinh nghiệm</h2>
      <div class="row">
         <article class="col-xs-12 col-sm-6 col-md-4">
            <div class="content-new bg-white">
               <div class="thumbnail">
                  <section class="caption top">
                     <figure>
                        <a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=3">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo4.png" />
                           <h4 class="title">Góc nhà bếp</h4>
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
                        <a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=4">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo5.png" />
                           <h4 class="title">Dinh dưỡng & Sức khỏe</h4>
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
                        <a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/blog_id=5">
                           <img class="img-responsive" alt="img" src="assets/images/photo/photo6.png" />
                           <h4 class="title">Câu chuyện nhà nông</h4>
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
                       <h4 class="modal-title email-icon" id="modalSubscribeNewsletter">Chọn nhà cung cấp: <span style="font-weight: 700" id="modalNameProd"></span></h4>
                    </div>
                    <div class="modal-body">
                       <table class="table table-striped" id="tbSupp">
                          <thead>
                            <tr>
                              <th class="col-sm-1">Chọn</th>
                              <th class="col-sm-4">Nông trại</th>
                              <th class="col-sm-2">Đáp ứng</th>
                              <th class="col-sm-2">
                               Đánh giá
                              </th>
                              <th class="col-sm-3"> </th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            
                          </tbody>
                      </table>
                      <div class="row">
                      <section class="choose col-sm-10 col-xs-9">
                          <div class="col-sm-3 vcenter">
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
                     <h4 class="modal-title fa fa-exclamation-triangle" id="modalMessage" style="color: #b50000; margin-left: 3px;"></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection

@section('scrip_code')

<script type="text/javascript">

         var isShop = {{$isShop or '0'}};
         var prodID = 0;
         loadProdList();
         isMuaHang(isShop);

         jQuery(document).ready(function ($) {

            if (isMobile()) {
   
              // $('.nav a').click(function (e) {
              // e.preventDefault()
              // $(this).tab('show')
              //  })  
                
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
            $('#menu-Muahang2').on('click', function (e) {
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
                  html += '\r\n <ul class=\"pagination\" >\r\n    <li>\r\n<a href=\"#myCarousel'+index+'\" data-slide=\"prev\">        <span aria-hidden=\"true\" class=\"fa fa-chevron-left\"><\/span>\r\n<\/a>    <\/li>\r\n';
                  var n = length/8;
                  var numClick = '';
                  for(var i = 0; i<n; i++)
                    {
                      numClick += ' <li data-target=\"#myCarousel'+index+'\" data-slide-to=\"'+i+'\" class=\"\"><a href=\"#\">'+(i+1)+'<\/a><\/li>';
                      }
                  html += numClick;
                  html += '<li>\r\n      <a href=\"#myCarousel'+index+'\" data-slide=\"next\">\r\n        <span aria-hidden=\"true\" class=\"fa fa-chevron-right\"><\/span>\r\n      <\/a>\r\n    <\/li>\r\n  <\/ul>';

                  html += '<!-- Wrapper for slides -->\r\n    <div class=\"carousel-inner\">';
                  $.each(data, function(i, d){

                     var prodHtml = '<article class=\"col-xs-6 col-sm-4 col-lg-3\" style=\"\">\r\n                           <div class=\"relative\">\r\n                              <div class=\"ribbon ribbon-new\">\r\n                                 '+createLabel(d.label)+'                              <\/div>\r\n                                                           <div class=\"content-product\">\r\n                                 <div class=\"thumbnail\">\r\n                                    <figure class=\"image-product\">\r\n                                       <div class=\"btn-view\">\r\n                                          <a class=\"white\" href=\"product/slug='+d.slug+'\">    <i class=\"fa fa-search\"><\/i>\r\n                                          <\/a>\r\n                                       <\/div>\r\n                                       <a class=\"center-block\" href=\"/product/slug='+d.slug+'\">        <img class=\"img-responsive center-block small-img\" alt=\"product\" src=\"{{url('')}}/'+d.thumbnail +'\" \/>\r\n                                       <\/a>    \r\n                                    <\/figure>\r\n                                    <div class=\"caption text-center\">\r\n                                       <article class=\"copy\">\r\n                                          <h4 class=\"no-margin-top\"><a class=\"new-price\" href=\"product/slug='+d.slug+'\">'+d.name + ' '+d.unit_quantity+d.unit+'</a><\/h4>\r\n                                          \r\n                                          <p>\r\n                                       <\/article>\r\n                                       <article class=\"price\">\r\n                                                            <a href=\"{{url('')}}/nong-trai-sach/farmer_id='+d.farmer_id+'\"><span class=\"new-price\"> '+d.farmer_name+'                                          <\/span></a>\r\n                                       <\/article>\r\n                                            <article class=\"button-group clearfix\">\r\n                                           <div class=\"pull-left vcenter\">\r\n                                             <a class=\"btn btn-primary no-margin\" onclick=\"addCart(\''+d.id+'\','+d.farmer_id+')\">Thêm vào giỏ\r\n  <\/a>        \r\n  <\/div>\r\n ';

                     if(d.quantity_left==0){
                        prodHtml = '<article class=\"col-xs-6 col-sm-4 col-lg-3\" style=\"\">\r\n                           <div class=\"relative\">\r\n                              <div class=\"ribbon ribbon-new\">\r\n                                 '+createLabel(d.label)+'                              <\/div>\r\n                                                           <div class=\"content-product\">\r\n                                 <div class=\"thumbnail\">\r\n                                    <figure class=\"image-product\">\r\n                                       <div class=\"btn-view\">\r\n                                          <a class=\"white\" href=\"product/slug='+d.slug+'\">    <i class=\"fa fa-search\"><\/i>\r\n                                          <\/a>\r\n                                       <\/div>\r\n                                       <a class=\"center-block\" href=\"/product/slug='+d.slug+'\">        <img class=\"img-responsive center-block small-img\" alt=\"product\" src=\"{{url('')}}/'+d.thumbnail +'\" \/>\r\n  <div class="reported-out-of-stock text-center">Tạm hết hàng!</div>\r\n                         <\/a>    \r\n                                    <\/figure>\r\n                                    <div class=\"caption text-center\">\r\n                                       <article class=\"copy\">\r\n                                          <h4 class=\"no-margin-top\"><a class=\"new-price\" href=\"product/slug='+d.slug+'\">'+d.name + ' '+d.unit_quantity+d.unit+'</a><\/h4>\r\n                                          \r\n                                          <p>\r\n                                       <\/article>\r\n                                       <article class=\"price\">\r\n                                                            <a href=\"{{url('')}}/nong-trai-sach/farmer_id='+d.farmer_id+'\"><span class=\"new-price\"> '+d.farmer_name+'                                          <\/span></a>\r\n                                       <\/article>\r\n                                            <article class=\"button-group clearfix\">\r\n                                           <div class=\"pull-left vcenter\">\r\n                                             <a class=\"btn btn-primary no-margin\" onclick=\"addCart(\''+d.id+'\','+d.farmer_id+')\">Hết hàng\r\n  <\/a>        \r\n  <\/div>\r\n ';
                     }

                     if(index==0){
                      prodHtml += '<div class=\"pull-right vcenter\"><span class=\"span-price\">'+numberWithCommas(d.price)+' VNĐ  <\/span><br>\r\nMua l\u1EBB:\r\n<span class=\"\" style=\"font-size: 13px;text-decoration: line-through;\">'+numberWithCommas(d.price_old)+' VNĐ  <\/span> <\/div>';
                     }else{
                      prodHtml += '<div class=\"pull-right vcenter\">\r\n<span class=\"span-price\">'+numberWithCommas(d.price)+' VNĐ  </span>     \r\n      <\/div>';
                     }
                     prodHtml += '\r\n<\/article>\r\n                                    <\/div>\r\n                                 <\/div>\r\n                              <\/div>\r\n                           <\/div>\r\n                        <\/article>';

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
                  for(var i = 0; i<n; i++)
                    {
                      numClick2 += ' <li data-target=\"#myCarousel'+index+'\" data-slide-to=\"'+i+'\" ><a href=\"#\">'+(i+1)+'<\/a><\/li>';
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
            if(num>1)
            {
            document.getElementById('stepper').value = num - 1; 
            }
          }

          function clickFarm(prodName, id) {
            prodID = id;
            console.log(prodName);
            $('#modalNameProd').html(prodName);
            jQuery("#tbSupp tbody").empty();
            var url = '{{url('')}}/api/products/suppliers/product_id='+id;
            $.ajaxSetup({ cache: false });
            $('#modalLoader').modal('show');
            $.getJSON(url, function(data){
                  $('#modalLoader').modal('hide');
                  loadModal(data);
                  $('#modalChooseFarmer').modal('show');
               }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  $('#modalLoader').modal('hide');
                   alert("Vui lòng kiểm tra kết nối internet.");
               });
            
          }

          function clickFarm(id) {
            prodID = id;
            jQuery("#tbSupp tbody").empty();
            var url = '{{url('')}}/api/products/suppliers/product_id='+id;
            $.ajaxSetup({ cache: false });
            $('#modalLoader').modal('show');
            $.getJSON(url, function(data){
                  $('#modalLoader').modal('hide');
                  loadModal(data);
                  $('#modalChooseFarmer').modal('show');
               }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
                  $('#modalLoader').modal('hide');
                   alert("Vui lòng kiểm tra kết nối internet.");
               });
            
          }

          function loadModal(data) {
            $.each(data, function(index, data){ 
                  var newRowContent = '';

              if(index==0)
              {
                newRowContent = newRowContent = '<tr>\r\n <td><input type=\"radio\" value=\"'+data.id+'\" name=\"farmerID\" checked=\"checked\"><\/td>\r\n';
              }else{
                newRowContent = newRowContent = '<tr>\r\n <td><input type=\"radio\" value=\"'+data.id+'\" name=\"farmerID\"><\/td>\r\n';
              }

                                           newRowContent += '<td>'+data.name+'<\/td>\r\n                              <td>'+data.quantity_left+' kg<\/td>\r\n                              <td>\r\n                                <div id=\"colorstar\" class=\"starrr ratable\">\r\n                                  '+data.rating+' <span class=\"glyphicon glyphicon-star\"><\/span>\r\n                                <\/div>\r\n                              <\/td>\r\n                              <td><a href=\"luong-nong/id='+data.id+'\">Xem ngu\u1ED3n g\u1ED1c<\/a><\/td>\r\n                            <\/tr>';
              jQuery("#tbSupp tbody").append(newRowContent);

            });
          }

          function addCart(prodID, farmerID) {
              var qty = 1;
              // var farmerID = $('input[name="farmerID"]:checked').val();;
              // console.log(farmerID);
              var data = { "id": prodID, "qty": qty , 'farmerID':farmerID};
              $('#modalLoader').modal('show');
                  $.ajax({

                      type: "POST",
                      url: "{{url('')}}/api/cart/add-item",
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                      },
                      // The key needs to match your method's input parameter (case-sensitive).
                      data: JSON.stringify({ data: data }),
                      contentType: "application/json; charset=utf-8",
                      dataType: "json",
                      success: function(data){
                        $('#modalLoader').modal('hide');
                        if(data.error)
                        {
                          $('#modalMessage').html(data.status);
                          $('#modalAlert').modal('show');
                          // clickFarm(prodID);
                          // $('#modalChooseFarmer').modal('show');
                        }else{
                          updateCartStatus(data);
                          // $('#modalMessageFinish').html('Thêm thành công!');
                          // $('#modalAlertFinish').modal('show');
                          // setTimeout(function(){ $('#modalAlertFinish').modal('hide'); }, 800);
                        }
                        console.log(data);
                      },
                      error: function(XMLHttpRequest, textStatus, errorThrown) {
                          console.log(textStatus);
                          $('#modalMessage').html("Vui lòng kiểm tra kết nối Internet!");
                          $('#modalLoader').modal('hide');
                          $('#modalAlert').modal('show');
                      }
                  });
              $('#modalChooseFarmer').modal('hide');
          }

          function createLabel(label) {
            var code = '';
            if(label==1){
              code = '<span class=\"ribbonBadge new text-uppercase\"> Hữu cơ <\/span>\r\n';
            }else{
              code = '<span class=\"ribbonBadge new2 text-uppercase\"> An toàn <\/span>\r\n';
            }
            return code;
          }

          
          $('.pagination').on('click', 'li:not(.prev):not(.next)', function() {
            alert('sss');
              $('.pagination li').removeClass('active');
              $(this).not('.prev,.next').addClass('active');
          });

          $('.pagination').on('click', 'li.prev', function() {
              $('li.active').removeClass('active').prev().addClass('active');
          });

          $('.pagination').on('click', 'li.next', function() {
              $('li.active').removeClass('active').next().addClass('active');
          });

          // function drawPagination(numOfPages) {
          //     $('#pag_nav ul').empty();
          //     $('#pag_nav ul').append('<li class=prev><a href=# aria-label=Previous><span aria-hidden=true>&laquo;</span></a></li>');
          //    for (var i = 1; i <= numOfPages; i++) {
          //       $('#pag_nav ul').append('<li><a href=#>' + i + '</a></li>');
          //    }
          //    $('#pag_nav ul').append('<li class=next><a href=# aria-label=Previous><span aria-hidden=true>&raquo;</span></a></li>');
          // }

          // drawPagination(5);
      </script>

@endsection