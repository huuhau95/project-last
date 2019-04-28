<!-- HEADER -->
<header>
  <!-- top Header -->
  <div id="top-header">
    <div class="container">
      <div class="pull-left">
        <span>Welcome to E-shop!</span>
      </div>
      <div class="pull-right">
        <ul class="header-top-links">
          @if(Auth::check())
          <li>
            <a title="{{ __('message.order') }}"
              href="{{ route('client.orders') }}">
            <span class="">{{ __('message.order') }}</span>
            </a>
          </li>
          <li>
            <a title="{{ __('message.my_account') }}"
              href="{{ route('client.profile') }}">
            <span class="">{{ __('message.my_account') }}</span>
            </a>
          </li>
          @if(Auth::user()->role_id == 1)
          <li>
            <a title="Dashboard"
              href="{{ route('admin.index') }}">
            <span class="">{{ __('message.title.dashboard') }}</span>
            </a>
          </li>
          @endif
          <li>
            <a href="{{ route('logout') }}">
            <span class="">{{ __('message.logout') }}</span>
            </a>
          </li>
          @else
          <li>
            <a href="{{ route('client.login') }}">
            <span class="">{{ __('message.login') }}</span>
            </a>
          </li>
          <li>
            <a href="{{ route('client.register') }}">
            <span class="">{{ __('message.register') }}</span>
            </a>
          </li>
          @endif
          <li class="dropdown default-dropdown">
            @if(Session::get('website_language') == 'vi')
            <a role="button" data-toggle="dropdown" data-target="#"
              class="block-language dropdown-toggle"
              href="{{ route('user.change-language', ['vi']) }}">
            <img src="{{ asset('images/vn_flat.png') }}">
            {{ __('message.vn') }}
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="{{ route('user.change-language', ['en']) }}">
                <img src="{{ asset('images/en_flat.png') }}">
                {{ __('message.en') }}
                </a>
              </li>
            </ul>
            @else
            <a role="button" data-toggle="dropdown" data-target="#"
              class="block-language dropdown-toggle"
              href="{{ route('user.change-language', ['en']) }}">
            <img src="{{ asset('images/en_flat.png') }}">
            {{ __('message.en') }}
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="{{ route('user.change-language', ['vi']) }}">
                <img src="{{ asset('images/vn_flat.png') }}">
                {{ __('message.vn') }}
                </a>
              </li>
            </ul>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- /top Header -->
  <!-- header -->


        <!-- header -->
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <!-- Logo -->
                    <div class="header-logo">
                        <a class="logo" href="#">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- /Logo -->

                    <!-- Search -->
                    <div class="header-search">
                        <form>
                            <input class="input search-input" type="text" placeholder="Enter your keyword">
                            <select class="input search-categories">
                                <option value="0">All Categories</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- /Search -->
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="qty">{{ count($cart) }}</span>
                                </div>
                                <strong class="text-uppercase">Giỏ hàng của tôi:</strong>
                            </a>
                            @if(count($cart)>0)
                            <div class="custom-menu">
                                <div id="shopping-cart">
                                    <div class="shopping-cart-list">
                                      @foreach($cart as $cart)
                                        <div class="product product-widget">
                                            <div class="product-thumb">
                                               <img width="75"
                                                  src="{{ asset('images/products/' . $cart['item']['product']->image) }}">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price">{{ number_format($cart['item']['product']->price) . ' ₫' }} <span class="qty">x{{ $cart['item']['quantity'] }}</span></h3>
                                                <h2 class="product-name"><a href="{{ route('client.product.detail', ['id' => $cart['item']['product']->id]) }}">{{ $cart['item']['product']->name }}</a></h2>
                                            </div>
                                            <a href="{{ route('user.cart.delete', ['key' => $cart['key']]) }}" class="cancel-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="shopping-cart-btns">
                                        <a href="{{ route('client.showCart')}}" class="primary-btn">Thanh toán <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                             @endif
                        </li>
                        <!-- /Cart -->

                        <!-- Mobile nav toggle-->
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                        <!-- / Mobile nav toggle -->
                    </ul>
                </div>
            </div>
            <!-- header -->
        </div>
        <!-- container -->
  <!-- container -->
</header>
<!-- /HEADER -->
