<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Store;

class StoreController extends Controller
{
    public function index()
    {
        $storeinfo = Store::all();
        return view('subway.storeinfo',['storeinfo' => $storeinfo]);
    }

    //insert
    public function insert(Request $req)
    {
        //dd($req -> all());

        $validator = Validator::make($req -> all(),[
            'storename' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');

            $store = new Store;
            $store->storename = $req->storename;
            $store->save();

            //$req->session()->flash('msgsuccess','Record Inserted Successfully');
            //return redirect('/category/add');
            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }

    //update work
    public function edit(Request $req, $id)
    {
        if (request() -> ajax())
        {
            $storeinfo =  Store::where('id',$id)->first();
           // return view('category.categoryedit')->with(compact('catinfo'));
           return response()->json(['result' => $storeinfo]);
        }   
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'storename' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');
            $id = $req->did;
            $store = Store::find($id);
            $store->storename = $req->storename;
            $store->save();

            //$req->session()->flash('msgsuccess','Record Updated Successfully');
            //return redirect('/category');
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }

    //delete work
    public function delete(Request $req, $id)
    {

        //dd($id);
        $storeinfo = Store::where('id',$id)->delete();
    }
}
