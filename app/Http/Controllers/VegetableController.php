<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Vegetable;


class VegetableController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $req)
    {
        $vegetable = Vegetable::all();

        return view('subdetail.vegetable',['vegetable' => $vegetable]);
    }
    //insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'vegetablename' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');

            $vegetable = new Vegetable;
            $vegetable->vegetable = $req->vegetablename;
            $vegetable->save();
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
            $veges =  Vegetable::where('id',$id)->first();
           return response()->json(['result' => $veges]);
        }   
    }
    public function update(Request $req)
    {
        $id = $req->did;
        $validator = Validator::make($req -> all(),[
            'vegetablename' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');

            $vegetable = Vegetable::find($id);
            $vegetable->vegetable = $req->vegetablename;
            $vegetable->save();
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
        $veges = Vegetable::where('id',$id)->delete();
    }

}
