<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use DB;
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
        $total = array();
        $date = array();
        $sql = Order::orderBy('created_at', 'asc')->where("status", 1)->whereNotNull('created_at')->groupBy(DB::raw('Date(created_at)'))->selectRaw('sum(total) as total , created_at')->get();
        if (!empty($sql)) {
            foreach ($sql as $key => $value) {
            array_push($total, (int) $value->total);
            array_push($date, Carbon::parse($value->created_at)->format('d-m-Y'));
            }
        }
           $chart1 = \Chart::title([
        'text' => 'Tổng doan thu trong tháng',
    ])
    ->chart([
        'type'     => 'line', // pie , columnt ect
        'renderTo' => 'chart1', // render the chart into your div with id
    ])
    ->subtitle([
        'text' => 'Doanh thu đơn hàng trong 15 ngày',
    ])
    ->colors([
        '#0c2959'
    ])
    ->xaxis([
        'categories' => $date,
        'labels'     => [
            'rotation'  => 15,
            'align'     => 'top',
        ],
    ])
    ->yaxis([
        'text' => 'This Y Axis',
    ])
    ->legend([
        'layout'        => 'vertikal',
        'align'         => 'right',
        'verticalAlign' => 'middle',
    ])
    ->series(
        [
            [
                'name'  => 'Tổng tiền',
                'data'  => $total,
            ],
        ]
    )
    ->display();

        return view('admin.index', compact('chart1'));
    }
}
