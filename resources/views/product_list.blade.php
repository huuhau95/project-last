<h2 class="page-heading">
</h2>
@if(count($products))
<div class="category-products">
    <ul class="products-grid">
        @foreach($products as $product)
            <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="item-img">
                        <div class="item-img-info">
                            <a href="{{ route('client.product.detail', ['id' => $product->id]) }}"
                               class="product-image" title="{{ $product->name }}">
                                <img src="{{ asset(config('asset.image_path.product') . $product->images[0]->name) }}"
                                     alt="{{ $product->name }}" width="234" height="234">
                            </a>
                            <div class="box-hover">
                                <ul class="add-to-links">
                                    <li>
                                        <a class="link-quickview" href=""></a>
                                    </li>
                                    <li>
                                        <a class="link-wishlist favorite"
                                           data-id="{{ $product->id }}" href=""></a>
                                    </li>
                                    <li>
                                        <a class="link-compare" href=""></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title">
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
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
                                            <p class="old-price">
                                        <span class="price">
                                            {{ number_format($product->price) .' ₫'}}
                                        </span>
                                            </p>
                                        @endif
                                        <p class="special-price">
                                            <span class="price">{{ number_format($product->price * (1 - $product->discount/100)) .' ₫'}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach()
    </ul>
</div>
<div class="toolbar">
    <div class="row">
        <div class="col-lg-10 col-sm-7 col-md-5">
            <div class="pager">
                <div class="pages">
                    @if(count($products)>6)<label>Page:</label>@endif
                    {!! $products->appends(request()->query())->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <h3 class="text text-center">{{ __('message.product_no_match') }}</h3>
@endif
