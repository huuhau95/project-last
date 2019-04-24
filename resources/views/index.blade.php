@extends('layouts.app_client')
@section('content')

<!-- HOME -->
<div id="home">
    <!-- home wrap -->
    <div class="home-wrap">
        <!-- home slick -->
        <div id="home-slick">
            @if($slides)
            @foreach($slides as $slide)
            <!-- banner -->
            <div class="banner banner-1">
                <img src="{{ asset(config('asset.image_path.slide')).'/'.$slide->image }}" alt="">
                <div class="banner-caption text-center">
                    <h1>Bags sale</h1>
                    <h3 class="white-color font-weak">Up to 50% Discount</h3>
                    <button class="primary-btn">Shop Now</button>
                </div>
            </div>
            <!-- /banner -->
            @endforeach
            @endif
        </div>
        <!-- /home wrap -->
    </div>
    <!-- /HOME -->


    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section-title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">Deals Of The Day</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-1 custom-dots"></div>
                        </div>
                    </div>
                </div>
                <!-- /section-title -->

                <!-- banner -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="banner banner-2">
                        <img src="{{ asset('images/banner14.jpg') }}" alt="">
                        <div class="banner-caption">
                            <h2 class="white-color">NEW<br>COLLECTION</h2>
                            <button class="primary-btn">Shop Now</button>
                        </div>
                    </div>
                </div>
                <!-- /banner -->

                <!-- Product Slick -->
                <div class="col-md-9 col-sm-6 col-xs-6">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            <!-- Product Single -->
                            @if($products)
                            @foreach($products as $product)
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/products/' . $product->images[0]->name) }}" alt="">
                                </div>
                                <div class="product-body">
                                     @if($product->discount)
                                     <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
                                     @else
                                     <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
                                     @endif

                                    <h2 class="product-name"><a href="#">{{ $product->name }}</a></h2>
                                    <div class="product-btns">
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <!-- /Product Single -->

                            <!-- /Product Single -->

                            <!-- Product Single -->

                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <!-- /Product Single -->
                        </div>
                    </div>
                </div>
                <!-- /Product Slick -->
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">LATEST PRODUCTS</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-2 custom-dots">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- section title -->

                <!-- Product Slick -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="product-slick-2" class="product-slick">
                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product06.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50</h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span class="sale">-20%</span>
                                    </div>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product05.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product04.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50</h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product03.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product06.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50</h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span class="sale">-20%</span>
                                    </div>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product05.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product04.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50</h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                            <!-- Product Single -->
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        <span>New</span>
                                        <span class="sale">-20%</span>
                                    </div>
                                    <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
                                    <img src="{{ asset('images/product03.jpg') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o empty"></i>
                                    </div>
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-btns">
                                        <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                        <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->

                        </div>
                    </div>
                </div>
                <!-- /Product Slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    @endsection
