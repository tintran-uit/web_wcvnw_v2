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
               @include('layouts.menu_blog')
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="text-center">
                     <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>  
                  </div>
               </div>
            </aside>
            <aside id="article" class="col-md-9">
              <div class="row clearfix">
                  <article class="wrap wrap-border internal-padding wrap-radius bg-white style-post">
    <div class="row clearfix">
        <div class="col-xs-8">
            <h3 class="no-margin-top title-article" style="">
                {{$article->title}}
            </h3>
        </div>
        <div class="col-xs-4">
            <time class="pull-right">
        <b>
          {{$article->date}}
        </b>
      </time>
        </div>
    </div>
    <div class="spacer-bottom-10">
        
            <?php echo $article->content; ?>
    </div>
  

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