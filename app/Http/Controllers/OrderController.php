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
        
        $data = $req->get('query');
        if (Auth::user()->role == 'Admin')
        {
            if ($data != '')
            {
                $orderdetail = DB::select("SELECT
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
                WHERE orders.store = '$data'
                GROUP BY(orders.orderid) 
                ");
                return view('order.ordersinfo',['order' => $orderdetail,'store' =>$store]);

                //return response()->json(['order' => $orderdetail]);
            }
            else
            {
                $orderdetail = DB::select("SELECT
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
                GROUP BY(orders.orderid) 
                ");
                return view('order.ordersinfo',['order' => $orderdetail,'store' =>$store]);

                //return response()->json(['order' => $orderdetail]);
            }
        }
        else
        {
            $data = Auth::user()->store;
            $orderdetail = DB::select("SELECT
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
            WHERE orders.store = '$data'
            GROUP BY(orders.orderid) 
            ");
            return view('order.ordersinfo',['order' => $orderdetail,'store' =>$store]);
                //return response()->json(['order' => $orderdetail]);
        }

        //return view('order.ordersinfo',['store' =>$store]);
    }
    //view orders in admin panel
    public function orders(Request $req)
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
    }

    //order fetch
    public function orderdetail(Request $req,$id)
    {
        $orderdetail = DB::select("SELECT
        orders.id,
        orders.orderid,
        orders.itemid,
        orders.store,
        orders.itemname,
        orders.quantity,
        orders.price,
        orders.itemdate,
        orders.`status`,
        orderdetails.cheese,
        orderdetails.extra_cheese,
        orderdetails.sauces,
        orderdetails.vegetables,
        orderdetails.extra_meat_topping_is_free,
        subwaycustomers.`name`,
        subwaycustomers.mobile_number,
            subwaycustomers.delivery_address
        FROM
        orders
        INNER JOIN orderdetails ON orders.orderid = orderdetails.orderid AND orderdetails.itemid = orders.itemid
        INNER JOIN subwaycustomers ON orders.customerid = subwaycustomers.id
        WHERE
        orders.orderid = $id        
        ");
        return view('subway.demo',['data' =>$orderdetail]);
    }
    public function report($id)
    {
        return view('subway.report',['id' =>$id]);
    }
}
