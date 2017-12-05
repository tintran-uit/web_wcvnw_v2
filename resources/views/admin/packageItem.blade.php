@extends('layouts.admin')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
    tr td:nth-child(4), td:nth-child(5), td:nth-child(8), td:nth-child(9) {
        background-color: #00CC00;
    }

    tr th:nth-child(4), th:nth-child(5), th:nth-child(8), th:nth-child(9) {
        background-color: #00CC00;
    }

    tr td:nth-child(6), td:nth-child(7), td:nth-child(10), td:nth-child(11) {
        background-color: #990000;
        color: #fff;
    }
    tr th:nth-child(6), th:nth-child(7), th:nth-child(10), th:nth-child(11) {
        background-color: #990000;
        color: #fff;
    }
</style>
@endsection

@section('main')

<div class="box-header with-border">
    <h3>SOẠN GÓI</h3>
</div>

<div class="box-body table-responsive">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Trading</th>
                <th>Tên sản phẩm</th>
                <th>Giá ĐV</th>
                <th>SL gói 1</th>
                <th>Giá gói 1</th>
                <th>SL gói 2</th>
                <th>Giá gói 2</th>
                <th>SL gói 3</th>
                <th>Giá gói 3</th>
                <th>SL gói 4</th>
                <th>Giá gói 4</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div>
<!-- /.box-body -->

@endsection

@section('script')
<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/datatables/dataTables.checkboxes.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
   var table = $('#example').DataTable({
      'ajax': '/api/admin/package-item',
      'columns': [
                    { 'data': 'checked',
                        'checkboxes': {
                           'selectRow': true
                        } 
                    },
                    { "data": "name" },
                    { "data": "price" },
                    { "data": "quantity_p1" },
                    { "data": "price_p1" },
                    { "data": "quantity_p2" },
                    { "data": "price_p2" },
                    { "data": "quantity_p3" },
                    { "data": "price_p3" },
                    { "data": "quantity_p4" },
                    { "data": "price_p4" },
                    { "data": "farmer_id" },
                    { "data": "product_id" },
                    { "data": "unit_quantity" },
                    { "data": "unit" },
                    { "data": "category" },
                ],
      'columnDefs': [
         {
           'targets': 0,
           'searchable':false,
           'orderable':false,
           'className': 'dt-body-center',
           'render': function (data, type, full, meta){
                if(data==0){
                    return '<input type="checkbox" name="checked" value="' + $('<div/>').text(data).html() + '">';
                }else{
                    return '<input type="checkbox" name="checked" value="' + $('<div/>').text(data).html() + '" checked="checked">';
                }
           }
        },
        {
            "targets": [ 11 ],
            "visible": false
        },
        {
            "targets": [ 12 ],
            "visible": false
        },
        {
            "targets": [ 13 ],
            "visible": false
        },
        {
            "targets": [ 14 ],
            "visible": false
        },
        {
            "targets": [ 15 ],
            "visible": false
        }
      ],
      'select': {
         'style': 'multi',
         'selector': 'td:not(:first-child)'
      },
      'order': [[1, 'asc']],
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            checked = api
                .column( 0 )
                .data()
                .reduce( function (a, b) {
                    return b;
                }, 0 );

            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    if(checked==1){
                    return intVal(a) + intVal(b);
                    }
                }, 0 );
            console.log(checked);

            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                total
            );
        }
   });

   table.on( 'click', 'tbody td', function () {
        // var idx = table.cell( this ).index().row;
        // var data = table.cells( idx, '' ).render( 'display' );
     
        // console.log( idx );
        var row = $(this).closest('tr').index();
        table.cell(row, 4).data('4').draw();
    } );
   
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;
      
      var rows_selected = table.column(0).checkboxes.selected();

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY
      // The code below is not needed in production
      
      // Output form data to a console     
      $('#example-console-rows').text(rows_selected.join(","));
      
      // Output form data to a console     
      $('#example-console-form').text($(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });   
}); 
</script>
@endsection