<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Orderdetail;
use App\Subwaycustomer;
use App\Store;
use Auth;
use DataTables;

use DB;

class OrderController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $req)
    {
        $store = Store::all();  
        
        //$data = $req->get('query');
        $date = date('Y-m-d');
        $storedata = Auth::user()->store;
        if (Auth::user()->role == 'Admin')
        {
            $orderdetail = DB::table('orders')->where('itemdate',$date)
                    ->select('*',DB::raw('SUM(quantity) as quantity'),DB::raw('SUM(quantity * price) as price'))
                    ->groupby('orderid')
                    ->orderby('orderid','DESC')
                    ->get();
                return view('order.ordersinfo',['order' => $orderdetail,'store' =>$store]);
                //orders.store = '$data' AND
                //return response()->json(['order' => $orderdetail]);
        }
        else
        {
            $orderdetail = DB::table('orders')
            ->where('itemdate',$date)
            ->where('store',$storedata)
            ->select('*',DB::raw('SUM(quantity) as quantity'),DB::raw('SUM(quantity * price) as price'))
            ->groupby('orderid')
            ->orderby('orderid','DESC')
            ->get();
            return view('order.ordersinfo',['order' => $orderdetail,'store' =>$store]);
        }

    }
    //view orders in admin panel
    /*public function orders(Request $req)
    {
        $query = $req->get('query');
        if ($req->ajax()) {
            $data = DB::select("SELECT
            orders.id,
            orders.orderid,
            orders.itemid,
            orders.store,
            orders.itemname,
            SUM(orders.quantity) as quantity,
            SUM(orders.price * orders.quantity) as price,
            orders.itemdate,
            orders.status
            FROM
            orders
            WHERE orders.store = '$query'
            GROUP BY(orders.orderid) 
            ");
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a target="_blank" href="" class="btn btn-block btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                           ';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('order.ordersinfo');
    }*/

    //order fetch
    public function orderdetail(Request $req,$id)
    {
        $orderdetail = DB::table('orders')
        ->select('*')
        ->join('orderdetails',function($join){
            $join->on("orderdetails.orderid","=","orders.orderid")
                ->on("orderdetails.itemid","=","orders.itemid");}) 
        ->join('subwaycustomers','subwaycustomers.id', '=', 'orders.customerid')
        ->where('orders.orderid', $id)
        ->get();
        return response()->json($orderdetail);
    }
    public function report($id)
    {

        $order = Order::where('orderid',$id)->get();

        foreach ($order as $value)
        {
            $value->status = 'Viewed';
            $value->save();
        }

        return view('subway.report',['id' =>$id]);
    }
}
