<?php

namespace App;

use Illuminate\Support\Facades\Session;

class Cart1
{
    private $cart = [];

    public function __construct()
    {
        $this->cart = Session::get('cart', []);
    }

    public function addProduct($product, $color, $size)
    {

        $key = implode('-', [$product->id, $size, $color]);
        $item_new = [
            'product' => $product,
            'quantity' => 1,
            'size' => $size,
            'color' => $color,
            'product_price' => $product->price,
            'product_discount' => $product->discount,
        ];
        $item_new_price = $product->price  * (1 - $product->discount/100);
        if (empty($this->cart)) {
            $this->cart[] = [
                'key' => $key,
                'item' => $item_new,
            ];
        } else {
            $flat = false;
            $index = 0;
            for ($i = 0; $i < count($this->cart); $i++) {
                if ($this->cart[$i]['key'] == $key) {
                    $flat = true;
                    $index = $i;
                    break;
                }
            }
            if ($flat) {
                $this->cart[$index]['item']['quantity'] += 1;
            } else {
                $this->cart[] = [
                    'key' => $key,
                    'item' => $item_new,
                ];
            }
        }
        Session::put('cart', $this->cart);
    }

    public function update_cart($keyCart, $quantity) {
        for ($i = 0; $i < count($this->cart); $i++) {
            if ($this->cart[$i]['key'] == $keyCart) {
                $this->cart[$i]['item']['quantity'] = $quantity;
            }
        }
        Session::put('cart', $this->cart);
    }


    public function removeItem($keyCart)
    {
        for ($i = 0; $i < count($this->cart); $i++) {
            if ($this->cart[$i]['key'] === $keyCart) {
                unset($this->cart[$i]);
                break;
            }
        }
        $data = [];
        foreach ($this->cart as $cart) {
            $data[] = $cart;
        }

        Session::put('cart', $data);
    }

    public function removeAll()
    {
        Session::put('cart', []);
    }
}
