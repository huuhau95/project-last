@extends('layouts.app_client')
@section('content')
    <div id="thmsoft-slideshow" class="thmsoft-slideshow">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
                        <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                            <ul>
                                <li data-transition='random' data-slotamount='7' data-masterspeed='1000'
                                    data-thumb="{{ asset('images/image_background1.jpg') }}">
                                    <img src="{{ asset('images/image_background1.jpg') }}"
                                         alt="slide-img" data-bgposition='left top' data-bgfit='cover'
                                         data-bgrepeat='no-repeat'/>
                                </li>
                                <li data-transition='random' data-slotamount='7' data-masterspeed='1000'
                                    data-thumb="{{ asset('images/image_background2.jpg') }}">
                                    <img src="{{ asset('images/image_background2.jpg') }}"
                                         alt="slide-img" data-bgposition='left top' data-bgfit='cover'
                                         data-bgrepeat='no-repeat'/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="content-page">
        <div class="bestsellers1">
            <div class="bestseller">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="category-product">
                                <div class="title">
                                    <h2> Best Sellers</h2>
                                </div>
                            </div>
                        </div>
                        <div class="product-bestseller">
                            <div class="product-bestseller-content">
                                <div class="col-md-6 col-sm-12 col-xs-12 hot-deal-box">
                                    <div class="hot-deal">
                                        <div class="item">
                                            <div class="item-inner">
                                                <div class="item-img">
                                                    <div class="item-img-info">
                                                        <div class="link-quickview">
                                                            <a href="{{ route('client.product.detail', ['id' => $best_discount_product->id]) }}"
                                                               class="quick-view">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        <a class="product-image"
                                                           title="{{ $best_discount_product->image }}"
                                                           href="{{ route('client.product.detail', ['id' => $best_discount_product->id]) }}">
                                                            <img alt="{{ $best_discount_product->image }}"
                                                                 src="{{ asset('images/products/' . $best_discount_product->images[0]->name) }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-info">
                                                    <div class="info-inner">
                                                        <div class="item-title">
                                                            <a title="{{ $best_discount_product->image }}"
                                                               href="{{ route('client.product.detail', ['id' => $best_discount_product->id]) }}">
                                                                {{ $best_discount_product->name }}
                                                            </a>
                                                        </div>
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div style="width:80%" class="rating"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item-description">
                                                            {{ $best_discount_product->brief }}
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="item-price">
                                                                <div class="price-box">
                                                                    <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                        <span class="price"
                                                                              style="text-decoration-line: line-through">{{ number_format($best_discount_product->price) . ' ₫' }}</span>
                                                                    </p>
                                                                    <p class="special-price"><span class="price-label">Special Price</span>
                                                                        <span class="price">
                                                                            {{ number_format($best_discount_product->price *(1- $best_discount_product->discount/100)) . ' ₫'}}
                                                                        </span></p>
                                                                </div>
                                                            </div>
                                                            <a data-id="{{ $best_discount_product->id }}"
                                                               data-toggle="modal" href="#" data-target="#order"
                                                               class="add-to-btn btnBuy" title="Buy"><i class="fa fa-shopping-cart"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 por-tabs">
                                    <div class="product-bestseller-list">
                                        <div class="tab-container">
                                            <!-- tab product -->
                                            <div class="tab-panel active" id="tab-1">
                                                <div class="category-products">
                                                    <ul class="products-grid">
                                                        @foreach($products as $product)
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="{{ $product->name }}"
                                                                           href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                                                                            <img alt="{{ $product->name }}"
                                                                                 src="{{ asset('images/products/' . $product->images[0]->name) }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title">
                                                                                <a title="{{ $product->name }}"
                                                                                   href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                                                                                    {{ $product->name }}
                                                                                </a>
                                                                            </div>
                                                                            <div class="rating">
                                                                                <div class="ratings">
                                                                                    <div class="rating-box">
                                                                                        <div style="width:50%"
                                                                                             class="rating"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box">
                                                                                        <span class="regular-price">
                                                                                            <span
                                                                                                    class="price">{{ number_format($product->price) . ' ₫'}}</span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="tab-panel" id="tab-3">
                                                <div class="category-products">
                                                    <div class="category-products">
                                                        <ul class="products-grid">
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <!-- <div class="product-cartitem">1</div> -->
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product18.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Blue</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box">
                                                                                        <p class="special-price"><span
                                                                                                    class="price-label">Special Price</span>
                                                                                            <span
                                                                                                    class="price"> $156.00 </span>
                                                                                        </p>
                                                                                        <p class="old-price"><span
                                                                                                    class="price-label">Regular Price:</span>
                                                                                            <span
                                                                                                    class="price"> $167.00 </span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product17.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Green</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box"><span
                                                                                                class="regular-price"> <span
                                                                                                    class="price">$155.00</span> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product8.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Green</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box"><span
                                                                                                class="regular-price"> <span
                                                                                                    class="price">$155.00</span> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product9.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Green</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box"><span
                                                                                                class="regular-price"> <span
                                                                                                    class="price">$155.00</span> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product10.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Green</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box"><span
                                                                                                class="regular-price"> <span
                                                                                                    class="price">$155.00</span> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="item col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="item-inner">
                                                                    <div class="item-img">
                                                                        <div style=" display:none;"
                                                                             class="product-cartitem">0
                                                                        </div>
                                                                        <a class="product-image"
                                                                           title="Retis lapen casen"
                                                                           href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">
                                                                            <img alt="Retis lapen casen"
                                                                                 src="http://htmldemo.themessoft.com/freshia/version3/product-images/product11.jpg">
                                                                        </a>
                                                                    </div>
                                                                    <div class="item-info">
                                                                        <div class="info-inner">
                                                                            <div class="item-title"><a
                                                                                        title="Retis lapen casen"
                                                                                        href="http://htmldemo.themessoft.com/freshia/version3/product_detail.html">Atomic
                                                                                    Endurance Running Tee
                                                                                    (V-neck)-S-Green</a></div>
                                                                            <div class="item-content">
                                                                                <div class="item-price">
                                                                                    <div class="price-box"><span
                                                                                                class="regular-price"> <span
                                                                                                    class="price">$155.00</span> </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <img src="http://overthehillandundertheradar.com/wp-content/uploads/2017/05/coffee-2242265_1920.jpg">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <img src="http://s1.1zoom.me/big7/493/Coffee_Strawberry_Breakfast_Cup_Plate_Spoon_544646_1920x1280.jpg">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <img src="https://amiowealth.com/wp-content/uploads/2017/05/coffee-841425_1920.jpg">
                    </div>
                </div>
            </div>
        </div>
        <section class="category-section">
            <div class="container">
                <!--<h3 class="widget-heading">Top Categories</h3>-->
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                            <div class="category-box">
                                <a href="{{ route('client.filter', ['category_id' => $category->id]) }}">
                                    <img class="loaded"
                                         src="{{ asset(config('asset.image_path.category') . $category->image) }}">
                                </a>
                                <div class="cate-title"><a href="#">{{ $category->name }}</a></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @if(count($product_revent_view))
            <div class="container">
                <div class="bestsell-pro">
                    <div class="slider-items-products">
                        <div class="bestsell-block">
                            <div class="block-title">
                                <h2>Recently Viewed</h2>
                            </div>
                            <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                                <div
                                        class="slider-items slider-width-col4 products-grid block-content owl-carousel owl-theme">
                                    @foreach($product_revent_view as $product)
                                        <div class="item">
                                            <div class="item-inner">
                                                <div class="item-img">
                                                    <div class="item-img-info">
                                                        <a href="#" title="Woo Logo" class="product-image">
                                                            <figure class="img-responsive">
                                                                <img src="{{ asset('images/products/' . $product->images[0]->name) }}">
                                                            </figure>
                                                        </a>
                                                        <div class="box-hover">
                                                            <ul class="add-to-links">
                                                                <li>
                                                                    <a class="detail-bnt yith-wcqv-button link-quickview">
                                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="add_to_wishlist link-wishlist favorite"
                                                                       data-id="{{ $product->id }}"></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#"
                                                                       class="link-compare add_to_compare compare"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-info">
                                                    <div class="info-inner">
                                                        <div class="item-title"><a href="#"
                                                            >{{ $product->name }}</a>
                                                        </div>
                                                        <div class="item-content">
                                                            <div class="rating">
                                                                <div class="ratings">
                                                                    <div class="rating-box">
                                                                        <div style="width:80%" class="rating"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-price">
                                                                <div class="price-box">
                                                                    @if($product->discount)
                                                                        <del>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">{{ number_format($product->price) . ' ₫' }}</span>
                                                                    </span>
                                                                        </del>
                                                                        <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">{{ number_format($product->price - (1- $product->discount/100)) .' ₫' }}</span>
                                                                    </span>
                                                                        </ins>
                                                                    @else
                                                                        <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">{{ number_format($product->price) . ' ₫' }}</span>
                                                                    </span>
                                                                        </ins>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="action">
                                                                <a rel="nofollow" href="#" data-quantity="1"
                                                                   data-product_id="60" data-product_sku=""
                                                                   class="button product_type_simple add_to_cart_button ajax_add_to_cart btn-cart btnBuy"
                                                                   data-toggle="modal" data-target="#order"
                                                                   data-id="{{ $product->id }}">
                                                                    <span>Add to cart</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="modal" id="order" tabindex="-1" role="dialog" aria-labelledby="modal_product_name"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 20px;margin: auto;">
                <form id="form_order">
                    <input type="hidden" name="product" id="product_id_modal" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h1 class="modal-title"></h1>
                        <h3>Size</h3>
                        @foreach($sizes as $size)
                            <label style="padding: 2px 15px;margin-left: 5px;border-radius: 15px;font-size: 20px;background-color: #FF7F50">
                                <input type="radio" name="size" value="{{ $size->id }}">
                                {{ $size->name }}
                            </label>
                        @endforeach
                        <p id="error-size-index-add-cart" style="font-size: 20px;color: red;font-family: initial;padding-left: 10px;"></p>
                        <h3>Topping</h3>
                        @foreach($toppings as $topping)
                            <label style="padding: 2px 15px;margin-left: 5px;border-radius: 15px;font-size: 20px;background-color: #ADFF2F">
                                <input type="checkbox" name="toppings[]" id="topping" value="{{ $topping->id }}">
                                {{ $topping->name }}
                            </label>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnSubmitOrder" class="btn btn-primary">Order</button>
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
