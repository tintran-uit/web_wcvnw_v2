@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main class="bg-white">
  <section class="spacer-30">
    <div class="container">
      <h1 class="text-center spacer-bottom-30">BẠN CHƯA CÓ SẢN PHẨM NÀO TRONG GIỎ</h1>
      <div class="text-center spacer-30 shake animated">
        <div class="icon-alert">
          <img class="bg-super-light" alt="empty basket" src="assets/images/icons/icon-basket.png">
        </div>
      </div>
      <p class="text-center spacer-30">
        Tận dụng ưu đãi đặc biệt của chúng tôi và khám phá các sản phẩm <b>tốt cho sức khoẻ gia đình bạn.</b>
      </p>
      <div class="text-center spacer-top-10">
        <a class="btn btn-info btn-lg lg-2x" href="{{url('')}}">Mua hàng</a>
      </div>
    </div>
  </section>
  

  @include('layouts.banner_bottom')

</main>
@endsection

@section('scrip_code')


@endsection