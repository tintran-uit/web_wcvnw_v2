@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('headInput')

<!-- Le styles -->
<style type="text/css">
   .profile_view {
    margin-bottom: 20px;
    display: inline-block;
    width: 100%;
        -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 1px 1px 0 rgba(0,0,0,0.3);
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 1px 1px 0 rgba(0,0,0,0.3);
}
.profile_view:hover {
    -webkit-box-shadow: 0 14px 12px 0 rgba(0,0,0,0.17),0 10px 20px 0 rgba(0,0,0,0.3);
    box-shadow: 0 14px 12px 0 rgba(0,0,0,0.17),0 10px 20px 0 rgba(0,0,0,0.3);    
}
.well.profile_view {
    padding: 10px 0 0;
}

.well.profile_view .divider {
    border-top: 1px solid #e5e5e5;
    padding-top: 5px;
    margin-top: 5px;
}

.well.profile_view .ratings {
    margin-bottom: 0;
}

.pagination.pagination-split li {
    display: inline-block;
    margin-right: 3px;
}

.pagination.pagination-split li a {
    border-radius: 4px;
    color: #768399;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}

.well.profile_view {
    background: #fff;
}

.well.profile_view .bottom {
    background: #F2F5F7;
    padding: 16px 0px 0px;
    border-top: 1px solid #E6E9ED;
}

.well.profile_view .left {
    margin-top: 20px;
}

.well.profile_view .left p {
    margin-bottom: 3px;
}

.well.profile_view .right {
    margin-top: 0px;
    padding: 10px;
}

.well.profile_view .img-circle {
    border: 1px solid #E6E9ED;
    padding: 2px;
}

.well.profile_view h2 {
    margin: 5px 0;
    font-size:14px;
    font-weight:bold;
}

.well.profile_view .ratings {
    text-align: left;
    font-size: 16px;
}

.well.profile_view .brief {
    margin: 0;
    font-weight: 300;
    margin-top: 5px;
}

.profile_left {
    background: white;
}

body .popover {
  max-width: 590px;
}

.popover-content >img {
  width: 100%;
}

</style>
@endsection
@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            <section class="col-sm-12 col-md-12 col-lg-12 text-center" style="margin-bottom: 8px"><h3 class="text-uppercase no-margin-top title-article">
                  Thông tin chuyển khoản 
               </h3></section>
            <section class="col-sm-6 col-md-6 col-lg-6">
               <article class="internal-padding wrap-radius bg-white style-post animated fadeInDown">
                     <div class="well profile_view bank_page">
                        <div class="image">
                            <img class="" alt="mua thực phẩm sạch online" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-vcb.png">
                        </div>
                        <div class="contentBank">
                            <h4 class="title">Ngân hàng Ngoại thương Việt Nam VietComBank - Chi nhánh Phan Đăng Lưu</h4>

                            <p>Tài khoản: <strong>Phan Dinh Vuong</strong><br>
                                Số tài khoản: <strong>0441000644128</strong></p>
                        </div>
                     </div>
               </article>
               
            </section>

            <section class="col-sm-6 col-md-6 col-lg-6">
               <article class="internal-padding wrap-radius bg-white style-post animated fadeInDown">
                     <div class="well profile_view bank_page">
                        <div class="image">
                            <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-hsbc.png">
                        </div>
                        <div class="contentBank">
                            <h4 class="title">Ngân hàng TNHH một thành viên HSBC Việt Nam - Chi nhánh Etown Tân Bình</h4>

                            <p>Tài khoản: <strong>Phan Dinh Vuong</strong><br>
                                Số tài khoản: <strong>001 680883 041</strong></p>
                        </div>
                     </div>
               </article>
               
            </section>

            <section class="col-sm-6 col-md-6 col-lg-6">
               <article class="internal-padding wrap-radius bg-white style-post animated fadeInDown">
                     <div class="well profile_view bank_page">
                        <div class="image">
                            <img class="" alt="Ngân hàng Ngoại thương Việt Nam - VietComBank - Hội sở" src="{{url('')}}/assets/images/icons/credit-cards/thanh-toan-paypal.png" style="margin-top: 10px">
                        </div>
                        <div class="contentBank">
                            <h4 class="title">Thanh toán Paypal (Dành cho khách hàng ngoài Việt Nam)</h4>

                            <p>Tài khoản: <strong>dinhvuong1206@gmail.com</strong><br></p><br>
                        </div>
                     </div>
               </article>
               
            </section>
            
         </div>
      </div>
   </section>
</main>
@endsection
@section('scrip_code')

@endsection
