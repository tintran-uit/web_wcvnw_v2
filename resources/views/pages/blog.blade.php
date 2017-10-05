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
                     <h4 class="text-uppercase no-margin">Góc kinh nghiệm</h4>
                  </div>
                  <div class="content" style="padding-top: 10px;">
                     <dl class="list-unstyled">
                        <dd>
                          <a class="current">
                           <strong>
                           <i class="fa fa-angle-right"></i> Kiến thức tiêu dùng an toàn
                           </strong>
                         </a>
                        </dd>
                        <dd>
                          <a>
                           <strong>
                           <i class="fa fa-angle-right"></i> Kiến thức nuôi trồng sạch
                           </strong>
                         </a>
                        </dd>
                        <dd>
                          <a>
                           <strong>
                           <i class="fa fa-angle-right"></i> Kiến thức nuôi trồng sạch
                           </strong>
                         </a>
                        </dd>
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

                @foreach($articles as $article)
                <article class="col-md-6">
                       <div class="wrap wrap-border internal-padding wrap-radius bg-white style-post">
                            <div class="row clearfix">
                              <div class="col-xs-12">
                                <h4 class="media-heading">
                                  <a class="btn-link" href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/post_id=1">{{$article->title}}</a>
                                </h4>
                              </div>
                              <!-- <div class="col-xs-4">
                                <time class="pull-right">
                                  <b>
                                    Sat Aug 30, 2003
                                  </b>
                                </time>
                              </div> -->
                            </div>
                            <div class="media spacer-bottom-10">
                              <div class="media-left media-top">
                          <a href="{{url('')}}/kinh-nghiem-mua-thuc-pham-sach/post_id=1">        <img class="small-img" alt="post" src="http://placehold.it/300x400">
                          </a>    </div>
                              <div class="media-body">
                                <p class="copy">
                                  <?php 
                                      $intro = strip_tags($article->content);
                                      $intro = substr($intro, 0, 320);
                                      echo $intro.'...'; 
                                  ?>
                                  <a class="btn-link" href="#">[Chi tiết]</a>
                                </p>
                              </div>
                            </div>
                            <div class="row clearfix">
                              <div class="col-xs-8">
                                <span>Tag: </span>
                                <a class="btn-link" href="#">exercitationem</a>,
                                <a class="btn-link" href="#">unde</a>,
                                <a class="btn-link" href="#">vel</a>
                              </div>
                              <div class="col-xs-4">
                                <div class="pull-right like">
                                  <span>10</span> <i class="fa fa-heart"></i>
                                </div>
                              </div>
                            </div>
                      </div>
                </article>
                @endforeach
             
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