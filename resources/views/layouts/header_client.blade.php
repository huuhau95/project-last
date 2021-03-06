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
            <span class="">{{ __('message.order_histories') }}</span>
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
                        <a class="logo" href="{{ route('client.index') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <!-- /Logo -->

                    <!-- Search -->
                    <div class="header-search">
                        <form action="{{ route('client.search') }}" method="GET">
                            <input class="input search-input" type="text" name="product" placeholder="Nhập vào từ khóa tìm kiếm.....">
                            <select class="input search-categories" name="category">
                                <option value="0">Tất cả danh mục</option>
                                @if($categories)
                                  @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                @endif
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
                                    <span class="qty">{{ count($carts) }}</span>
                                </div>
                                <strong class="text-uppercase">Giỏ hàng của tôi:</strong>
                                <br>
                                <span>
                                  <?php $total = 0; ?>
                                  @if(count($carts)>0)
                                  @foreach($carts as $cart)
                                    <?php $total+= $cart['item']['product_price'] * $cart['item']['quantity']; ?>
                                  @endforeach
                                  @endif
                                  {{ number_format($total) . ' ₫' }}
                                </span>
                            </a>
                            @if(count($carts)>0)
                            <div class="custom-menu">
                                <div id="shopping-cart">
                                    <div class="shopping-cart-list">
                                      @foreach($carts as $cart)
                                        <div class="product product-widget">
                                            <div class="product-thumb">
                                               <img width="75"
                                                  src="{{ asset('images/products/' . $cart['item']['product']->image) }}">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price">{{ number_format($cart['item']['product_price']) . ' ₫' }} <span class="qty">x{{ $cart['item']['quantity'] }}</span></h3>
                                                <h2 class="product-name"><a href="{{ route('client.product.detail', ['id' => $cart['item']['product']->id]) }}">{{ $cart['item']['product']->name }}</a></h2>
                                            </div>
                                            <a href="{{ route('user.cart.delete', ['key' => $cart['key']]) }}" class="cancel-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="shopping-cart-btns">
                                        <a href="{{ route('client.showCart')}}" class="primary-btn">Tiến hành đặt hàng <i class="fa fa-arrow-circle-right"></i></a>
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
