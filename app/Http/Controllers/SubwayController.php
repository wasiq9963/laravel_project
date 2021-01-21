<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use DB;
use Cart;
use App\Customer;

class SubwayController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        $cartcontent = Cart::getContent();
        return view('subway.index',['categories' => $categories,'result' => $cartcontent]);
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
            $i = 1;
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
            //$cartcontent = Cart::getContent();
            return response()->json(['result' => 'done']);
        }
    }
    public function getcartitems(Request $req)
    {
        if($req -> ajax())
        {
            $sessionid = Session()->getId();
            $cartcontent = Cart::getContent();
            $count = $cartcontent->count();
            dd($cartcontent);
            //$id = $cartcontent-> id;
            return response()->json(['result' => $cartcontent]);
        }
    }
    public function removecart(Request $req)
    {
        if ($req -> ajax())
        {
            $sessionid = Session()->getId();
            $id = $req->get('id');
            Cart::remove($id);
            return response()->json(['result' => 'Remove']);
        }
    }
    public function updatecart(Request $req)
    {
        if ($req -> ajax())
        {
            $id = $req->get('id');
            $qty = $req->get('qty');
            Cart::update($id,[
                'quantity' => array(
                    'relative' => false,
                    'value' => $qty,
                )
            ]);
            return response()->json(['result' => 'Cart Updated']);
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
