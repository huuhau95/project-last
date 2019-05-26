<?php
namespace App\Http\Controllers;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\Client_UserRequest;
use App\Http\Requests\ContactRequest ;
use App\Mail\InforOrder;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use App\Contact;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Repositories\Repository;
class ClientController extends Controller
{
    protected $orderModel;
    protected $orderDetailModel;
    function __construct(Order $orderModel, OrderDetail $orderDetailModel)
    {
        $this->orderModel = new Repository($orderModel);
        $this->orderDetailModel = new Repository($orderDetailModel);
    }
    public function changeLanguage($language)
    {
        Session::put('website_language', "vi");
        return redirect()->back();
    }
    public function index()
    {
        $best_sale_product = Product::where("selling", 1)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        $products = Product::with(['images' => function ($query) {
                $query->get();
            }])
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        //recent view
        $slides = Slide::get();
        return view('index', compact('products', 'slides', 'best_sale_product'));
    }
    public function search(Request $request)
    {
        $keyword = $request->product;
        $category = $request->category;
        if($category==0){
            $products = Product::where('name', 'like', '%' . $keyword . '%')->paginate(12);
        }else{
            $products = Product::where('name', 'like', '%' . $keyword . '%')->where("category_id", $category)->paginate(12);
        }
        return view('product_list', compact('products'));
    }
    public function detailProduct($id)
    {
        $product = Product::with('category')->with(['images' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->findOrFail($id);
        $products = Product::with('category')->with(['images' => function ($query) {
            $query->orderBy('id', 'desc')->get();
        }])->where('category_id', '=', $product->category->id)
            ->whereNotIn('id', [$product->id])
            ->limit(3)->get();
        //revent_view
        $arr = Session::get('recent_view', []);
        $key = in_array($id, $arr);
        if (!$key) {
            $arr[] = $id;
        }
        Session::put('recent_view', $arr);
        return view('product_detail', compact('product', 'products'));
    }
    public function detailProductData($id)
    {
        $product = Product::with('category')->with(['images' => function ($query) {
            $query->orderBy('id', 'desc')->first();
        }])->findOrFail($id);
        return $product;
    }
    public function orders()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $orders = Order::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(8);
            return view('order', compact('orders'));
        }
        return abort(404);
    }
    public function order_details($order_id)
    {
        $orderDetails = OrderDetail::with('product', 'size', 'toppings')->where('order_id', $order_id)->get();
        return $orderDetails;
    }
    public function cancel_order($order_id)
    {
        $order = Order::findOrfail($order_id);
        $order->status = -1;
        $order->save();
    }
    public function cart()
    {
        $carts = [];
        if (Session::has('cart')) {
            $carts = Session('cart');
        }
        return view('cart', compact('carts'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }
    public function registerPost(Client_UserRequest $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $name = $file->getClientOriginalName();
            $newName = str_random(4) . '_' . $name;
            while (file_exists(config('asset.image_path.avatar') . $newName)) {
                $newName = str_random(4) . '_' . $name;
            }
            $file->move(config('asset.image_path.avatar'), $newName);
            $image = $newName;
        } else {
            $image = null;
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->image = $image;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role_id = 3;
        $user->save();
    }
    public function checkout(CheckoutRequest $request)
    {
        session()->forget('status-cart');
        $cart = session('cart');
        $id = null;
        if (Auth::id()) {
            $id = Auth::id();
        }
        $dateTime = new \DateTime;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new \DateTime();
        $total = 0;
        foreach ($cart as $product) {
            $total+=$product['item']['product_price']*$product['item']['quantity'];
        }
        $order = $this->orderModel->create([
            'receiver' => $request->receiver,
            'user_id' => $id,
            'order_time' => $now->format('Y-m-d H:i:s'),
            'order_place' => $request->place,
            'order_phone' => $request->phone,
            'order_email' => $request->email,
            'total' => intval($total),
            'status' => 0,
            'note' => $request->note,
        ]);
        foreach ($cart as $product) {
            $orderDetail = $this->orderDetailModel->create([
                'product_id' => $product['item']['product']->id,
                'product_price' => $product['item']['product_price'],
                'order_id' => $order->id,
                'size' => $product['item']['size'] ? $product['item']['size'] : '',
                'color' => $product['item']['color'] ? $product['item']['color'] : '',
                'quantity' => $product['item']['quantity'],
                'status' => 0,
            ]);
        }
        session()->put('status-cart', true);
        Session::forget('cart');
    }
    public function showProductByCate(Request $request){
        $products = Product::where("category_id", $request->category_id)->paginate(8);;
        return view("product_list", compact('products', $products));
    }
    public function getContact(){
        return view("contact");
    }
    public function postContact (ContactRequest $request){
        $contact = Contact::create($request->all());
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đóng góp ý kiến. Chúng tôi sẽ liên hệ với bạn sớm nhất');
    }
}
