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
use App\Store;
use DB;
class SubwayController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $req)
    {
        $categories = Category::all();
        //$cartcontent = Cart::getContent();

        //fetch store
        $store = Store::all();
        
        return view('subway.index',['categories' => $categories, 'store' => $store]);
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
        $sessionid =Session()->getId();
        if ($req -> ajax())
        {
            $id = $req->get('id');

            $cartitem = Cart::where('item_id',$id)->
            where('status','temporary')->
            where('username','wasiq')->
            where('session_id',$sessionid)->first();
            if ($cartitem != null)
            {
                $cart = Cart::where('id',$cartitem->id)->first();
                $cart->quantity = $cartitem->quantity  + 1;
                $cart->save();
                return response()->json(['result' => 'Item Updated']);
            }
            else
            {
                $cartdetail = Cart::where('session_id',$sessionid)->first();
                if ($cartdetail != null)
                {
                    $item = Item::where('itemid',$id)->first();//fetch item price and name
                    $cart = new Cart;
                    $cart->cartid = $cartdetail->cartid;
                    $cart->session_id = $sessionid;
                    $cart->cart_date = date("Y-m-d");
                    $cart->item_id = $id;
                    $cart->item_name = $item-> itemname;
                    $cart->price = $item -> price;
                    $cart->quantity = 1;
                    $cart->status = 'temporary';
                    $cart->username = 'wasiq';
                    $cart->save();
                    return response()->json(['result' => 'Item Added']);
                }
                else
                {
                    $cartdetaail = Cart::max('cartid');

                    $item = Item::where('itemid',$id)->first();//fetch item price and name
                    $cart = new Cart;
                    $cart->cartid = $cartdetaail+1;
                    $cart->session_id = $sessionid;
                    $cart->cart_date = date("Y-m-d");
                    $cart->item_id = $id;
                    $cart->item_name = $item-> itemname;
                    $cart->price = $item -> price;
                    $cart->quantity = 1;
                    $cart->status = 'temporary';
                    $cart->username = 'wasiq';
                    $cart->save();
                    return response()->json(['result' => 'Item Added']);
                }
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
            where('username','wasiq')->
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
            $cartitem = Cart::where('id',$id);
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
            $cart = Cart::where('id',$id)->first();
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
            $store = $req->get('data');
            $customerid = $req->get('id');
            //get cart item and update status
            $sessionid = Session()->getId();
            $cart = Cart::where('status','temporary')->
            where('session_id',$sessionid)->get();

            $orderid = Order::max('orderid');

            foreach ($cart as $value) 
            {
                //order insert work
                //$data = $req->get('data');
                $order = new Order;
                $order->orderid = $orderid+1;
                $order->itemid = $value->item_id;
                $order->customerid = $customerid;
                $order->store = $store;
                $order->itemname = $value->item_name;
                $order->price = $value->price;
                $order->quantity = $value->quantity;
                $order->itemdate = $value->cart_date; 
                $order->status = 'New Order';
                $order->save();
                $itemdelete = Cart::where('item_id',$value->item_id)->
                where('session_id',$sessionid)->delete();

                //dd($value->item_id);

                if ($order)
                {
                    $subdetail = Subdetail::where('itemid',$value->item_id)->
                    where('session_id',$sessionid)->first();

                    //dd($subdetail);
                    if ($subdetail != null)
                    {
                        $orderdetail = new Orderdetail;
                        $orderdetail->orderid = $order->orderid;
                        $orderdetail->itemid = $subdetail->itemid;
                        $orderdetail->cheese = $subdetail->cheese;
                        $orderdetail->extra_cheese = $subdetail->extra_cheese;
                        $orderdetail->sauces = $subdetail->sauces;
                        $orderdetail->vegetables = $subdetail->vegetables;
                        $orderdetail->extra_meat_topping_is_free = $subdetail->extra_meat_topping_is_free;
                        $orderdetail->save();
                        $subdetail->delete();
                    }
                    else
                    {
                        $orderdetail = new Orderdetail;
                        $orderdetail->orderid = $order->orderid;
                        $orderdetail->itemid = $value->item_id;
                        $orderdetail->cheese = 'No';
                        $orderdetail->extra_cheese = 'No';
                        $orderdetail->sauces = 'No';
                        $orderdetail->vegetables = 'No';
                        $orderdetail->extra_meat_topping_is_free = 'No';
                        $orderdetail->save();
                    }
                   // $subdetail = Subdetail::where('session_id',$sessionid)->delete();
                }

                //$value->status = 'conform';
                //$value->delete();
            }
            return response()->json(['result' => 'Order place SuccessFully']);
        }
    }
    
    

    //cart clear work
    public function cartclear(Request $req)
    {
        if ($req -> ajax())
        {            
            $sessionid = Session()->getId();
            $cart = Cart::where('session_id',$sessionid)->get();

            //dd($cart);
            foreach ($cart as $value) 
            {
                $subdetail = Subdetail::where('cartid',$value->cartid)->delete();            
            }
            $cart = Cart::where('session_id',$sessionid)->delete();
            
            return response()->json(['result' => 'Cart Clear SuccessFully']);
        }
    }
    //sub detail add work
    public function subdetail(Request $req)
    {
        //dd($req);
        $sessionid = Session()->getId();

        $cartid = $req->get('cartid');
        $itemid = $req->get('itemid');
        $subdetail = Subdetail::where('cartid',$cartid)->where('itemid',$itemid)->
        where('session_id',$sessionid)->first();
        if ($subdetail != null)
        {
            $subdetail->cartid = $req->cartid;
            $subdetail->itemid = $req->itemid;
            $subdetail->session_id = $sessionid;
            $subdetail->cheese = $req->cheese;
            $subdetail->extra_cheese = $req->extracheese;
            if ($req->sauces == null)
            {
                $subdetail->sauces = 'No';
            }
            else
            {
                $subdetail->sauces = implode(',',$req->sauces);
            }
            if ($req->vegetable == null) 
            {
                $subdetail->vegetables = 'No';
            }
            else
            {
                $subdetail->vegetables = implode(',',$req->vegetable);
            }
            $subdetail->extra_meat_topping_is_free = $req->extra;
            $subdetail->save();
            return response()->json(['result' => 'Detail Updated']);
        }
        else
        {
            $detail = new Subdetail();
            $detail->cartid = $req->cartid;
            $detail->itemid = $req->itemid;
            $detail->session_id = $sessionid;
            $detail->cheese = $req->cheese;
            $detail->extra_cheese = $req->extracheese;
            if ($req->sauces == null)
            {
                $detail->sauces = 'No';
            }
            else
            {
                $detail->sauces = implode(',',$req->sauces);
            }
            if ($req->vegetable == null) 
            {
                $detail->vegetables = 'No';
            }
            else
            {
                $detail->vegetables = implode(',',$req->vegetable);
            }
            $detail->extra_meat_topping_is_free = $req->extra;
            $detail->save();
            return response()->json(['result' => 'Detail Added']);
        }
    }
    public function fetchsubdetail(Request $req)
    {
        if ($req -> ajax())
        {
            $sessionid = Session()->getId();

            $cartid = $req->get('cartid');
            $itemid = $req->get('itemid');

            $getdetail = Subdetail::where('itemid',$itemid)->
            where('session_id',$sessionid)->first();
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
