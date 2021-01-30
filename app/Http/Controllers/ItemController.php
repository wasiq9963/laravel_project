<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Item;
use App\Category;
use DB;

class ItemController extends Controller
{
    public function fetch(Request $req)
    {
        $catinfo = Category::all();
       // $productinfo = Product::all();

       $iteminfo = DB::table('items')
       ->join('categories','items.categoryid','categories.id')->get();
        return view('subway.iteminfo',['iteminfo' => $iteminfo,'catinfo' => $catinfo]);
    }

    //Insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'product_name' => 'required',
            'product_price' => 'required',
            'category'=> 'required'
        ]);

        if ($validator -> passes())
        {
            //dd($req->all());
            //image upload work
            /*$image = $req->file('product_image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);*/

            $item = new Item;
            $item->itemname = $req->product_name;
            $item->price = $req->product_price;
            $item->categoryid = $req->category;
            $item->save();
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
        $iteminfo = Item::where('itemid',$id)->first();
        /*if (!$proinfo) 
        {
            $req->session()->flash('msgdanger','Record Not found');
            return redirect('/product');
        }*/
        $iteminfo->delete();
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
            $iteminfo = Item::where('itemid',$id)->first();
            return response()->json(['result' => $iteminfo]);
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
        /*$image_name = $req->hidden_image;
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
        }*/

            $itempdate = Item::where('itemid',$id)->first();
            $itempdate->itemname = $req->product_name;
            $itempdate->price = $req->product_price;
            $itempdate->categoryid = $req->category;
            $itempdate->save();
           // $req->session()->flash('msgsuccess','Record Updated Successfully');
            //return redirect('/product');
            return response()->json(['success' => 'Record Updated Successfully']);
    }
}
