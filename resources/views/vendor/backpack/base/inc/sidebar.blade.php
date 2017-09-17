@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Đã Đăng Nhập</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-newspaper-o"></i> <span>Nội Dung</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/page') }}"><i class="fa fa-file-o"></i> <span>Trang Tin</span></a></li>
              <li class="treeview">
                <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tin Tức</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/article') }}"><i class="fa fa-newspaper-o"></i> <span>Bài Viết</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/article-category') }}"><i class="fa fa-list"></i> <span>Danh mục tin</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/article-tag') }}"><i class="fa fa-tag"></i> <span>Đánh dấu</span></a></li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#"><i class="fa fa-list"></i> <span>Sản Phẩm</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product-brand') }}"><i class="fa fa-star"></i> <span>Thương hiệu sản phẩm</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product-category') }}"><i class="fa fa-sitemap"></i> <span>Danh Mục Sản Phẩm</span></a></li>
                  <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/product-item') }}"><i class="fa fa-newspaper-o"></i> <span>Các Mặt Hàng</span></a></li>
                </ul>
              </li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>Quản Lý File</span></a></li>
            </ul>
          </li>
          
          <!-- StakeHolders -->
          <li class="treeview">
            <a href="#"><i class="fa fa-database"></i> <span>Quản Lý Vận Hành</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/customer-item') }}"><i class="fa fa-user-md"></i> <span>Khách Hàng</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/farmer-item') }}"><i class="fa fa-user-plus"></i> <span>Lương Nông</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/agent-item') }}"><i class="fa fa-user-o"></i> <span>Đại Lý</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/shipper-item') }}"><i class="fa fa-address-card"></i> <span>Giao Hàng</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/order-item') }}"><i class="fa fa-list-alt"></i> <span>Đơn Đặt Hàng </span></a></li>
            </ul>
          </li>
          <!-- Users, Roles Permissions -->
          <li class="treeview">
            <a href="#"><i class="fa fa-group"></i> <span>Quản Lý Người Dùng</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Người Dùng</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><i class="fa fa-group"></i> <span>Vai Trò</span></a></li>
              <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><i class="fa fa-key"></i> <span>Cấp Quyền</span></a></li>
            </ul>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}"><i class="fa fa-cog"></i> <span>Chỉnh sửa hệ thống</span></a></li>


          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>Đăng Xuất</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
