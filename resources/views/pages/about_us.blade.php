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
            @include('layouts.menu_child')
            <article id="article" class="col-md-8">
               <h3 class="text-uppercase no-margin-top">
                  {{$page->name}}
               </h3>
               <p><strong>Văn phòng đại diện: </strong> 167 Trần Trọng Cung, Tân Thuận Đông, Quận 7, Hồ Chí Minh, Việt Nam</p>
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