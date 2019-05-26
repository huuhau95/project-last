<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Image;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order_detail');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderDetails = OrderDetail::with('product', 'size', 'toppings')->where('order_id', $id)->get();
        $index = 0;

        foreach ($orderDetails as $orderDetail) {
            $priceProduct = $orderDetail->product_price * $orderDetail->quantity;
            $priceTopping = 0;

            foreach ($orderDetail->toppings as $topping) {
                $priceTopping += $topping->pivot->topping_price;
            }

            $orderDetails[$index]->price = $priceProduct + $priceTopping;
            $orderDetails[$index]->status = $order->status;
            $index++;
        }

        return $orderDetails;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateQuantity(Request $request)
    {
        $orderDetail = OrderDetail::findOrFail($request->id);

        $orderDetail->quantity = $request->quantity;

        $orderDetail->save();
    }

    public function showJson($id)
    {
        $order = Order::findOrFail($id);
        $orderDetails = OrderDetail::with('product', 'size', 'toppings')->where('order_id', $id)->get();
        $index = 0;

        foreach ($orderDetails as $orderDetail) {
            $priceProduct = $orderDetail->product_price * $orderDetail->quantity;
            $priceTopping = 0;

            foreach ($orderDetail->toppings as $topping) {
                $priceTopping += $topping->pivot->topping_price;
            }

            $orderDetails[$index]->price = $priceProduct + $priceTopping;
            $orderDetails[$index]->status = $order->status;
            $index++;
        }

        return $orderDetails;
    }

    public function showDetail(Request $request)
    {
        $order_id = $request->order_id;
        $detail_id = $request->detail_id;
        $orderDetails = OrderDetail::with('product', 'size', 'toppings')->where('order_id', $order_id)->get();
        $index = 0;

        foreach ($orderDetails as $orderDetail) {
            $priceProduct = $orderDetail->product_price * $orderDetail->quantity;
            $priceTopping = 0;

            foreach ($orderDetail->toppings as $topping) {
                $priceTopping += $topping->pivot->topping_price;
            }

            $orderDetails[$index]->price = $priceProduct + $priceTopping;
            $index++;
        }
        $orderDetailResult = null;

        foreach ($orderDetails as $orderDetail) {

            if ($orderDetail->id == $detail_id) {
                $orderDetailResult = $orderDetail;
                break;
            }
        }

        return $orderDetailResult;
    }

}
