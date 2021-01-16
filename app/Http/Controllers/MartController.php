<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Brand;
use DB;
use Cart;
class MartController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        $cartcontent = Cart::getContent();
        return view('frontpages.home',['categories' => $categories,'result' => $cartcontent]);
    }

    public function products(Request $req)
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
                    $products = Product::where('category_id', $id)->
                    orwhere('product_name','LIKE', '%'.$query.'%')->get();
                    return response()->json(['result' => $products]);
                }
                else
                {
                    $products = Product::where('category_id', $id)->get();
                    return response()->json(['result' => $products]);
                }
                
            }
            else
            {
                if ($query != '')
                {
                    $products = Product::where('product_name','LIKE', '%'.$query.'%')->get();
                    return response()->json(['result' => $products]);
                }
                else
                {
                    $products = Product::all();
                    return response()->json(['result' => $products]);
                }
            }
        }
    }
    public function singleproduct(Request $req)
    {
        if($req -> ajax())
        {
            $id = $req->get('id');
            $singlepro = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->join('brands','products.b_id','brands.brand_id')->where('pro_id',$id)->first();
            return response()->json(['result' => $singlepro]);
        }
    }
    public function addtocart(Request $req)
    {
        $sessionid = Session()->getId();
        if ($req -> ajax())
        {
            $id = $req->get('id');
            $i = 0;
            $product = Product::where('pro_id',$id)->first();
            $cart = Cart::add([
                        //'id' => $i,
                        'id' => $product-> pro_id, 
                        'name' => $product-> product_name, 
                        'price' => $product->price,
                        'quantity' => 1,
                        ]);

                        //dd(Cart::getContent());
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
}
