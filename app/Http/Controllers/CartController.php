<?php

namespace App\Http\Controllers;

use App\Category;
use Session;
use Hash;
use Auth;
use Carbon\Carbon;

use App\Cart;
use App\User;
use App\OrderDetailToping;
use App\OrderDetail;
use App\Order;
use App\Size;
use App\Topping;
use App\Product;
use App\Image;
use App\Repositories\Repository;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;

class CartController extends Controller
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
        $cart = [];
        if (Session::has('cart')) {
            $oldCart = Session('cart');
            $cart = new Cart($oldCart);
            $data = [
                'cart' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty,
            ];
            $items = [];
            foreach ($data['cart'] as $key => $value) {
                $item = $value;
                $item['key'] = $key;
                $id_sp = $value['product']->id;
                $image_main = Image::where('product_id', $id_sp)
                    ->orderBy('active', 'desc')
                    ->orderBy('id', 'desc')->first();
                $item['image'] = $image_main->name;
                $items[] = $item;
            }
            $cart = [
                'items' => $items,
                'totalPrice' => $data['totalPrice'],
                'totalQty' => $data['totalQty'],
            ];
        }

        return $cart;
    }

    public function add(Request $req)
    {
        $product = Product::findOrFail($req->product);
        $size = Size::findOrFail($req->size);

        if ($req->topping) {
            $topping = Topping::findOrFail($req->topping);
        } else {
            $topping = null;
        }

        $oldCart = Session('cart') ? Session('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $topping, $size);
        $req->session()->put('cart', $cart);
    }

    public function plus($cartId)
    {
        $oldCart = Session('cart') ? Session('cart') : null;
        $cart = new Cart($oldCart);
        $cart->plus($cartId);
        session()->put('cart', $cart);

        return redirect(route('user.cart.index'));
    }

    // delete 1 product
    public function minus($cartId)
    {
        $oldCart = Session('cart') ? Session('cart') : null;

        if ($oldCart) {
            $cart = new Cart($oldCart);
            $cart->minus($cartId);

            if (count($cart->items) == 0) {
                session::forget('cart');
            } else {
                session(['cart' => $cart]);
            }
        }

        return back();
    }

    public function deleteOne($cartId)
    {
        $oldCart = Session('cart') ? Session('cart') : null;

        if ($oldCart) {
            $cart = new Cart($oldCart);
            $cart->removeItem($cartId);

            if (count($cart->items) == 0) {
                session::forget('cart');
            } else {
                session(['cart' => $cart]);
            }
        }

        return back();
    }

    public function destroy()
    {
        if (Session('cart')) {
            session()->forget('cart');
        }

        return back();
    }

    public function checkout(OrderRequest $req)
    {
        $cart = session('cart');

        $id = null;
        if (Auth::id()) {
            $id = Auth::id();
        }

        $dateTime = new \DateTime;

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now = new \DateTime();

        $order = $this->orderModel->create([
            'receiver' => $req->name,
            'user_id' => $id,
            'order_time' => $now->format('Y-m-d H:i:s'),
            'order_place' => $req->order_place,
            'order_phone' => $req->order_phone,
            'status' => 0,
            'note' => $req->note,
        ]);

        foreach ($cart->items as $key => $value) {
            $orderDetail = $this->orderDetailModel->create([
                'product_id' => $cart->items[$key]['product']->id,
                'product_price' => $cart->items[$key]['product']->price,
                'order_id' => $order->id,
                'size_id' => $cart->items[$key]['size']->id,
                'quantity' => $cart->items[$key]['qty'],
            ]);

            if ($value['topping']) {
                foreach ($value['topping'] as $k => $v) {
                    $orderDetail->toppings()->attach(
                        $v->id,
                        [
                            'topping_price' => $v->price,
                        ]
                    );
                }
            }
        }

        session()->forget('cart');

        return back()->with('success', __('message.success.order'));
    }
}
