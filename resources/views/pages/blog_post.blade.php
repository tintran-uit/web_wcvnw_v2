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
                        <dt style="margin-top: 6px;">
                          <a class="current" href="terms-conditions.html">  
                           <i class="fa fa-angle-right"></i> Góc nhà bếp
                         </a>
                        </dt>
                        <dt>
                          <a class="" href="terms-conditions.html">  
                           <i class="fa fa-angle-right"></i> Ẩm thực & Sức khỏe
                         </a>
                        </dt><dt>
                          <a class="" href="terms-conditions.html">  
                           <i class="fa fa-angle-right"></i> Câu chuyện nhà nông
                         </a>
                        </dt>
                        
                        <!-- <dd>
                           <a class="current" href="terms-conditions.html">          <i class="fa fa-angle-right"></i> Terms and Conditions
                           </a>      
                        </dd> -->
                     </dl>
                     
                  </div>
               </div>
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="content text-center">
                     <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>  
                  </div>
               </div>
            </aside>
            <aside id="article" class="col-md-9">
              <div class="row clearfix">
                  <article class="wrap wrap-border internal-padding wrap-radius bg-white style-post">
    <div class="row clearfix">
        <div class="col-xs-8">
            <h4 class="no-margin-top">
                Middle aligned media
            </h4>
        </div>
        <div class="col-xs-4">
            <time class="pull-right">
        <b>
          Tue Apr 04, 1995
        </b>
      </time>
        </div>
    </div>
    <div class="spacer-bottom-10">
        <figure class="spacer-bottom-10 text-center">
            <img class="img-responsive" alt="post" src="{{url('')}}/assets/images/photo/photo6.png">
        </figure>
        <p class="copy">
            Neque ea beatae adipisci sit et alias rerum sit. Sed nostrum voluptas nisi vel tempora eos veniam. Incidunt non commodi dolore quasi quia mollitia voluptatibus. Modi voluptatem inventore quos. Inventore velit nihil dolor quisquam est similique. Non eos earum aut ut totam vitae autem voluptatem quam velit dolorem deserunt incidunt. Et cumque voluptatem perferendis sed illum saepe sint. Sapiente vitae natus explicabo id voluptas est laborum quibusdam necessitatibus voluptas. Neque est quos vero iure quis rerum pariatur. Dolor modi occaecati dolor est corporis aut
        </p>
    </div>
    <!-- <div class="clearfix">
        <div class="pull-left">
            <div class="socials">

                <a class="btn-social btn-facebook smaller" href="http://www.facebook.com/share.php?u=http://www.kidstore.com">  <i class="fa fa-facebook fa-1x"></i></a>

                <a class="btn-social btn-twitter smaller" href="http://twitter.com/share?text=Lorem%20ipsum%20dolorem&amp;url=http://www.kidstore.com">  <i class="fa fa-twitter fa-1x"></i></a>

                <a class="btn-social btn-pinterest smaller" href="http://pinterest.com/pin/create/button/?url=http://www.kidstore.com&amp;media=http://www.kidstore.com/images/img.jpg&amp;description=Lorem%20ipsum%20dolorem">  <i class="fa fa-pinterest fa-1x"></i></a>

                <a class="btn-social btn-google smaller" href="https://plus.google.com/share?url=http://www.kidstore.com">  <i class="fa fa-google fa-1x"></i></a>

                <a class="btn-social btn-linkedin smaller" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.kidstore.com&amp;title=lorem%20ipsum&amp;summary=Lorem%20ipsum%20dolorem">  <i class="fa fa-linkedin fa-1x"></i></a>
            </div>

        </div>
        <div class="pull-right spacer-top-10">
            <a class="btn-link" href="comments.html">View Comments</a>
        </div>
    </div> -->

</article>
              </div>
            </aside>
         </div>
      </div>
   </section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript">

   $(document).ready(function(){
     $('#article').children('p').children('img').each(function(){
       $(this).addClass('img-responsive');
       $(this).css("height", "auto");
     });
     $('#article').children('img').each(function(){
       $(this).addClass('img-responsive');
       $(this).css("height", "auto");
     });
   });
</script>

@endsection