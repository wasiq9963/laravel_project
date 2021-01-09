<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//for form validation
use Illuminate\Support\Facades\Validator;
use App\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $catinfo = Category::all();
        return view('category.categoryinfo',['catinfo' => $catinfo]);
    }

    //Insert work
    public function insertform()
    {
        return view('category.categoryadd');
    }

    public function insert(Request $req)
    {
        //dd($req -> all());

        $validator = Validator::make($req -> all(),[
            'catname' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');

            $category = new Category;
            $category->category_name = $req->catname;
            $category->save();

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
            $catinfo =  Category::where('id',$id)->first();
           // return view('category.categoryedit')->with(compact('catinfo'));
           return response()->json(['result' => $catinfo]);
        }   
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req -> all(),[
            'catname' => 'required'
        ]);

        if ($validator -> passes())
        {
            //dd('hello');
            $id = $req->did;
            $category = Category::find($id);
            $category->category_name = $req->catname;
            $category->save();

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
    public function catdelete(Request $req, $id)
    {

        //dd($id);
        $catinfo = Category::where('id',$id)->first();
        $catinfo->delete();
    }
}
