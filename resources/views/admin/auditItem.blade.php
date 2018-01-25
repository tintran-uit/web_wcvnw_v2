@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.3/css/select.dataTables.min.css">
<style type="text/css">
    tr td:nth-child(6) {
        font-weight: bold;
    }
</style>
@endsection

@section('main')

<div class="box-header with-border">
    <h3>Sản phẩm order</h3>
</div>

<div class="box-body table-responsive">
    <table id="audit" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Người nhận</th>
                <th>SĐT</th>
                <th>Tên sản phẩm</th>
                <th>SL đặt</th>
                <th>SL thực tế</th>
                <th>Đơn vị</th>
                <th>Ngày giao hàng</th>
                <th></th>
            </tr>
        </thead>
    </table>

</div>
<!-- /.box-body -->

@endsection

@section('script')
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.3/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/datatables/dataTables.altEditor.free.js"></script>

<script type="text/javascript">
    var audit_editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    audit_editor = new $.fn.dataTable.Editor( {
        ajax: "/api/admin/audit-items",
        table: "#audit",
        fields: [ {
                label: "Mã Trang Trại:",
                name: "farmer_id"
            }, {
                label: "Mã Trang Trại:",
                name: "farmer_name"
            }, {
                label: "Số điện thoại:",
                name: "farmer_phone"
            }, {
                label: "Tên sản phẩm:",
                name: "product_name"
            },{
                label: "SL đặt:",
                name: "order_quantity"
            }, {
                label: "SL thực tế:",
                name: "quantity"
            }, {
                label: "Đơn vị:",
                name: "unit"
            }, {
                label: "Ngày giao hàng:",
                name: "delivery_date",
                type: "date",
                dateFormat: $.datepicker.ISO_8601
            }, {
                label: "ID:",
                name: "product_id"
            }
        ]
    } );
 
    // Activate an inline edit on click of a table cell
    $('#audit').on( 'click', 'tbody td:nth-child(6)', function (e) {
        audit_editor.inline( this, {
            submit: 'allIfChanged'
        } );
    } );

    $('#audit').DataTable( {
        dom: "Bfrtip",
        ajax: "/api/admin/audit-items",
        order: [[ 1, 'asc' ]],
        columns: [
            { data: "order_id" },
            { data: "delivery_name" },
            { data: "delivery_phone" },
            { data: "product_name" },
            { data: "order_quantity" },
            { data: "quantity" },
            { data: "unit"},
            { data: "delivery_date" },
            { data: "product_id" }
        ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            
        ],
        columnDefs: [
            {   
                "targets": [ 8 ],
                "visible": false 
            }
          ]
    } );

} );
</script>
@endsection