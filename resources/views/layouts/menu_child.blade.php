<aside class="col-md-3">
               <div class="block block-nav">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Thông Tin</h4>
                  </div>
                  <div class="content">
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Tìm hiểu C-farm
                           </strong>
                        </dt>
                        @foreach($about_pages as $item)
                        <dd>
                           <a class="{{ Request::is($item->slug) ? 'current' : '' }}" href="{{$item->slug}}">          <i class="fa fa-angle-right"></i> {{$item->name}}
                           </a>      
                        </dd>
                        @endforeach
                        
                        <!-- <dd>
                           <a class="current" href="terms-conditions.html">          <i class="fa fa-angle-right"></i> Terms and Conditions
                           </a>      
                        </dd> -->
                     </dl>
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Chăm sóc khách hàng
                           </strong>
                        </dt>
                        @foreach($service_pages as $item)
                        <dd>
                           <a class="{{ Request::is($item->slug) ? 'current' : '' }}" href="{{$item->slug}}">          <i class="fa fa-angle-right"></i> {{$item->name}}
                           </a>      
                        </dd>
                        @endforeach
                        
                     </dl>
                  </div>
               </div>
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="text-center" id="fanpageFB">
                     <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>  
                  </div>
               </div>
            </aside>