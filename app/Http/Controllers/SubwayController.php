<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use DB;
use Cart;

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
            $i = 0;
            $item = Item::where('itemid',$id)->first();
            $cart = Cart::add([
                        //'id' => $i,
                        'id' => $item-> itemid, 
                        'name' => $item-> itemname, 
                        'price' => $item-> price,
                        'quantity' => 1,
                        ]);

                        //dd(Cart::getContent());
            return response()->json(['result' => 'done']);
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
}
