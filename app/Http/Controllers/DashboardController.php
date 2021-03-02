<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Auth::user()->store;
        //Fetch order
        $orderdetail = DB::select("SELECT
        orders.id,
        orders.orderid,
        orders.itemid,
        orders.store,
        orders.itemname,
        COUNT(orders.id) as id,
        SUM(orders.quantity) as quantity,
        SUM(orders.price * orders.quantity) as price,
        orders.itemdate,
        orders.status
        FROM
        orders
        WHERE orders.store = '$data'
        GROUP BY(orders.orderid) 
        ");

        //count order
        $ordercount = Order::where('store',$data)->groupBy('orderid');
        $count = $ordercount->count();


        return view('subway.subwaydashboard',['orderinfo' => $orderdetail,'count' => $count]);
    }
}
