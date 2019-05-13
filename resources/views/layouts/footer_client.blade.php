    <footer id="footer" class="section section-grey">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <!-- footer logo -->
                        <div class="footer-logo">
                            <a class="logo" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                  </a>
                        </div>
                        <!-- /footer logo -->

                        <p>E-shop là hệ thông cửa hàng thời trang đẹp nhất Hà Nội</p>

                        <!-- footer social -->
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <!-- /footer social -->
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Tài khoản</h3>
                        <ul class="list-links">
                            @if(Auth::check())
                                <li>
                                    <a href="{{ route('client.orders') }}">{{ __('message.order_histories') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('client.profile') }}">{{ __('message.my_account') }}</a>
                                </li>
                                @if(Auth::user()->role_id == 1)
                                  <li>
                                    <a href="{{ route('admin.index') }}">
                                    <span class="">{{ __('message.title.dashboard') }}</span>
                                    </a>
                                  </li>
                                  @endif
                                <li>
                                    <a href="{{ route('logout') }}">{{ __('message.logout') }}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('client.login') }}">
                                    {{ __('message.login') }}
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{ route('client.register') }}">
                                    {{ __('message.register') }}
                                    </a>
                                  </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <div class="clearfix visible-sm visible-xs"></div>

                <!-- footer widget -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Danh mục sản phẩm</h3>
                        <ul class="list-links">
                            @if($categories)
                              @foreach($categories as $category)
                                <li><a href="{{ route('client.showProductByCate', ['category_id' => $category->id]) }}">{{ $category->name }}</a></li>
                              @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /footer widget -->

                <!-- footer subscribe -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Hệ thống cửa hàng</h3>
                        <p>Cửa hàng 1: 268 Tô Hiến Thành, Thành phố Thái Bình. ĐT: (036) 38 62 57 91</p>

                        <p>Cửa hàng 2: 40 Lê Văn Sỹ, Thành phố Thái Bình. ĐT: (036) 62 53 73 93</p>

                        <p>Cửa hàng 3: 248B Phan Đình Phùng, Thành phố Thái Bình. ĐT: (036) 62 53 87 87</p>

                        <p>Cửa hàng 4: 259 Nguyễn Trãi, Thành phố Thái Bình. ĐT: (036) 62 913 241</p>

                        <p>Cửa hàng 5: 664 Quang Trung, Thành phố Thái Bình. ĐT: (036) 62 99 22 33</p>
                    </div>
                </div>
                <!-- /footer subscribe -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </footer>
