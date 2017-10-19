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
            <article id="article" class="col-md-8 wrap wrap-border internal-padding wrap-radius bg-white style-post">
               <h3 class="text-uppercase no-margin-top title-article">
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

   
</script>

@endsection