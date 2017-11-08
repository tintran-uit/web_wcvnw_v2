@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')
<link href="{{url('')}}/packages/kartik-rate/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

<!-- optionally if you need to use a theme, then include the theme CSS file as mentioned below -->
<link href="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

<!-- important mandatory libraries -->
<script src="{{url('')}}/packages/kartik-rate/js/star-rating.js" type="text/javascript"></script>

<!-- optionally if you need to use a theme, then include the theme JS file as mentioned below -->
<script src="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.js"></script>

<!-- optionally if you need translation for your language then include locale file as mentioned below -->
<!-- <script src="{{url('')}}/packages/kartik-rate/js/locales/<lang>.js"></script> -->
@endsection


@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
          <aside class="col-sm-12 col-md-3">
            @include('layouts.menu_user')
          </aside>
            <article class="col-sm-12 col-md-9">
               <section class="spacer-bottom-15">
                <h4>
                  <strong>Xin chào: {{Auth::user()->name}}</strong>,
                </h4>
                <p>
                  Cảm ơn quý khách đã đồng hành cùng Cfam xây dựng cộng đồng nuôi trồng thực phẩm sạch và hữu cơ!
                </p>
              </section>
              <section class="row clearfix">
                      <div class="col-sm-6">
                        <div class="wrap wrap-border wrap-radius">
                          <div class="internal-box">
                            <div class="title clearfix">
                              <h5 class="no-margin pull-left">
                                <strong>Contact information</strong>
                              </h5>
                              <div class="pull-right">
                                    <a class="btn-link" href="#"><i class="fa fa-pencil"></i></a>                
                              </div>
                            </div>
                            <div class="content">
                              Stephanie Chung<br>
                              ianwatts@yahoo.com<br>
                              Tel.: +000 434549776880
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="wrap wrap-border wrap-radius">
                          <div class="internal-box">
                            <div class="title clearfix">
                              <h5 class="no-margin pull-left">
                                <strong>Default shipping address</strong>
                              </h5>
                              <div class="pull-right">
          <a class="btn-link" href="#">                        <i class="fa fa-pencil"></i>
          </a>                    </div>
                            </div>
                            <div class="content">
                              Lorenzo Hewitt<br>
                              <address class="no-margin">
                                21 Nursary Lane<br>
                                Stockport, Manchester, SK200PW<br>
                                Manchester
                              </address>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                      </article>
                   </div>
                   
                </div>
             </section>
   @include('layouts.banner_bottom')
</main>


@endsection

@section('scrip_code')


@endsection