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
              <div class="product-label">
                <span>New</span>
              </div>
              <h2 class="product-name">Product Name Goes Here</h2>
              @if($product->discount)
              <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }} <del class="product-old-price">{{ number_format($product->price) . ' ₫' }}</del></h3>
               @else
                <h3 class="product-price">{{ number_format($product->price) . ' ₫' }}</h3>
               @endif
              <div>
                <div class="product-rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o empty"></i>
                </div>
                <a href="#">3 Review(s) / Add Review</a>
              </div>
              <p><strong>Availability:</strong> In Stock</p>
              <p><strong>Brand:</strong> E-SHOP</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <div class="product-options">
                <ul class="size-option">
                  <li><span class="text-uppercase">Size:</span></li>
                  <li class="active"><a href="#">S</a></li>
                  <li><a href="#">XL</a></li>
                  <li><a href="#">SL</a></li>
                </ul>
                <ul class="color-option">
                  <li><span class="text-uppercase">Color:</span></li>
                  <li class="active"><a href="#" style="background-color:#475984;"></a></li>
                  <li><a href="#" style="background-color:#8A2454;"></a></li>
                  <li><a href="#" style="background-color:#BF6989;"></a></li>
                  <li><a href="#" style="background-color:#9A54D8;"></a></li>
                </ul>
              </div>

              <div class="product-btns">
                <div class="qty-input">
                  <span class="text-uppercase">QTY: </span>
                  <input class="input" type="number">
                </div>
                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                <div class="pull-right">
                  <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                  <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                  <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="product-tab">
              <ul class="tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                <li><a data-toggle="tab" href="#tab2">Details</a></li>
              </ul>
              <div class="tab-content">
                <div id="tab1" class="tab-pane fade in active">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>

                <div id="tab2" class="tab-pane fade in">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur possimus delectus culpa commodi harum. Distinctio, veniam quo debitis esse a, quasi dolor sed modi ipsum assumenda velit commodi accusantium laudantium.</span>
                    <span>Excepturi enim molestias deleniti nemo quo inventore perspiciatis repellendus aliquam eligendi magni harum praesentium, error quas eum provident earum nostrum at, assumenda repellat labore. Dignissimos expedita obcaecati, optio veniam? Maiores.</span>
                    <span>Facere dolorem, aliquid eos! Labore voluptatibus rem, officia impedit cumque reprehenderit quibusdam. Dolorum sapiente aliquid debitis quisquam possimus eum voluptatem fugit nesciunt, in eius, molestiae, ullam natus rem id perspiciatis.</span>
                    <span>Illum omnis sunt illo doloremque cumque quia, ullam nihil animi ducimus nisi commodi minus ab tenetur soluta nemo quisquam, impedit tempore modi, vero laudantium cupiditate doloribus repudiandae. Ipsam totam, hic.</span>
                    <span>Rem consequatur nemo, provident voluptatem laborum incidunt voluptatum magnam obcaecati, necessitatibus, harum quo accusamus atque error sequi sit dolorum. Incidunt quia, laboriosam molestias rerum, qui tempora dolorum dolore sunt veniam.</span></p>
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
            <h2 class="title">Picked For You</h2>
          </div>
        </div>
        <!-- section title -->

        <!-- Product Single -->
         @foreach ($products as $product)
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="product product-single">
            <div class="product-thumb">
              <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
              <img src="{{ asset(config('asset.image_path.product') . $product->images[0]->name) }}" alt="">
            </div>
            <div class="product-body">
              <h3 class="product-price">{{ number_format($product->price * (1- $product->discount /100)) . ' ₫' }}</h3>
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
        </div>
        @endforeach
        <!-- /Product Single -->

        <!-- Product Single -->

        <!-- /Product Single -->

        <!-- Product Single -->

        <!-- /Product Single -->

        <!-- Product Single -->

        <!-- /Product Single -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /section -->

@endsection
