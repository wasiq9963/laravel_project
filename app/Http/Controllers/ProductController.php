<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Category Model
use App\Category;
//Product Model
use App\Product;
//Brand Model
use App\Brand;
use DB;

class ProductController extends Controller
{
    public function fetch(Request $req)
    {
        $catinfo = Category::all();
        //brand
        $brnadinfo = Brand::all();
       // $productinfo = Product::all();

       $productinfo = DB::table('products')
       ->join('categories','products.category_id','categories.id')
       ->join('brands','products.b_id','brands.brand_id')->get();
        return view('product.productinfo',['proinfo' => $productinfo,'catinfo' => $catinfo, 'brandinfo' => $brnadinfo]);
    }
    
    public function insertform()
    {
        $catinfo = Category::all();
        //brand
        $brnadinfo = Brand::all();
        return view('product.productadd',['catinfo' => $catinfo, 'brandinfo' => $brnadinfo]);
    }

    //Insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|image|max:2048',
            'category'=> 'required',
            'brand'=> 'required'
        ]);

        if ($validator -> passes())
        {
            //dd($req->all());
            //image upload work
            $image = $req->file('product_image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $product = new Product;
            $product->product_name = $req->product_name;
            $product->price = $req->product_price;
            $product->image = $new_name;
            $product->category_id = $req->category;
            $product->b_id = $req->brand;
            $product->save();
            //$req->session()->flash('msgsuccess','Record Inserted Successfully');
            //return redirect('/product/add');
            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
            //return redirect('/product/add')->withErrors($validator)->withInput();
        }
    }

    //delete work
    public function delete(Request $req, $id)
    {
        $proinfo = Product::where('pro_id',$id)->first();
        /*if (!$proinfo) 
        {
            $req->session()->flash('msgdanger','Record Not found');
            return redirect('/product');
        }*/
        $proinfo->delete();
        //$req->session()->flash('msgsuccess','Record Deleted successfully');
        //return redirect('/product');
    }

    //update work
    public function editfetch(Request $req,$id)
    {
        //fetch category and set in dropdown
       // $catinfo = Category::all();
        //$brandinfo = Brand::all();

        if (request() -> ajax())
        {
            $proinfo = Product::where('pro_id',$id)->first();
            return response()->json(['result' => $proinfo]);
        }  
        /*if (!$proinfo) 
        {
            $req->session()->flash('msgdanger','Record Not found');
            return redirect('/product');
        }

        */return view('product.productedit',['catinfo' => $catinfo,'brandinfo' => $brandinfo])->with(compact('proinfo'));
    }
    public function update(Request $req)
    {
        $id = $req->did;
        $image_name = $req->hidden_image;
        $image = $req->file('product_image');
        if ($image != '')
        {
            $validator = Validator::make($req -> all(),[
                'product_name' => 'required',
                'product_price' => 'required',
                'product_image' => 'required|image|max:2048',
                'category'=> 'required',
                'brand'=> 'required'
            ]);
    
            if ($validator -> fails())
            {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $image_name);
        }
        else
        {
            $validator = Validator::make($req -> all(),[
                'product_name' => 'required',
                'product_price' => 'required',
                'category'=> 'required',
                'brand'=> 'required'
            ]);
    
            if ($validator -> fails())
            {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
        }

            $proupdate = Product::where('pro_id',$id)->first();
            $proupdate->product_name = $req->product_name;
            $proupdate->price = $req->product_price;
            $proupdate->image = $image_name;
            $proupdate->category_id = $req->category;
            $proupdate->b_id = $req->brand;
            $proupdate->save();
           // $req->session()->flash('msgsuccess','Record Updated Successfully');
            //return redirect('/product');
            return response()->json(['success' => 'Record Updated Successfully']);
    }
}
