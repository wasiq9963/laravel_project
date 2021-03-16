<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Item;
use App\Category;
use App\Order;
use DB;

class ItemController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'item_name' => 'required',
            'item_price' => 'required',
            'item_image' => 'required|image|max:2048',
            'category'=> 'required'
        ]);

        if ($validator -> passes())
        {
            //dd($req->all());
            //image upload work
            $image = $req->file('item_image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $item = new Item;
            $item->itemname = $req->item_name;
            $item->price = $req->item_price;
            $item->image = $new_name;
            $item->categoryid = $req->category;
            $item->status = $req->status;
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
        $order = Order::where('itemid',$id)->first();
        if ($order != null)
        {
            return response()->json(['msg' => 'Item is not deleted because item Is Active']);
        }
        else
        {
            $iteminfo = Item::where('itemid',$id)->first();
            $iteminfo->delete();
        }
    }
    //update work
    public function editfetch(Request $req,$id)
    {
        if (request() -> ajax())
        {
            $iteminfo = Item::where('itemid',$id)->first();
            return response()->json(['result' => $iteminfo]);
        }  
    }
    public function update(Request $req)
    {
        $id = $req->did;
        $image_name = $req->hidden_image;
        $image = $req->file('item_image');
        if ($image != '')
        {
            $validator = Validator::make($req -> all(),[
                'item_name' => 'required',
                'item_price' => 'required',
                'item_image' => 'required|image|max:2048',
                'category'=> 'required'
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
                'item_name' => 'required',
                'item_price' => 'required',
                'category'=> 'required'
            ]);
    
            if ($validator -> fails())
            {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
        }

            $itempdate = Item::where('itemid',$id)->first();
            $itempdate->itemname = $req->item_name;
            $itempdate->price = $req->item_price;
            $itempdate->image = $image_name;
            $itempdate->categoryid = $req->category;
            $itempdate->status = $req->status;
            $itempdate->save();
            return response()->json(['success' => 'Record Updated Successfully']);
    }
}
