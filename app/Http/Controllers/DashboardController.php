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
        $date = date('Y-m-d');

        //Fetch order
        if (Auth::user()->role == 'Admin')
        {
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
            WHERE orders.itemdate = '$date'
            GROUP BY(orders.orderid) 
            ");

            //count order
            $itemscount = Order::count();
            $orderscount = DB::table('orders')
            ->select('orderid', DB::raw('count(orderid) as total'))
            ->groupBy('orderid')
            ->get();
            
        }
        else
        {
            $date = date('Y-m-d');
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
            WHERE orders.store = '$data' AND orders.itemdate = '$date'
            GROUP BY(orders.orderid) 
            ");

            //count order
            $itemscount = Order::where('store',$data)->count();
            $orderscount = DB::table('orders')
            ->select('orderid', DB::raw('count(orderid) as total'))
            ->groupBy('orderid')
            ->where('store',$data)
            ->get();
        }

        return view('subway.subwaydashboard',['orderinfo' => $orderdetail,
        'itemscount' => $itemscount,
        'orderscount' => $orderscount,
        ]);
    }

    //total drink

    //$cat = Category::where('categoryname','Drink Item');
}
