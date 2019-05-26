@extends('layouts.app_client')
@section('content')
<style type="text/css" media="screen">
.empty-cart-image {
  display: block;
  margin: auto;
}
</style>
<div id="breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ route('client.index') }}">Trang chủ</a></li>
      <li class="active">Đặt hàng</li>
    </ul>
  </div>
</div>
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
        @if(count($carts))
          <div class="col-md-8">
            <div class="order-summary clearfix">
              <div class="section-title">
                <h3 class="title">Thông tin sản phẩm đã mua</h3>
              </div>
              <table class="shopping-cart-table table">
                <thead>
                  <tr>
                    <th colspan="2">Sản phẩm</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Tổng tiền</th>
                    <th class="text-right"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $total = 0; ?>
                  @foreach($carts as $cart)

                  <?php $total+= $cart['item']['product_price'] * $cart['item']['quantity']; ?>
                  <tr>
                    <td class="thumb"><img width="75"
                      src="{{ asset('images/products/' . $cart['item']['product']->image) }}"></td>
                      <td class="details" style="padding: 10px;">
                        <a href="{{ route('client.product.detail', ['id' => $cart['item']['product']->id]) }}">{{ $cart['item']['product']->name }}</a>
                        <ul>
                          @if($cart['item']['size'])
                          <li><span>Size: {{ $cart['item']['size'] }}</span></li>
                          @endif
                          @if($cart['item']['color'])
                          <li><span>Màu: {{ $cart['item']['color'] }}</span></li>
                          @endif
                        </ul>
                      </td>
                      <td class="price text-center"><strong>{{ number_format($cart['item']['product_price']) . ' ₫' }}</strong></td>
                      <td class="qty text-center"><input data-id="{{ $cart['key'] }}" class="input quantity" min="1" max="99" type="number" value="{{ $cart['item']['quantity'] }}"></td>
                      <td class="total text-center"><strong class="primary-color">{{ number_format($cart['item']['product_price'] * $cart['item']['quantity']) . ' ₫' }}</strong></td>
                      <td class="text-right">
                        <a href="{{ route('user.cart.delete', ['key' => $cart['key']]) }}"  class="main-btn icon-btn"  data-id="{{ $cart['key'] }}"><i class="fa fa-close"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="empty" colspan="3"></th>
                      <th>Tổng tiền</th>
                      <th colspan="2" class="total">{{ number_format($total) . ' ₫' }}</th>
                    </tr>
                  </tfoot>
              </table>
            </div>
          </div>
          <form id="form-checkout" class="clearfix">
            @csrf
            <div class="col-md-4">
              <div class="billing-details">
                @if(!Auth::check())
                <p>Bạn đã là một khách hàng ? <a href="{{ route('client.login') }}">Đăng nhập</a></p>
                @endif
                <div class="section-title">
                  <h3 class="title">Thông tin người nhận</h3>
                </div>
                <div class="form-group">
                  <label for="receiver">Người nhận:</label>
                   <div class="form-group">
                  @if(Auth::user())
                    <input type="text" value="{{Auth::user()->name}}" class="form-control" id="checkout-email" name="receiver"
                  placeholder="Tên người nhận">
                  @else
                    <input type="text" class="form-control" id="checkout-receiver" name="receiver" placeholder="Tên người nhận">
                  @endif

                </div>

                </div>
                <div class="form-group">
                   <div class="form-group">
                  <label for="place">Địa điểm:</label>
                   @if(Auth::user())
                    <input type="text" value="{{Auth::user()->address}}" class="form-control" id="checkout-place" name="place"
                  placeholder="Địa chỉ">
                  @else
                    <input type="text" class="form-control" id="checkout-place" name="place"
                  placeholder="Địa chỉ">
                  @endif
                </div>


                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  @if(Auth::user())
                    <input type="text" value="{{Auth::user()->email}}" class="form-control" id="checkout-email" name="email"
                  placeholder="Email">
                  @else
                     <input type="text" class="form-control" id="checkout-email" name="email"
                  placeholder="Email">
                  @endif

                </div>
                <div class="form-group">
                  <label for="phone">Số điện thoại:</label>
                   @if(Auth::user())
                    <input type="text" value="{{Auth::user()->phone}}" class="form-control" name="phone" id="checkout-phone"
                  placeholder="Số điện thoại">
                  @else
                     <input type="text" class="form-control" name="phone" id="checkout-phone"
                  placeholder="Số điện thoại">
                  @endif
                </div>
                <div class="form-group">
                  <label for="note">Chú thích:</label>
                  <textarea class="form-control" name="note" id="checkout-note"
                  placeholder="Chú thích"></textarea>
                </div>
                <div class="pull-right">
                  <button class="primary-btn" id="btn_checkout">Đặt hàng</button>
                </div>
              </div>
            </div>
          </form>
          @else
          <div>
            <img class="empty-cart-image" src="{{ asset(config('asset.image_path.public') . 'empty-cart.png') }}" alt="Your Cart Is Empty">
          </div>
          @endif
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  @endsection
