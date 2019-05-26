<?php

namespace App\Http\Controllers;

use App\Cart1;
use App\Product;
use App\Size;
use App\Topping;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OrderRequest;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Repository;
use App\Order;
use App\OrderDetail;

class Cart1Controller extends Controller
{
    protected $orderModel;
    protected $orderDetailModel;

    function __construct(Order $orderModel, OrderDetail $orderDetailModel)
    {
        $this->orderModel = new Repository($orderModel);
        $this->orderDetailModel = new Repository($orderDetailModel);
    }

    public function cart()
    {
        $data = [];
        if (Session::has('cart')) {
            $data = Session('cart');
        }

        return response()->json($data);
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product);
        $size = $request->size ? $request->size : '';
        $color = $request->color ? $request->color : '';

        $image_main = Image::where('product_id', $request->product)
            ->orderBy('id', 'desc')->first();
        $product->image = $image_main->name;
        $cart = new Cart1();
        $cart->addProduct($product, $color, $size);
    }

    public function reduce_quantity(Request $request)
    {
        $cart = new Cart1();
        $cart->reduce_quantity($request->key);
        return redirect()->route('client.showCart');
    }

    public function increase_quantity(Request $request)
    {
        $cart = new Cart1();
        if ($request->quantity <= 0) {
           $request->quantity = 1;
        }
        if ($request->quantity > 10) {
           $request->quantity = 10;
        }
        $cart->update_cart($request->key, $request->quantity);

        return redirect()->route('client.showCart');
    }

    public function delete(Request $request)
    {
        $cart = new Cart1();

        $cart->removeItem($request->key);

        return redirect()->route('client.showCart');
    }

    public function removeAll()
    {
        $cart = new Cart1();

        $cart->removeAll();

        return redirect()->route('client.showCart');
    }
}
