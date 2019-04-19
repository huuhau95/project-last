<div class="header-container">
    <div class="header-top">
        <div class="container">
            <div clashref="#" s="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="dropdown block-language-wrapper">
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
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <!-- Header Top Links -->
                    <div class="toplinks">
                        <div class="links">
                            @if(Auth::check())
                            <div class="myaccount">
                                <a title="{{ __('message.order') }}"
                                   href="{{ route('client.orders') }}">
                                    <span class="">{{ __('message.order') }}</span>
                                </a>
                            </div>
                            <div class="myaccount">
                                <a title="{{ __('message.my_account') }}"
                                   href="{{ route('client.profile') }}">
                                    <span class="">{{ __('message.my_account') }}</span>
                                </a>
                            </div>
                            @if(Auth::user()->role_id == 1)
                            <div class="myaccount">
                                <a title="Dashboard"
                                   href="{{ route('admin.index') }}">
                                    <span class="">{{ __('message.title.dashboard') }}</span>
                                </a>
                            </div>
                            @endif
                            <div class="logout">
                                <a href="{{ route('logout') }}">
                                    <span class="">{{ __('message.logout') }}</span>
                                </a>
                            </div>
                            @else
                            <div class="login">
                                <a href="{{ route('client.login') }}">
                                    <span class="">{{ __('message.login') }}</span>
                                </a>
                            </div>
                            <div class="login">
                                <a href="{{ route('client.register') }}">
                                    <span class="">{{ __('message.register') }}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 logo-block">
                <!-- Header Logo -->
                <div class="logo">
                    <a title="Freshia Basket" href="{{ route('client.index') }}">
                        <img alt="Freshia" src="{{ asset('images/logo.png') }}" width="200px">
                    </a>
                </div>
                <!-- End Header Logo -->
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="search-box">
                    <form name="myform" action="{{ route('client.search') }}">
                        <input class="thmsearch" type="text" value="" id="keysearch" placeholder="Search product here" name="keyword" maxlength="70" autocomplete="off">
                        <button class="search-btn-bg" type="submit">
                            <span class="glyphicon glyphicon-search"></span>&nbsp;
                        </button>
                    </form>
                </div>
                <div id="box_search"></div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="hotline hidden-xs">
                    <span class="content">
                        <span class="text">{{ __('message.support') }}</span>
                        <span class="text info2">{{ __('message.email_help') }}</span>
                    </span>
                </div>
                <div class="top-cart-contain pull-right">
                    <div class="mini-cart">
                        <div data-hover="dropdown" class="basket dropdown-toggle">
                            <a href="#">
                                <span class="count count_cart">0</span>
                                <span class="woocs_special_price_code">
                                    <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol price_cart">0</span> ₫</span>
                                </span>
                            </a>
                        </div>
                        <div>
                            <div class="top-cart-content" id="cart_box">
                                <div id="car_list">
                                </div>
                                <div class="actions" id="action_order">
                                    <a href="{{ route('client.showCart') }}" class="view-cart">
                                        <span>{{ __('message.view_cart') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
