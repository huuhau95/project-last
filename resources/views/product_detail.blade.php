@extends('layouts.app_client')
@section('content')
  <!-- section -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!--  Product Details -->
        <div class="product product-details clearfix">
          <div class="col-md-6">
            <div id="product-main-view">
            @foreach($product->images as $image)
              <div class="product-view">
                <img src="{{ asset('images/products/' . $image->name)}}" alt="">
              </div>
            @endforeach
            </div>
            <div id="product-view">
              @foreach($product->images as $image)
                <div class="product-view">
                  <img src="{{ asset('images/products/' . $image->name)}}" alt="">
                </div>
              @endforeach
            </div>
          </div>
          <div class="col-md-6">
            <div class="product-body">
              <h2 class="product-name">{{ $product->name }}</h2>
              @if($product->discount)
              <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
               @else
                <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
               @endif
              <div>
              </div>
              <p><strong>Loại sản phẩm:</strong> {{ $product->category->name }}</p>
              <p>{{ $product->brief }}</p>
              <form class="form_order" novalidate="novalidate" accept-charset="utf-8">
              <div class="product-options">
                @if($product->size && $product->size != "null")
                <span class="text-uppercase">Size:</span>
                <select name="size" id="hidden_size">
                  @foreach(json_decode($product->size) as $size)
                    <option value="{{$size}}">{{$size}}</option>
                  @endforeach
                </select>
                @endif
                @if($product->color && $product->color != "null")
                <span class="text-uppercase">Màu sắc:</span>
                <select name="color" id="hidden_color">
                  @foreach(json_decode($product->color) as $color)
                    <option value="{{$color}}">{{$color}}</option>
                  @endforeach
                </select>
                @endif
              </div>
              <div class="product-btns">
                <input class="hidden" name="product" id="hidden_id" type="hidden"  value="{{ $product->id }}">
                <button class="primary-btn btnSubmitOrder add-to-cart btn-car " data-id="{{ $product->id }}" href="javascript::void(0)" type="button"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
              </div>
              </form>

            </div>
          </div>
          <div class="col-md-12">
            <div class="product-tab">
              <ul class="tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
                <li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
                <li><a data-toggle="tab" href="#tab3">Bình luận</a></li>
              </ul>
              <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                  <p>{{ $product->brief }}</p>
                </div>

                <div id="tab2" class="tab-pane fade in">
                  <p>{{ $product->description }}
                 </p>
                </div>

                  <div id="tab3" class="tab-pane fade in">
                <div class="fb-comments" data-href="{{ route('client.product.detail', ['id' => $product->id]) }}" data-width="100%" data-numposts="5"></div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /Product Details -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /section -->

  <!-- section -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h2 class="title">Sản phẩm cùng loại</h2>
          </div>
        </div>
        <!-- section title -->

        <!-- Product Single -->
         @foreach ($products as $product)
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="product product-single">
            <div class="product-thumb">
              <img src="{{ asset(config('asset.image_path.product') . $product->images[0]->name) }}" alt="">
            </div>
            <div class="product-body">
              <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }}</h3>
              <h2 class="product-name"><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h2>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /section -->
@endsection
