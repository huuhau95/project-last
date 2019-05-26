@extends('layouts.app_client')

@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <!-- aside widget -->
                <div class="aside">
                    <!-- search -->
                </div>
                <!-- aside widget -->
                <!-- /aside widget -->
            </div>
            <!-- /ASIDE -->

            <!-- MAIN -->
            <div id="main" class="col-md-12">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="pull-right">
                        {!! $products->appends(request()->input())->links() !!}
                    </div>
                </div>
                <!-- /store top filter -->

                <!-- STORE -->
                <div id="store">
                    <!-- row -->
                    <div class="row">
                        <!-- Product Single -->
                        @if(count($products))
                        @foreach($products as $product)
                        <div class="col-md-3 col-sm-3 col-xs-6 product-equal-height">
                        <div class="product product-single">
                            <div class="product-thumb">
                                <div class="product-label">
                                    @if($product->discount)
                                    <span class="sale">-{{ $product->discount }}%</span>
                                    @endif
                                </div>
                                 <button onclick="location.href='{{ route('client.product.detail', ['id' => $product->id]) }}'" class="main-btn quick-view" tabindex="0"><i class="fa fa-search-plus"></i>Xem thêm</button>
                                <img src="{{ asset('images/products/' . $product->images[0]->name) }}" alt="">
                            </div>
                            <div class="product-body">
                               @if($product->discount)
                               <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
                               @else
                               <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
                               @endif

                               <h2 class="product-name"><a href="#">{{ $product->name }}</a></h2>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->
                <div class="clearfix visible-sm visible-xs"></div>
                @endforeach
                @else
                <h3 class="text text-center">{{ __('message.product_no_match') }}</h3>
                @endif
            </div>
            <!-- /row -->
        </div>
        <!-- /STORE -->
         <div class="store-filter clearfix">
                    <div class="pull-right">
                        {!! $products->appends(request()->input())->links() !!}
                    </div>
                </div>
    </div>
    <!-- /MAIN -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
@endsection
