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
                        <h2 class="title">Sản phẩm mới</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-1 custom-dots"></div>
                        </div>
                    </div>
                </div>
                <!-- /section-title -->
                <!-- Product Slick -->
                <div class="col-md-12 col-sm-6 col-xs-6">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            <!-- Product Single -->
                            @if($products)
                            @foreach($products as $product)
                             <?php
                                        if(empty($product->images[0])){
                                             $images_default = "default.png";
                                        }else{
                                             $images_default = $product->images[0]->name;
                                        }
                                    ?>
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                        @if($product->discount)
                                        <span class="sale">{{ $product->discount }}%</span>
                                        @endif
                                    </div>
                                    <button onclick="location.href='{{ route('client.product.detail', ['id' => $product->id]) }}'" class="main-btn quick-view" tabindex="0"><i class="fa fa-search-plus"></i>Xem thêm</button>
                                    <img src="{{ asset('images/products/' .  $images_default) }}" alt="">
                                </div>
                                <div class="product-body">
                                     @if($product->discount)
                                     <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
                                     @else
                                     <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
                                     @endif
                                    <h2 class="product-name"><a href="#">{{ $product->name }}</a></h2>
                                    <div class="product-btns">
                                         <a data-id="{{ $product->id }}" data-toggle="modal" href="#" data-target="#order" class="primary-btn add-to-cart add-to-btn btnBuy"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
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
                        <h2 class="title">Sản phẩm bán chạy</h2>
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
                             @if($best_sale_product)
                            @foreach($best_sale_product as $product)
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <div class="product-label">
                                         @if($product->discount)
                                        <span class="sale">{{ $product->discount }}%</span>
                                        @endif
                                    </div>
                                    <?php
                                        if(empty($product->images[0])){
                                             $images_default = "default.png";
                                        }else{
                                             $images_default = $product->images[0]->name;
                                        }
                                    ?>
                                    <button onclick="location.href='{{ route('client.product.detail', ['id' => $product->id]) }}'" class="main-btn quick-view" tabindex="0"><i class="fa fa-search-plus"></i>Xem thêm</button>
                                    <img src="{{ asset('images/products/' .  $images_default) }}" alt="">
                                </div>
                                <div class="product-body">
                                     @if($product->discount)
                                     <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
                                     @else
                                     <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
                                     @endif

                                    <h2 class="product-name"><a href="#">{{ $product->name }}</a></h2>
                                    <div class="product-btns">
                                         <a data-id="{{ $product->id }}" data-toggle="modal" href="#" data-target="#order" class="primary-btn add-to-cart add-to-btn btnBuy"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
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
@include('layouts.modal_cart')
