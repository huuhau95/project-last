@extends('layouts.app_client')
@section('css')
    <link rel='stylesheet' href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="home">
                            <a href="{{ route('client.index') }}" title="Go to Home Page">{{ __('message.title.home') }}</a>
                            <span>/</span>
                        </li>
                        <li class="category1599">
                            <a>{{ __('message.product') }}</a>
                            <span>/ </span>
                        </li>
                        <li class="category1601">
                            <strong>Filter</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="main-container col2-left-layout bounceInUp animated">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-sm-push-3">
                    <div class="category-description std">
                        <div class="slider-items-products">
                            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col1 owl-carousel owl-theme">
                                    <div class="item">
                                        <a href="#">
                                            <img alt="" src="{{ asset('images/image_background2.jpg') }}">
                                        </a>
                                    </div>
                                    <div class="item">
                                        <a href="#">
                                            <img alt="" src="{{ asset('images/image_background1.jpg') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="col-main">
                        <div class="show-products">
                            @include('product_list')
                        </div>
                    </article>
                </div>
                <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                    <aside class="col-left sidebar">

                        <div class="side-nav-categories">
                            <div class="block-title">{{ __('message.category') }}</div>
                            <div class="box-content box-category">
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" name="category_id" class="category-filter" value="0" checked="">
                                        <span style="font-size: 18px;padding-left: 4px">
                                                {{ __('All') }}
                                            </span>
                                    </label>
                                </div>
                                @foreach ($categories as $c)
                                    <div class="radio" style="padding-left: 8px">
                                        <label>
                                            <input type="radio" name="category_id" class="category-filter" value="{{ $c->id }}">
                                            <span style="font-size: 18px;padding-left: 4px">
                                                {{ $c->name }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="side-nav-categories">
                            <div class="block-title">Price</div>
                            <div class="box-content box-category">
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" class="price-filter" name="price" value="0" checked="">
                                        <span style="font-size: 18px;padding-left: 4px">
                                            {{ __('All') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" class="price-filter" name="price" value="1">
                                        <span style="font-size: 18px;padding-left: 4px">
                                            {{ __('0 ₫ - 10.000 ₫') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" class="price-filter" name="price" value="2">
                                        <span style="font-size: 18px;padding-left: 4px">
                                            {{ __('30.000 ₫ - 50.000 ₫') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" class="price-filter" name="price" value="3">
                                        <span style="font-size: 18px;padding-left: 4px">
                                            {{ __('50.000 ₫ - 70.000 ₫') }}
                                        </span>
                                    </label>
                                </div>
                                <div class="radio" style="padding-left: 8px">
                                    <label>
                                        <input type="radio" class="price-filter" name="price" value="4">
                                        <span style="font-size: 18px;padding-left: 4px">
                                            {{ __('>= 70.000 ₫') }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="block block-cart">
                            <div class="block-title ">My Cart</div>
                            <div class="block-content">
                                <div class="summary">
                                    <p class="amount">There are <span class="count_cart">0</span> product in your cart.
                                    </p>
                                    <p class="subtotal">
                                        <span class="label">Cart Subtotal:</span>
                                        <span class="price price_cart">0</span>
                                        <strong class=""> ₫</strong>
                                    </p>
                                </div>
                                <div class="ajax-checkout">
                                    <button class="button button-checkout" title="Submit" type="submit">
                                        <span>Checkout</span></button>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Container End -->
@endsection

@section('js')
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.button-checkout').click(function (event) {
                event.preventDefault();
                window.location.href = route('client.showCart');
            });

        });
    </script>
@endsection