@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main>
<!-- Modal advertising -->
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            <aside class="col-md-3">
               <div class="block block-nav">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Thông Tin</h4>
                  </div>
                  <div class="content">
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Tìm hiểu WeCareVN
                           </strong>
                        </dt>
                        @foreach($about_pages as $item)
                        <dd>
                           <a class="{{ Request::is($item->slug) ? 'current' : '' }}" href="{{$item->slug}}">          <i class="fa fa-angle-right"></i> {{$item->name}}
                           </a>      
                        </dd>
                        @endforeach
                        
                        <!-- <dd>
                           <a class="current" href="terms-conditions.html">          <i class="fa fa-angle-right"></i> Terms and Conditions
                           </a>      
                        </dd> -->
                     </dl>
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Chăm sóc khách hàng
                           </strong>
                        </dt>
                        <dd>
                           <a href="#">          <i class="fa fa-angle-right"></i> Warranty and Return
                           </a>      
                        </dd>
                        <dd>
                           <a href="#">          <i class="fa fa-angle-right"></i> Payment Methods
                           </a>      
                        </dd>
                        <dd>
                           <a href="#">          <i class="fa fa-angle-right"></i> International Shipping
                           </a>      
                        </dd>
                        <dd>
                           <a href="#">          <i class="fa fa-angle-right"></i> Shopping FAQ
                           </a>      
                        </dd>
                        <dd>
                           <a href="#">          <i class="fa fa-angle-right"></i> Legal Window
                           </a>      
                        </dd>
                     </dl>
                  </div>
               </div>
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="content text-center">
                     <p>
                        Need more help?<br>
                        Here is how to get in touch.
                     </p>
                     <a class="btn btn-warning btn-sm" href="contact.html">      Contact us <i class="fa fa-arrow-circle-o-right"></i>
                     </a>  
                  </div>
               </div>
            </aside>
            <article id="article" class="col-md-9">
               <h3 class="text-uppercase no-margin-top">
                  {{$page->name}}
               </h3>
               <?php
                  echo($page->content); 
               ?>
            </article>
         </div>
      </div>
   </section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript">
$('#article').children('img').each(function(){
    $(this).addClass('img-responsive');
  });
   $(document).ready(function(){
  $('#article').children('img').each(function(){
    $(this).addClass('img-responsive');
  });
});
</script>

@endsection