<html lang="en" style="height: auto;">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="sfwFlbK5GFdti0Lxar3GFMI2YrO6dbbMlGELLYFN">
      <title>
         Farmer :: Cfarm Admin Admin
      </title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="{{url('')}}/vendor/adminlte/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="{{url('')}}/vendor/adminlte/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{url('')}}/vendor/adminlte/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="{{url('')}}/vendor/adminlte/plugins/pace/pace.min.css">
      <link rel="stylesheet" href="{{url('')}}/vendor/backpack/pnotify/pnotify.custom.min.css">
      <!-- BackPack Base CSS -->
      <link rel="stylesheet" href="{{url('')}}/vendor/backpack/backpack.base.css">
      <!-- DATA TABLES -->
      <link href="{{url('')}}/vendor/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{url('')}}/vendor/backpack/crud/css/crud.css">
      <link rel="stylesheet" href="{{url('')}}/vendor/backpack/crud/css/form.css">
      <link rel="stylesheet" href="{{url('')}}/vendor/backpack/crud/css/list.css">
      <!-- CRUD LIST CONTENT - crud_list_styles stack -->
      <link href="{{url('')}}/assets/stylesheets/all.css" rel="stylesheet" type="text/css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="skin-black sidebar-mini  pace-done" style="height: auto;">
      <div class="pace  pace-inactive">
         <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
            <div class="pace-progress-inner"></div>
         </div>
         <div class="pace-activity"></div>
      </div>
      <!-- Site wrapper -->
      <div class="wrapper" style="height: auto;">
         <header class="main-header">
            <!-- Logo -->
            <a href="{{url('')}}" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>L</b>E</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>Cfarm</b> Farmer</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </a>
               <div class="navbar-custom-menu pull-left">
                  <ul class="nav navbar-nav">
                     <!-- =================================================== -->
                     <!-- ========== Top menu items (ordered left) ========== -->
                     <!-- =================================================== -->
                     <!-- <li><a href="{{url('')}}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
                     <!-- ========== End of top menu left items ========== -->
                  </ul>
               </div>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- ========================================================= -->
                     <!-- ========== Top menu right items (ordered left) ========== -->
                     <!-- ========================================================= -->
                     <!-- <li><a href="{{url('')}}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
                     <li><a href="{{url('')}}/admin/logout"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                     <!-- ========== End of top menu right items ========== -->
                  </ul>
               </div>
            </nav>
         </header>
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar" style="height: auto;">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="https://placehold.it/160x160/00a65a/ffffff/&amp;text=T" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p>{{Auth::user()->name}}</p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Đã Đăng Nhập</a>
                  </div>
               </div>
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu">
                  <li class="header">ADMINISTRATION</li>
                  <!-- ================================================ -->
                  <!-- ==== Recommended place for admin menu items ==== -->
                  <!-- ================================================ -->
                  <li><a href="{{url('')}}/admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                  <!-- StakeHolders -->
                  <li class="treeview active">
                     <a href="#"><i class="fa fa-database"></i> <span>Quản Lý Vận Hành</span> <i class="fa fa-angle-left pull-right"></i></a>
                     <ul class="treeview-menu">
                        <li><a href="{{url('')}}/admin/agent-item"><i class="fa fa-user-o"></i> <span>Đại Lý</span></a></li>
                        <li><a href="{{url('')}}/admin/shipper-item"><i class="fa fa-address-card"></i> <span>Giao Hàng</span></a></li>
                     </ul>
                  </li>
                  <!-- Users, Roles Permissions -->
                  <!-- ======================================= -->
                  <li class="header">USER</li>
                  <li><a href="{{url('')}}/admin/logout"><i class="fa fa-sign-out"></i> <span>Đăng Xuất</span></a></li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper" style="min-height: 673px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <h1>
                  <span class="text-capitalize">Farmer</span>
                  <small>All  <span>Farmer</span> in the database.</small>
               </h1>
               <ol class="breadcrumb">
                  <li><a href="{{url('')}}/admin/dashboard">Admin</a></li>
                  <li><a href="{{url('')}}/admin/order" class="text-capitalize">Farmer</a></li>
                  <li class="active">List</li>
               </ol>
            </section>
            <!-- Main content -->
            <section class="content">
               <!-- Default box -->
               <div class="row">
                  <!-- THE ACTUAL CONTENT -->
                  <div class="col-md-12">
                     <div class="box">
                     </div>
                     <!-- /.box -->
                  </div>
               </div>
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <div class="pull-right hidden-xs">
               Powered by <a target="_blank" href="{{url('')}}">Cfarm</a>
            </div>
            Handcrafted by <a target="_blank" href="{{url('')}}">Technical Team</a>.
         </footer>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.2.0 -->
      <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
      <script>window.jQuery || document.write('<script src="{{url('')}}/vendor/adminlte/plugins/jQuery/jQuery-2.2.0.min.js"><\/script>')</script>
      <!-- Bootstrap 3.3.5 -->
      <script src="{{url('')}}/vendor/adminlte/bootstrap/js/bootstrap.min.js"></script>
      <script src="{{url('')}}/vendor/adminlte/plugins/pace/pace.min.js"></script>
      <script src="{{url('')}}/vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="{{url('')}}/vendor/adminlte/plugins/fastclick/fastclick.js"></script>
      <script src="{{url('')}}/vendor/adminlte/dist/js/app.min.js"></script>
      <!-- page script -->
      <script type="text/javascript">
         // To make Pace works on Ajax calls
         $(document).ajaxStart(function() { Pace.restart(); });
         
         // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
         $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
         
         // Set active state on menu element
         var current_url = "{{url('')}}/admin/order";
         $("ul.sidebar-menu li a").each(function() {
           if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')))
           {
             $(this).parents('li').addClass('active');
           }
         });
      </script>
      <script src="{{url('')}}/vendor/backpack/pnotify/pnotify.custom.min.js"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
         
           PNotify.prototype.options.styling = "bootstrap3";
           PNotify.prototype.options.styling = "fontawesome";
         
             });
      </script>
      <!-- DATA TABLES SCRIPT -->
      <script src="{{url('')}}/vendor/adminlte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
      <script src="{{url('')}}/vendor/backpack/crud/js/crud.js"></script>
      <script src="{{url('')}}/vendor/backpack/crud/js/form.js"></script>
      <script src="{{url('')}}/vendor/backpack/crud/js/list.js"></script>
      <script src="{{url('')}}/vendor/adminlte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
         
            
         	var table = $("#crudTable").DataTable({
              "pageLength": 25,
              /* Disable initial sort */
              "aaSorting": [],
              "language": {
                    "emptyTable":     "No data available in table",
                    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty":      "Showing 0 to 0 of 0 entries",
                    "infoFiltered":   "(filtered from _MAX_ total entries)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "_MENU_ records per page",
                    "loadingRecords": "Loading...",
                    "processing":     "Processing...",
                    "search":         "Search: ",
                    "zeroRecords":    "No matching records found",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Next",
                        "previous":   "Previous"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    },
                    "buttons": {
                        "copy":   "Copy",
                        "excel":  "Excel",
                        "csv":    "CSV",
                        "pdf":    "PDF",
                        "print":  "Print",
                        "colvis": "Column visibility"
                    },
                },
         
                
                      });
         
            
            $.ajaxPrefilter(function(options, originalOptions, xhr) {
                var token = $('meta[name="csrf_token"]').attr('content');
         
                if (token) {
                      return xhr.setRequestHeader('X-XSRF-TOKEN', token);
                }
            });
         
            // make the delete button work in the first result page
            register_delete_button_action();
         
            // make the delete button work on subsequent result pages
            $('#crudTable').on( 'draw.dt',   function () {
               register_delete_button_action();
         
                     } ).dataTable();
         
            function register_delete_button_action() {
              $("[data-button-type=delete]").unbind('click');
              // CRUD Delete
              // ask for confirmation before deleting an item
              $("[data-button-type=delete]").click(function(e) {
                e.preventDefault();
                var delete_button = $(this);
                var delete_url = $(this).attr('href');
         
                if (confirm("Are you sure you want to delete this item?") == true) {
                    $.ajax({
                        url: delete_url,
                        type: 'DELETE',
                        success: function(result) {
                            // Show an alert with the result
                            new PNotify({
                                title: "Item Deleted",
                                text: "The item has been deleted successfully.",
                                type: "success"
                            });
                            // delete the row from the table
                            delete_button.parentsUntil('tr').parent().remove();
                        },
                        error: function(result) {
                            // Show an alert with the result
                            new PNotify({
                                title: "NOT deleted",
                                text: "There&#039;s been an error. Your item might not have been deleted.",
                                type: "warning"
                            });
                        }
                    });
                } else {
                    new PNotify({
                        title: "Not deleted",
                        text: "Nothing happened. Your item is safe.",
                        type: "info"
                    });
                }
              });
            }
         
         
            
         
         });
      </script>
      <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
      <!-- JavaScripts -->
   </body>
</html>