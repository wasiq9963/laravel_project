<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Category;
use App\Brand;
use DB;

class BrandController extends Controller
{
    public function index()
    {
        //$brandinfo = Brand::all();
        $catinfo = Category::all();

        $brandinfo = DB::table('brands')->join('categories','brands.category_id','categories.id')->get();

        return view('brand.brandinfo',['brandinfo' => $brandinfo,'catinfo'=>$catinfo]);
    }
//==========insert work
    public function insertform()
    {
        
        //
    }

    public function insert(Request $req)
    {
        //dd($req -> all());
        $validator = Validator::make($req ->all(),[
            'brand_name' => 'required',
            'category' => 'required'
        ]);

        if ($validator -> passes()) 
        {
            $brand = new Brand();
            $brand->brand_name = $req->brand_name;
            $brand->category_id = $req->category;
            $brand->save();
           //$req->session()->flash('msgsuccess','Record Inserted Successfully');
            //return redirect('brand/add');

            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
            //return redirect('/brand/add')->withErrors($validator)->withInput();
        }
    }

    //update
    public function edit(Request $req,$id)
    {
        //$catinfo = Category::all();

        if (request() -> ajax())
        {
            $brandinfo = Brand::Where('brand_id',$id)->first();
            return response()->json(['result' => $brandinfo]);
        }  

        /*if (!$brandinfo) 
        {
            $req->session()->flash('msgdanger','Record Not found');
            return redirect('/brand');
        }
        return view('brand.brandedit',['catinfo'=>$catinfo])->with(compact('brandinfo'));*/
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req ->all(),[
            'brand_name' => 'required',
            'category' => 'required'
        ]);

        if ($validator -> passes()) 
        {
            $id = $req->did;
            $brand = Brand::where('brand_id', $id)->first();
            $brand->brand_name = $req->brand_name;
            $brand->category_id = $req->category;
            $brand->save();
            //$req->session()->flash('msgsuccess','Record Updated Successfully');
            //return redirect('brand');
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
            //return redirect('/brand/add')->withErrors($validator)->withInput();
        }
    }

    //delete
    public function delete(Request $req,$id)
    {
        $brand =    Brand::where('brand_id',$id)->first();
        $brand->delete();
        //$req->session()->flash('msgsuccess','Record Deleted successfully');
        //return redirect('/brand');
    }
}
