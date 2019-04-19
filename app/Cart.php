<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($product, $topping, $size)
    {
        // khởi tạo cart
        $cart = [
            'qty' => 0,
            'price' => 0,
            'size' => $size,
            'product' => $product,
            'topping' => $topping,
        ];

        // set key theo mã sản phẩm
        $key = $product->id;
        $totalToppingPrice = 0;

        if ($topping != null) {
            // tính gía các topping trong 1 cốc
            $totalToppingPrice = array_sum($topping->pluck('price')->toArray());

            // nếu có topping thì đổi key vừa set theo format : key = product_id + topping_1 + ... + topping_n
            // VD: product 1, topping 1 + 2 => key = 112
            $key = $product->id . implode($topping->pluck('id')->toArray());
        }

        // this->item được truyền từ session('cart'), mặc định = null
        // kiểm tra biến item có null hay không
        if ($this->items) {
            // kiểm tra key va gán cart cho cart cũ
            if (array_key_exists($key, $this->items)) {
                $cart = $this->items[$key];
            }
        }

        $cart['qty']++;
        $this->totalQty++;

        // tổng tiền topping trong 1 cốc
        $sizePrice = $product->price * $cart['size']->percent / 100; // tính gía size
        $productPrice = $product->price; // gía sản phẩm ban đầu
        $price = $productPrice + $sizePrice + $totalToppingPrice; // gía sản phẩm sau cùng

        $cart['price'] = $price * $cart['qty']; // tính lại gía của 1 cốc
        $this->totalPrice += $price; // cộng tổng gía của cả giỏ hàng

        // truyền key cho sản phẩm trong giỏ để phân biệt
        $this->items[$key] = $cart;
    }

    public function plus($cartId)
    {
        if (isset($this->items[$cartId])) {
            $cart = $this->items[$cartId];

            $cart['qty']++;
            $this->totalQty++;

            $totalToppingPrice = 0;
            if ($cart['topping']) {
                $totalToppingPrice = array_sum($cart['topping']->pluck('price')->toArray());
            }

            $sizePrice = $cart['product']->price * $cart['size']->percent / 100;
            $productPrice = $cart['product']->price;
            $price = $productPrice + $sizePrice + $totalToppingPrice;

            $cart['price'] = $price * $cart['qty'];
            $this->totalPrice += $price;

            // item
            $this->items[$cartId] = $cart;
        } else {
            return back()->with('fail', __('message.fail.find'));
        }
    }

    // tru 1
    public function minus($cartId)
    {
        if (isset($this->items[$cartId])) {
            $this->items[$cartId]['qty']--;
            $this->items[$cartId]['price'] -= $this->items[$cartId]['product']['price'];
            $this->totalQty--;
            $this->totalPrice -= $this->items[$cartId]['price'];

            if($this->items[$cartId]['qty'] <= 0){
                unset($this->items[$cartId]);
            }
        }
    }

    // xoa 1 sp
    public function removeItem($cartId)
    {
        if (isset($this->items[$cartId])) {
            $this->totalQty -= $this->items[$cartId]['qty'];
            $this->totalPrice -= $this->items[$cartId]['price'];

            unset($this->items[$cartId]);
        }
    }
}
