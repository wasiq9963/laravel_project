<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use App\Cart;
use App\Customer;
use App\Subdetail;
use App\Subwaycustomer;
use App\Order;
use App\Orderdetail;
use DB;
class SubwayController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        //$cartcontent = Cart::getContent();
        return view('subway.index',['categories' => $categories]);
    }
    public function items(Request $req)
    {
        //products fetch
        if ($req -> ajax())
        {
            $id = $req->get('data');
            $query = $req->get('query');
            if ($id != '')
            {
                if ($query !='') 
                {
                    $items = Item::where('categoryid', $id)->
                    orwhere('itemname','LIKE', '%'.$query.'%')->limit(12)->get();
                    return response()->json(['result' => $items]);
                }
                else
                {
                    $items = Item::where('categoryid', $id)->limit(12)->get();
                    return response()->json(['result' => $items]);
                }
            }
            else
            {
                    $items = Item::where('itemname','LIKE', '%'.$query.'%')->limit(12)->get();
                    return response()->json(['result' => $items]);
            }
        }
    }
    public function singleitem(Request $req)
    {
        if($req -> ajax())
        {
            $id = $req->get('id');
            $singleitem = DB::table('items')
            ->join('categories','items.categoryid','categories.id')->where('itemid',$id)->first();
            return response()->json(['result' => $singleitem]);
        }
    }
    //add to cart
    public function addtocart(Request $req)
    {
        $sessionid = Session()->getId();
        if ($req -> ajax())
        {
            $id = $req->get('id');

            $cartitem = Cart::where('item_id',$id)->
            where('status','temporary')->
            where('session_id',$sessionid)->first();
            if ($cartitem != null)
            {
                $cart = Cart::where('cartid',$cartitem->cartid)->first();
                $cart->quantity = $cartitem->quantity  + 1;
                $cart->save();
                return response()->json(['result' => 'Item Updated']);
            }
            else
                {
                    $item = Item::where('itemid',$id)->first();//fetch item price and name
                    $cart = new Cart;
                    $cart->session_id = $sessionid;
                    $cart->cart_date = date("Y-m-d");
                    $cart->item_id = $id;
                    $cart->item_name = $item-> itemname;
                    $cart->price = $item -> price;
                    $cart->quantity = 1;
                    $cart->status = 'temporary';
                    $cart->save();
                    return response()->json(['result' => 'Item Added']);
                }
        }
    }
    //get cart items
    public function getcartitems(Request $req)
    {
        if($req -> ajax())
        {
            $sessionid = Session()->getId();
            $carts = Cart::where('status','temporary')->
            where('session_id',$sessionid)->get();
            $totalqty = $carts->sum('quantity');
            //$total = $carts->sum('quantity * price');
            return response()->json(['result' => $carts,'qtys' => $totalqty]);
        }
    }
    //delete cart items
    public function removecart(Request $req)
    {
        if ($req -> ajax())
        {
            $sessionid = Session()->getId();
            $id = $req->get('id');
            $cartitem = Cart::where('cartid',$id);
            $cartitem->delete();
            return response()->json(['result' => 'Item Removed']);
        }
    }
    //update cart items
    public function updatecart(Request $req)
    {
        if ($req -> ajax())
        {
            $id = $req->get('id');
            $qty = $req->get('qty');
            $cart = Cart::where('cartid',$id)->first();
            $cart->quantity = $qty;
            $cart->save();
            return response()->json(['result' => 'Item Updated']);
        }
    }
    //order place work
    public function orderplace(Request $req)
    {
        if ($req -> ajax())
        {
            //order insert work
            $data = $req->get('data');
            $order = new Order;
            $order->status = 'Delivering';
            $order->total_amount = $data;
            $order->save();
            if ($order)
            {
                //get cart item and update status
                $sessionid = Session()->getId();
                $cart = Cart::where('status','temporary')->
                where('session_id',$sessionid)->get();
                foreach ($cart as $value) 
                {
                    $value->status = 'conform';
                    $value->save();

                    //insert orderdetail work
                    $orderdetail = new Orderdetail;
                    $orderdetail->orderid = $order->id;
                    $orderdetail->cartid = $value->cartid;
                    $orderdetail->orderdate = date('Y-m-d');
                    $orderdetail->save();
                }
                return response()->json(['result' => 'Order place SuccessFully']);
            }
            else
            {
                return response()->json(['result' => 'Order Not place']);
            } 
        }
    }
    //view orders in admin panel
    public function orders()
    {
        //$orderdetail = Orderdetail::where('orderdate',date('Y-m-d'))->distinct()->get('orderid');
        //$orderdetail = DB::table('Orderdetails')->join('orders','Orderdetails.orderid','orders.id')->
        //join('carts','Orderdetails.cartid','carts.cartid')->where('orderdate',date('Y-m-d'))->distinct()->get(['orderid','total_amount','orderdate']);
        $orderdetail = DB::select("SELECT
        orderdetails.id,
        orderdetails.orderid,
        orderdetails.cartid,
        orderdetails.orderdate,
        orders.`status`,
        orders.total_amount,
        orders.id,
        carts.cartid,
        carts.cart_date,
        carts.item_id,
        carts.quantity,
        carts.price
        FROM
        orderdetails
        INNER JOIN orders ON orders.id = orderdetails.orderid
        INNER JOIN carts ON carts.cartid = orderdetails.cartid    
        ");
        
        return view('order.ordersinfo',['order' => $orderdetail]);
    }

    //cart clear work
    public function cartclear(Request $req)
    {
        if ($req -> ajax())
        {            
            $sessionid = Session()->getId();
            $cart = Cart::where('session_id',$sessionid)->get();

            foreach ($cart as $value) 
            {
                $subdetail = Subdetail::where('cartitem_id',$value->cartid)->delete();            
            }
            $cart = Cart::where('session_id',$sessionid)->delete();
            
            return response()->json(['result' => 'Cart Clear SuccessFully']);
        }
    }

    //sub detail add work
    public function subdetail(Request $req)
    {
        //dd($req);
        $detail = new Subdetail();
        $detail->cartitem_id = $req->id;
        $detail->cheese = $req->cheese;
        $detail->extra_cheese = $req->extracheese;
        $detail->sauces = implode(',',$req->sauces)   ;
        $detail->vegetables = implode(',',$req->vegetable);
        $detail->extra_meat_topping_is_free = $req->extra;
        $detail->save();
        return response()->json(['result' => 'Detail Added']);
    }
    public function fetchsubdetail(Request $req)
    {
        if ($req -> ajax())
        {
            $id = $req->get('data');
            $getdetail = Subdetail::where('cartitem_id',$id)->first();
            if ($getdetail != '')
            {
                return response()->json(['result' => $getdetail]);
            }
            else
            {
                return response()->json(['error' => 'No Record']);
            }
        }
    }
    //subway customer insert
    public function customerinsert(Request $req)
    {
        $insertform = array(
            'name' => 'required',
            'mobile_number' => 'required',
            'landline_number' => 'required',
            'contact_person' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'store' => 'required',
            'area' => 'required',
            'example' => 'required',


            /*[
                'txt_name.required' => 'Full Name Is Required',
                'txt_phoneno.required' => 'Phone No Is Required',
                'txt_email.required' => 'Email Is Required',
                'txt_address.required' => 'Address Is Required',
                'txt_ntn.required' => 'NTN Number Is Required',
                'txt_openbalance.required' => 'Upening Balance is Required Is Required',
            ]*/
        );
        $validator = Validator::make($req->all(),$insertform);

        if ($validator -> passes())
        {
            $customerinser = new Subwaycustomer();
            $customerinser->name = $req->name;
            $customerinser->mobile_number = $req->mobile_number;
            $customerinser->landline_number = $req->landline_number;
            $customerinser->contact_person = $req->contact_person;
            $customerinser->delivery_address = $req->address;
            $customerinser->landmark = $req->landmark;
            $customerinser->store = $req->store;
            $customerinser->area = $req->area;
            $customerinser->foodorder = $req->example;
            $customerinser->save();
            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' =>$validator->errors()->all()]);
        }
    }
    public function customerinfo(Request $req)
    {
        if ($req -> ajax())
        {
            $data = $req->get('data');
            $customer = Subwaycustomer::where('mobile_number',$data)->first();

            if ($customer != '')
            {
                return response()->json(['result' => $customer]);
            }
            else
            {
                return response()->json(['error' => 'Contact Number Not Found Add New Customer']);
            }
        }
    }
}
