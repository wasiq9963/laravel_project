<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use DB;
use App\Subwaycustomer;
use App\Item;

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
            $orderdetail = DB::table('orders')
            ->where('itemdate',$date)
            ->select('*',DB::raw('count(itemid) as items'),DB::raw('SUM(quantity * price) as total'))
            ->groupby('orderid')
            ->orderby('orderid','DESC')
            ->get();

            //count order
            $itemscount = Order::where('itemdate',$date)->count();
            $orderscount = DB::table('orders')
                ->where('itemdate',$date)
                ->select('orderid', DB::raw('count(orderid) as total'))
                ->groupBy('orderid')
                ->get();
    
            //total amount
            $amount = Order::where('itemdate',$date)
            ->select(DB::raw('sum(quantity * price) as total'))->first();
        }
        else
        {
            $orderdetail = DB::table('orders')
            ->where('itemdate',$date)
            ->where('store',$data)
            ->select('*',DB::raw('count(itemid) as items'),DB::raw('SUM(quantity * price) as total'))
            ->groupby('orderid')
            ->orderby('orderid','DESC')
            ->get();

            //count order
            $itemscount = Order::where('itemdate',$date)
            ->where('store',$data)
            ->count();
            $orderscount = DB::table('orders')
                ->where('itemdate',$date)
                ->where('store',$data)
                ->select('orderid', DB::raw('count(orderid) as total'))
                ->groupBy('orderid')
                ->get();
    
            //total amount
            $amount = Order::where('itemdate',$date)
            ->where('store',$data)
            ->select(DB::raw('sum(quantity * price) as total'))->first();
        }

        //total customer
        $customer = Subwaycustomer::count();

        return view('subway.subwaydashboard',['orderinfo' => $orderdetail,
        'itemscount' => $itemscount,
        'orderscount' => $orderscount,
        'customer' => $customer,
        'amount' => $amount,
        ]);

        
    }
}
