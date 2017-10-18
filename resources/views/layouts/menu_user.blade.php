<aside class="col-sm-12 col-md-3">
               <div class="block block-nav spacer-15">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Tài khoản</h4>
                  </div>
                  <div class="content">
                     <ul class="list-unstyled">
                        <li>
                           <a class="{{ Request::is('user/edit') ? 'current' : '' }}" href="{{url('/user/edit')}}">          <i class="fa fa-angle-right"></i> Thông tin cá nhân
                           </a>      
                        </li>
                        <li>
                           <a class="{{ Request::is('user/rate') ? 'current' : '' }}" href="{{url('/user/rate')}}">          <i class="fa fa-angle-right"></i> Đánh giá đơn hàng
                           </a>      
                        </li>
                        <li>
                           <a class="{{ Request::is('gio-hang-thuc-pham-sach') ? 'current' : '' }}" href="{{url('gio-hang-thuc-pham-sach')}}">          <i class="fa fa-angle-right"></i> Giỏ hàng mới
                           </a>      
                        </li>
                        <li>
                           <a class="{{ Request::is('thanh-toan') ? 'current' : '' }}" href="{{url('thanh-toan')}}">          <i class="fa fa-angle-right"></i> Đặt hàng
                           </a>      
                        </li>
                        
                     </ul>
                  </div>
               </div>
               
</aside>