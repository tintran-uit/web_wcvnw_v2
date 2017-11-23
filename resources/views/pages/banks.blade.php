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
            <aside class="col-sm-5 col-md-4 col-lg-3">
              <section class="single-block bg-white wrap-radius">
                  <div class="">
                     <!--icon-email, icon-discount, icon-shipping-->
                     <h4 class="title-box text-uppercase no-margin-top" style="">
                        QUY TRÌNH TUYỂN CHỌN LƯƠNG NÔNG <img class="img_nhanchungnhan" style="height: 25px; margin-left: 10px;" src="{{url('')}}/assets/images/icons/icon-tick.png">
                     </h4>
                     <a href="#" data-toggle="popover2" data-full="{{url('')}}/assets/images/banner/banner-nong-dan-san-suat-sach-cfarm.png">
                     <img class="img-responsive" src="{{url('')}}/assets/images/banner/banner-nong-dan-san-suat-sach-cfarm.png">
                   </a>
                     <div class="text-center">
                      <br>
                        <a class="btn btn-link no-margin" href="{{url('')}}/chinh-sach-lien-ket-nong-dan">CHI TIẾT</a>
                     </div>
                  </div>
               </section>
            </aside>
            <section class="col-sm-7 col-md-8 col-lg-6">
               <article class="internal-padding wrap-radius bg-white style-post animated fadeInDown">
                     <div class="well profile_view">
                        
                     </div>
               </article>
               
            </section>
            <aside class="col-lg-3 hidden-sm hidden-md">
               <section class="wrap wrap-border internal-padding bg-white wrap-radius">
                  <h4 class="text-center no-margin-top spacer-bottom-10">Hình ảnh thực tế nông trại</h4>
                  <div class="row clearfix frame-photo">
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_1.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_1.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_2.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_2.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_3.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_3.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_4.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_4.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_5.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_5.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_6.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_6.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_7.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_7.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_8.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_8.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_9.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_9.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_10.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_10.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_11.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_11.jpg">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-6">
                        <div class="spacer-bottom-10">
                           <!--Image width and hight should be the same -->
                           <div class="shadow-wrap-box bg-white photo-frame">
                              <a href="#" data-toggle="popover" data-full="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_12.jpg">    <img class="img-responsive" alt="img" src="{{url('')}}/uploads/anh-thuc-te/nong_trai_sach_cfarm_12.jpg">
                              </a>
                           </div>
                        </div>
                     </div>

                  </div>
               </section>
            </aside>
         </div>
      </div>
   </section>
</main>
@endsection
@section('scrip_code')

@endsection
