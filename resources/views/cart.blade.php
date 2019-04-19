@extends('layouts.app_client')

@section('css')
   <style type="text/css" media="screen">
       .increase_quantity {
            height: 30px;
            width: 25px;
            border: 1px #c8c8c8 solid;
            background-color: #ffffff;
            border-radius:0px 4px 4px 0px;
            color: #999;
            padding: 1px;
       }
       .reduce_quantity {
            height: 30px;
            width: 25px;
            border: 1px #c8c8c8 solid;
            background-color: #ffffff;

            border-radius:4px 0px 0px 4px;
            color: #999;
            padding: 1px;
       }
       .input_quantity {
            height: 30px;
            border: 1px #c8c8c8 solid;
            width: 35px;
            margin: 0px !important;
            padding-left: 10px;
       }
       .topping-element {
            padding: 5px 15px;
            margin-left: 5px;
            border-radius: 5px;
            font-size: 15px;
            background-color: #f0f0f0;
            display: inline-block;
       }
       .empty-cart-image {
            display: block;
            margin: auto;
       }
   </style>
@endsection

@section('content')
    <section class="main-container col1-layout">
        <div class="main container">
            <div class="col-main">
                <div class="cart wow bounceInUp animated">
                    <div class="page-title">
                        <h2>Shopping Cart</h2>
                    </div>
                    <div id="box-cart">
                        @if(count($carts))
                            <div class="table-responsive">
                                <input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
                                <fieldset>
                                    <table class="data-table cart-table" id="shopping-cart-table">
                                        <thead>
                                            <tr class="first last">
                                                <th>&nbsp;</th>
                                                <th><span class="nobr">Product</span></th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td class="a-right last" colspan="50">
                                                    {{-- @if(Session::get('status-cart') == false) --}}
                                                    <button class="button btn-continue">
                                                        <span>Continue Shopping</span>
                                                    </button>
                                                    <button class="button btn-empty" id="checkout"
                                                            data-user="{{ $user }}">
                                                        <span>Check out</span>
                                                    </button>
                                                    {{-- @endif --}}
                                                    <button id="empty_cart_button" class="button btn-empty">
                                                        <span>Clear Cart</span>
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr class="first">
                                                <td>
                                                    <p class="" style="font-size: 25px;display: ruby;">
                                                        Totals: <span class="price_cart" id="price_cart"
                                                                      style="color: red;font-weight: 400;"></span>
                                                        ₫</p>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($carts as $cart)
                                                <tr>
                                                    <td width="20%" align="center">
                                                        <a class="product-image"
                                                           href="{{ route('client.product.detail', ['id' => $cart['item']['product']->id]) }}">
                                                            <img width="75"
                                                                 src="{{ asset('images/products/' . $cart['item']['product']->image) }}">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h2 class="product-name">
                                                            <a style="font-size: 20px;margin-bottom: 20px"
                                                               href="{{ route('client.product.detail', ['id' => $cart['item']['product']->id]) }}">
                                                                {{ $cart['item']['product']->name }}
                                                            </a>
                                                            <p>
                                                                @foreach($cart['item']['toppings'] as $topping)
                                                                    <span class="topping-element">{{ $topping->name }}</span>
                                                                @endforeach
                                                            </p>
                                                        </h2>
                                                    </td>
                                                    <td width="15%">
                                                        <div class="input-group">
                                                            <span style="display: table-cell;">
                                                                <button class="reduce_quantity" data-quantity="{{ $cart['item']['quantity'] }}" data-id="{{ $cart['key'] }}">-</button>
                                                            </span>

                                                            <input type="text" maxlength="12" min="1" max="10"
                                                                   class="input_quantity"
                                                                   size="4" pattern="\d*"
                                                                   value="{{ $cart['item']['quantity'] }}" id="quantity-cart"
                                                                   data-id="{{ $cart['key'] }}" disabled>
                                                            <span style="display: table-cell;" >
                                                                <button class="increase_quantity" data-quantity="{{ $cart['item']['quantity'] }}" data-id="{{ $cart['key'] }}">+</button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td width="10%">
                                                        <span class="cart-price">
                                                            <span class="price">{{ number_format($cart['item_price']) . ' ₫' }}</span>
                                                        </span>
                                                    </td>
                                                    <td width="5%">
                                                        <a class="button remove-item"
                                                           data-id="{{ $cart['key'] }}" href="{{ route('user.cart.delete', ['key' => $cart['key']]) }}">
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        @else
                            <div>
                                <img class="empty-cart-image" src="{{ asset(config('asset.image_path.public') . 'empty-cart.png') }}" alt="Your Cart Is Empty">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="container-fluid" hidden id="div-check-out">
                    <div class="page-title">
                        <h2>Checkout</h2>
                    </div>
                    <div class="col-md-7">
                        <form id="form-checkout">
                            @csrf
                            <div class="form-group">
                                <label for="receiver">Receiver:</label>
                                <input type="text" class="form-control" id="checkout-receiver" name="receiver"
                                       placeholder="Receirver">
                            </div>
                            <div class="form-group">
                                <label for="place">Place:</label>
                                <input type="text" class="form-control" id="checkout-place" name="place"
                                       placeholder="Place">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="checkout-email" name="email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" name="phone" id="checkout-phone"
                                       placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <textarea class="form-control" name="note" id="checkout-note"
                                          placeholder="Note"></textarea>
                            </div>
                            <button type="submit" class="button btn-default" id="btn_checkout">Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
