<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Orderdetail;
use App\Subwaycustomer;

use DB;

class OrderController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
    //view orders in admin panel
    public function orders()
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
        orders.`status`
        FROM
        orders
        GROUP BY(orders.orderid)
            
        ");
        
        return view('order.ordersinfo',['order' => $orderdetail]);
    }

    //order fetch
    public function orderdetail(Request $req,$id)
    {
        //dd($id);
            
            //$id = $req->get('id');
            /*$orderdetail = DB::table('orders')->
            Join('orderdetails','orders.orderid','orderdetails.orderid','orderdetails.itemid','orders.itemid')->
            where('orders.orderid',$id)->get();*/

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
            return response()->json($orderdetail);
    }
    public function report($id)
    {
        return view('subway.report',['id' =>$id]);
    }
}
