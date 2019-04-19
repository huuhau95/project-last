<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $successOrder = Order::where('status', 1)->get();
        $canceledOrder = Order::where('status', -1)->get();
        $popularProduct = OrderDetail::with('product.images')
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        return view('admin.index', compact('successOrder', 'canceledOrder', 'popularProduct'));
    }
}
