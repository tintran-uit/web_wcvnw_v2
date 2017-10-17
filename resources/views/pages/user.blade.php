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
                     <h4 class="text-uppercase no-margin">Thông Tin cá nhân</h4>
                  </div>
                  <div class="content">
                     <dl class="list-unstyled">
                        
                        <dd>
                           <a class="{{ Request::is('user/rate') ? 'current' : '' }}" href="{{url('')}}/user/rate">{{ trans('head.rate') }}</a>     
                        </dd>
                        
                        <!-- <dd>
                           <a class="current" href="terms-conditions.html">          <i class="fa fa-angle-right"></i> Terms and Conditions
                           </a>      
                        </dd> -->
                     </dl>
                     
                  </div>
               </div>
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="text-center" id="fanpageFB">
                     <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>  
                  </div>
               </div>
            </aside>
            <article id="article" class="col-md-8">
               <h3 class="text-uppercase no-margin-top">
               </h3>
               
            </article>
         </div>
      </div>
   </section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript">

   
</script>

@endsection