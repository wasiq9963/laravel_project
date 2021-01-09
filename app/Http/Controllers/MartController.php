<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

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
}
