@extends('layouts.farmer')

@section('content')
<div class="box-header with-border">
    <h3>THÔNG KÊ MẶT HÀNG TRONG TUẦN</h3>
</div>

<div class="box-body table-responsive">
    <ul class="nav nav-tabs">
        <?php $i = 0;?>
        @foreach($farmers as $farmer)
            @if($i==0)
            <li class="active"><a data-toggle="tab" href="#menu{{$i}}">{{$farmer->name}}</a></li>
            @else
            <li><a data-toggle="tab" href="#menu{{$i}}">{{$farmer->name}}</a></li>
            @endif
            <?php $i++;?>
        @endforeach
      </ul>

      <div class="tab-content">
        <?php 
            $i = 0; 
        ?>
        @foreach($products as $product)
          @if($i==0)

            <div id="menu{{$i}}" class="tab-pane fade in active">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Đóng gói</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product->items as $item)
                      <tr>
                        <td style="width: 30%">
                            <div>* Sản phẩm: {{$item['full_name']}}
                                <br><span style="margin-left: 10px">- Số lượng: {{$item['take_in']}} {{$item['unit']}}</span>
                                
                            </div>
                        </td>
                        <td>
                            <span style="margin-left: 10px">- Đóng gói: {{$item['count_pack']}} phần</span>
                                @foreach($item['pack'] as $key => $value)
                                    <br><span style="margin-left: 30px">+ {{$key}}: {{$value}} phần</span>
                                @endforeach
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>

          @else
            <div id="menu{{$i}}" class="tab-pane fade">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Đóng gói</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product->items as $item)
                      <tr>
                        <td style="width: 30%">
                            <div>* Sản phẩm: {{$item['full_name']}}
                                <br><span style="margin-left: 10px">- Số lượng: {{$item['take_in']}} {{$item['unit']}}</span>
                                
                            </div>
                        </td>
                        <td>
                            <span style="margin-left: 10px">- Đóng gói: {{$item['count_pack']}} phần</span>
                                @foreach($item['pack'] as $key => $value)
                                    <br><span style="margin-left: 30px">+ {{$key}}: {{$value}} phần</span>
                                @endforeach
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
          @endif
        <?php $i++;?>
        @endforeach
      </div>

</div>
@endsection