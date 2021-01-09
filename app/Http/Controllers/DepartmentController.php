<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\input;
use Response;
use App\http\Requests;
use DataTable;

use App\Department;

class DepartmentController extends Controller
{
    public function index(Type $var = null)
    {
        $depart_info = Department::all();
        return view('department.departmentinfo',['depart_info' => $depart_info]);
    }
    //insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'department_name' => 'required',
        ],
        [
            'department_name.required' => 'Department Name Is required',
        ]);

        if ($validator -> passes()) 
        {
            $department = new Department();
            $department->department_name = $req->department_name;
            $department->save();
            return response()->json(['success' => 'Data Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
    }
    //update
    public function editfetch($id)
    {
        if (request() -> ajax()) 
        {
            $departinfo = Department::where('dep_id', $id)->first();
            return response()->json(['result' => $departinfo]);
        }
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'department_name' => 'required',
        ],
        [
            'department_name.required' => 'Department Name Is required',
        ]);

        if ($validator -> passes()) 
        {
            $id = $req->did;
            //dd($id);
            $department = Department::where('dep_id',$id)->first();
            $department->department_name = $req->department_name;
            $department->save();
            return response()->json(['success' => 'Data Updated Successfully']);
        }
        else
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
    }

    //delete
    public function delete($id)
    {
        $depart = Department::where('dep_id',$id)->first();
        $depart->delete();
    }
}
