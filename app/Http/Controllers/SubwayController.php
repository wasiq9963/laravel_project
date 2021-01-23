<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use DB;
use App\Cart;
use App\Customer;

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
    public function addtocart(Request $req)
    {
        $sessionid = Session()->getId();
        if ($req -> ajax())
        {
            $id = $req->get('id');

            $cartitem = Cart::where('item_id',$id)->first();
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
                    $cart->save();
                    return response()->json(['result' => 'Item Added']);
                }
            
            /*$i = 1;
            $i = $i+1;
            $item = Item::where('itemid',$id)->first();
            $cart = Cart::add([
                        'id' => $i,
                        //'id' => $item-> itemid, 
                        'name' => $item-> itemname, 
                        'price' => $item-> price,
                        'quantity' => 1,
                        ]);

            //dd(Cart::getContent());
            //$cartcontent = Cart::getContent();*/
        }
    }
    public function getcartitems(Request $req)
    {
        if($req -> ajax())
        {
            $carts = Cart::all();
            $totalqty = $carts->sum('quantity');
            return response()->json(['result' => $carts,'qtys' => $totalqty]);
        }
    }
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
    public function customerinfo(Request $req)
    {
        if ($req -> ajax())
        {
            $data = $req->get('data');
            $customer = Customer::where('cus_phoneno',$data)->first();

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
