<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Shift;

class ShiftController extends Controller
{
    public function index(Type $var = null)
    {
        $shiftinfo = Shift::all();
        return view('shift.shiftinfo',['shiftinfo' => $shiftinfo]);
    }

    //insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'txtshift_name' => 'required',
            'txtshift_in' => 'required',
            'txtshift_out' => 'required',
            'txtshift_late' => 'required',
        ],
        [
            'txtshift_name.required' => '*Shift Name Is Required',
            'txtshift_in.required' => '*TimeIn Is Required',
            'txtshift_out.required' => '*TimeOut Is Required',
            'txtshift_late.required' => '*Late Is Required'
        ]);

        if ($validator -> passes()) 
        {
            $shift = new Shift();
            $shift->shift_name = $req->txtshift_name;
            $shift->time_in = $req->txtshift_in;
            $shift->time_out = $req->txtshift_out;
            $shift->late = $req->txtshift_late;
            $shift->save();
            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }

    //delete
    public function delete($id)
    {
        $shift = Shift::where('s_id',$id);
        $shift->delete();
    }

    //update
    public function editfetch($id)
    {
        if (request() -> ajax())
        {
            $shiftinfo = Shift::where('s_id',$id)->first();
            return response()->json(['result' => $shiftinfo]);
            # code...
        }
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'txtshift_name' => 'required',
            'txtshift_in' => 'required',
            'txtshift_out' => 'required',
            'txtshift_late' => 'required',
        ],
        [
            'txtshift_name.required' => '*Shift Name Is Required',
            'txtshift_in.required' => '*TimeIn Is Required',
            'txtshift_out.required' => '*TimeOut Is Required',
            'txtshift_late.required' => '*Late Is Required'
        ]);

        if ($validator -> passes()) 
        {
            $id = $req->did;
            $shiftupdate = Shift::where('s_id',$id)->first();
            $shiftupdate->shift_name = $req->txtshift_name;
            $shiftupdate->time_in = $req->txtshift_in;
            $shiftupdate->time_out = $req->txtshift_out;
            $shiftupdate->late = $req->txtshift_late;
            $shiftupdate->save();
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    }
}
