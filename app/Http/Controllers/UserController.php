<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('subway.userinfo',['user' => $user]);
    }

    public function add(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'txt_name' => 'required', 'string', 'max:255',
            'txt_email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8','max:25',
            'role' => 'required'
        ],
        [
            'txt_name.required' => '*Name Is Required',
            'txt_email.required' => '*Email Is Required',
            'password.required' => '*Password Is Required',
            'role.required' => 'Please select User Type'
        ]);


        if ($validator -> passes()) 
        {
            $userinsert = new User;
            $userinsert->name = $req->txt_name;
            $userinsert->email = $req->txt_email;
            $userinsert->password = $req->password;
            $userinsert->role = $req->role;
            $userinsert->save();
            return response()->json(['success' => 'User Added Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }
    //delete
    public function delete($id)
    {
        $shift = User::where('id',$id);
        $shift->delete();
    }
    //update
    public function editfetch($id)
    {
        $userinfo = User::where('id',$id)->first();
        return response()->json(['result' => $userinfo]);
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'txt_name' => 'required', 'string', 'max:255',
            'txt_email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8','max:25',
            'role' => 'required'
        ],
        [
            'txt_name.required' => '*Name Is Required',
            'txt_email.required' => '*Email Is Required',
            'password.required' => '*Password Is Required',
            'role.required' => 'Please select User Type'
        ]);

        if ($validator -> passes()) 
        {
            $id = $req->did;
            $userinsert = User::where('id',$id)->first();
            $userinsert->name = $req->txt_name;
            $userinsert->email = $req->txt_email;
            $userinsert->password = $req->password;
            $userinsert->role = $req->role;
            $userinsert->save();
            return response()->json(['success' => 'User Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }
}
