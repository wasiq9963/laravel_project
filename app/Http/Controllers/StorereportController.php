<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Store;
use App\Order;
use DB;

class StorereportController extends Controller
{
    public function index(Type $var = null)
    {
        $store = Store::all();

        return view('subway.storereport',['store' => $store]);
    }

    public function storefetch(Request $req)
    {
        $store = $req->store;
        $from = $req->from;
        $to = $req->to;

        if ($store == null)
        {
            $order = DB::table('orders')
            ->whereBetween('itemdate', array($from, $to))
            ->select('*',DB::raw('count(orderid) as num'),DB::raw('SUM(quantity * price) as amount'))
            ->groupby('orderid')
            ->orderby('store')
            ->orderby('itemdate')
            ->get();
            return response()->json($order); 
        }
        else
        {
            $order = DB::table('orders')
            ->where('store',$store)
            ->whereBetween('itemdate', array($from, $to))
            ->select('*',DB::raw('count(orderid) as num'),DB::raw('SUM(quantity * price) as amount'))
            ->groupby('orderid')
            ->orderby('store')
            ->orderby('itemdate')
            ->get();
            return response()->json($order);
        }

         /*$filename = "order.json";
         $handle = fopen($filename, 'w+');
         fputs($handle, $order->toJson(JSON_PRETTY_PRINT));
         fclose($handle);
         $headers = array('Content-type'=> 'application/json');
         return response()->download($filename,'order.json',$headers);*/
    }

    public function report(Request $req)
    {
        //dd($req->all());
        $storename = $req->store;
        $fromdate = $req->from;
        $todate = $req->to;
        $input   = $req->getQueryString();
        return view('order.orderlistreport',['store' => $storename, 'from' => $fromdate, 'to' => $todate]);
    }
}
