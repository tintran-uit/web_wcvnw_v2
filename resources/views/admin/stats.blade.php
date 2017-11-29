@extends('layouts.admin')

@section('css')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', beforeShowDay: function(date){
          if(date.getDay() == 6 || date.getDay() == 5){
                return [true];
            } else {
                return [false];
            }
        } });
  } );
  </script>
@endsection

@section('main')

<div class="box-header with-border">
    <h3>THÔNG KÊ MẶT HÀNG</h3>
    <div class="">
        <div class="col-md-1 vcenter">
            <a class="btn btn-primary ladda-button" onclick="stats()">Thống kê</a>
        </div>  
        <div class="col-md-5 vcenter">
            <b>Chọn tuần: </b><input type="text" value="" id="datepicker">
        </div>
        
    </div>
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
            $farmer_name = array_keys($products);
        ?>
        @foreach($products as $product)
          @if($i==0)

            <div id="menu{{$i}}" class="tab-pane fade in active">
                <h4><b><?php echo(key($products));?></b></h4>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Đóng gói</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $item)
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
                <h4><b><?php echo($farmer_name[$i]);?></b></h4>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Đóng gói</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $item)
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
<!-- /.box-body -->

@endsection

@section('script')
<script type="text/javascript">
    function stats() {
        var date = $('#datepicker').val();
        window.location.href = "{{url('')}}/admin/order-stats/date="+date;
    }
</script>
@endsection