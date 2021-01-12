<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Brand;
use DB;
class MartController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::all();
        return view('frontpages.home',['categories' => $categories]);
    }

    public function products(Request $req)
    {
        //products fetch
        if ($req -> ajax())
        {
            $id = $req->get('data');
            if ($id != '')
            {
                $products = Product::where('category_id', $id)->get();
                return response()->json(['result' => $products]);
            }
            else
            {
                $products = Product::all();
                return response()->json(['result' => $products]);
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
        
        dd('hello');
    }
}
