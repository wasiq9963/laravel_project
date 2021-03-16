<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Sauce;

class SauceController extends Controller
{
    //auth name set work
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $req)
    {
        $sauce = Sauce::all();

        return view('subdetail.sauce',['sauce' => $sauce]);
    }
    //insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'saucename' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');

            $sauce = new Sauce;
            $sauce->sauce = $req->saucename;
            $sauce->save();
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
            $sauce =  Sauce::where('id',$id)->first();
            return response()->json(['result' => $sauce]);
        }   
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'saucename' => 'required'
        ]);

        if ($validator -> passes())
        {
            $id = $req->did;
            $sauce = Sauce::find($id);
            $sauce->sauce = $req->saucename;
            $sauce->save();
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
        $sauce = Sauce::where('id',$id)->delete();
    }
}
