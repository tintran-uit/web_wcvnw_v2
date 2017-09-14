@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main>
  <div id="fb-root" class=" fb_reset fb_reset"><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=f28c7fa749f3e3&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=f28c7fa749f3e3&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div><iframe name="fb_xdm_frame_http" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="http://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=fe4936fbed70ec&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe><iframe name="fb_xdm_frame_https" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tabindex="-1" src="https://staticxx.facebook.com/connect/xd_arbiter/r/XBwzv5Yrm_1.js?version=42#channel=fe4936fbed70ec&amp;origin=http%3A%2F%2Flocalhost%3A8000" style="border: none;"></iframe></div></div><div style="position: absolute; top: -10000px; height: 0px; width: 0px;"><div></div></div></div>
    
  <section>
    <section class="product-details spacer-20">
      <div class="container">
        <div class="row">
          <article class="col-sm-4 col-md-5">
            <section class="wrap internal-padding wrap-border wrap-radius bg-white">
              <div class="">
                <img class="img-responsive big-img center-block" alt="product" src="http://product.hstatic.net/1000141988/product/upload_6a9e61e9b5484214a282855b8d9ddced_large.jpg">
                
              </div>
              <div class="icon-shipping"> <!--icon-email, icon-discount, icon-shipping-->
  <h4 class="title-box text-uppercase no-margin-top">
    GIAO HÀNG TẬN NƠI
  </h4>
  <p class="copy-box no-margin">
    Miễn phí giao hàng cho đơn hàng trên 500.000 VNĐ.
  </p>
</div>

            </section>

          </article>
          <article class="col-sm-8 col-md-7">
            <section class="wrap internal-padding wrap-radius bg-white">
<form action="#" accept-charset="UTF-8" id="product_addtocart_form" method="post">                <h2 class="title-box no-margin">
                  {{$product[0]->name}}
                </h2>
                <br>
                <p class="copy-box no-margin">
                  Mỗi miếng tầm: 200 - 300gram. + Thịt đông lạnh ngay sau khi giết mổ.------------------------------------+ ĐẠT TIÊU CHUẨN HỮU CƠ CỦA HIỆP HỘI HỮU CƠ CANADA+ Từ Nông Trại Ausfarm...
                </p>
                <div class="product-options">
                  <section class="choose">
                    <h5 class="col-sm-12">
                      <b>Chọn nông trại cung cấp:</b>
                    </h5>
                    <article class="col-sm-12">
                        
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
                        
                    </article>
                  </section>
                  <section class="choose">
                    <div class="col-sm-2 vcenter">
                    <h5 class="">
                      <b>Số lượng:</b>
                    </h5>
                    </div>
                    <div class="stepper col-sm-5 vcenter"><input type="number" class="form-control stepper-input" id="stepper" value="1" min="1" max="20" step="1"><span class="stepper-arrow up" onclick="stepperUp()">Up</span><span class="stepper-arrow down" onclick="stepperDown()">Down</span></div>
                  </section>
                  <section>
                    <div class="row">
                      <article class="col-sm-7 button-group">
                        <a class="btn btn-primary btn-lg lg-2x" onclick="addCart()">
                          ADD TO CART <i class="glyphicon glyphicon-shopping-cart"></i>
                        </a>
<a class="btn btn-info btn-lg" href="#">                          <i class="fa fa-heart"></i>
</a>                  </article>
                      <article class="col-sm-5">
                        <div class="clearfix product-price"> 
                          <p class="discounted-price pull-left">
                            {{number_format($product[0]->price)}} VND
                          </p>
                        </div>
                      </article>
                    </div>
                  </section>
                </div>
                <div class="text-center">
                  <i class="glyphicon glyphicon-option-horizontal"></i>
                </div>
</form>              <section>
                
              </section>
            </section>
          </article>
          <!-- chi tiet -->
          <article class="col-sm-12 col-md-12" style="margin-top:-60px">
            <ul class="product-tabs">
                  <li class=" active first"><a href="#product_tabs_description_contents" data-toggle="pill">Chi tiết sản phẩm</a>
                  </li>
                  
                  <li class=""><a href="#product_tabs_product_additional_data_contents" data-toggle="pill"></a>
                  </li>
                  
                  
                  <li class=" last"><a href="#product_tabs_product_tags_contents" data-toggle="pill"></a>
                  </li>
                  
                </ul>
            <section class="wrap internal-padding wrap-border wrap-radius bg-white">
                <article>
                   <h3 class="text-uppercase no-margin-top">
                      Về chúng tôi
                   </h3>
                   <p>Thực phẩm bẩn trong tôi đã trở thành một nỗi ám ảnh thường trực. Tháng 4/2016, tôi bắt đầu dự án đầu tiên của mình về GREEN (sạch), đó là một trang trại toàn diện nhỏ, cung ứng&nbsp;<a href="http://trangtraitrungthuc.com/"><strong>thực phẩm sạch</strong></a>&nbsp;cơ bản cho 50-100 hộ gia đình, quy mô 3 tấn&nbsp;<a href="http://trangtraitrungthuc.com/">rau sạch&nbsp;</a>/tháng, 300 con gà, 100 con lợn và 5 tạ cá. Tôi mong muốn mỗi người dân Việt Nam sẽ được sử dụng những thực phẩm, vật phẩm, trang thiết bị, đồ dùng thực sự sạch.</p>

                  <p><img alt="" src="http://localhost:8000/uploads/1402088_993182534032142_8516326759306743892_o.jpg" style="height: auto; width: 548px;" class="img-responsive"></p>

                  <p>Và đó cũng chính là lý do tôi xây dựng nên Trang Trại Trung Thực. Tiêu chí của chúng tôi là mỗi sản phẩm được bán ra sẽ có nguồn gốc rõ ràng, được nuôi, trồng bằng những nguồn thức ăn sạch, không sử dụng chất bảo quản, các loại hoá chất độc hại, thuốc trừ sâu, có kiểm định rõ ràng về chất lượng, đảm bảo không độc hại.</p>

                  <p>Để đạt được những tiêu chí trên, trong tháng 4-5/2016, tôi đã đi thăm quan và học tập ở rất nhiều các trang trại khắp miền Bắc, miền Nam Việt Nam, cuối cùng, tôi quyết định chọn mô hình về một trang trại toàn diện, tự cung tự cấp. Cái gốc và xuất phát điểm tự cung tự cấp của trang trại sẽ là con giun quế. Giun quế là một loại giun có tốc độ sinh trưởng nhanh, có hàm lượng đạm cực cao, cao hơn cả cá biển. Và giun quế có thể sử dụng để làm nguồn thức ăn để nuôi gà, nuôi cá, lợn. Ngoài ra, phân của giun quế là loại phân vi sinh rất tốt cho cây trồng. Sử dụng phân giun quế sẽ có hàm lượng chất dinh dưỡng trong cây tốt, tránh được việc sử dụng các loại phân hoá học đang bán trên thị trường. Giun quế giống được nuôi ở Trang Trại Trung Thực có nguồn gốc từ châu Phi.</p>

                  <p>Để xử lý môi trường, tôi đã tìm hiểu và quyết định xây hệ thống biogas. Toàn bộ chất thải từ lợn, gà sẽ được lắng qua bể lắng và đưa xuống hầm biogas. Hầm biogas sẽ sinh ra năng lượng đủ để nấu cám thức ăn cho gà, lợn và các nhu cầu chế biến thiết yếu khác của trang trại.</p>
            </article>
            </section>
          </article>
        </div>
      </div>
    </section>
  </section>
  <section class="purchase-benefits spacer-30 bg-extra-light-grey">
  <div class=" spacer-10">
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

</main>

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
                     <h4 class="modal-title fa fa-exclamation-triangle" id="modalMessage"></h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection

@section('scrip_code')

<script type="text/javascript">
var cou
loadsuppliers();

function loadsuppliers() {
  jQuery("#tbSupp tbody").empty();
  var id = {{$product[0]->id}};
  var url = '/api/products/suppliers/product_id='+id;
  $.ajaxSetup({ cache: false });
  $.getJSON(url, function(data){
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
     }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
         alert("Vui lòng kiểm tra kết nối internet.");
     });

  // setTimeout(loadsuppliers, 45000);
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

function addCart() {
  var id = "{{$product[0]->id}}";
  var qty = document.getElementById('stepper').value;
  var farmerID = $('input[name="farmerID"]:checked').val();;
  console.log(farmerID);
  var data = { "id": id, "qty": qty , 'farmerID':farmerID};
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
              $('#modalMessage').html(data.message);
              $('#modalAlert').modal('show');
            }else{
              updateCartStatus(data);
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
}
   
</script>

@endsection