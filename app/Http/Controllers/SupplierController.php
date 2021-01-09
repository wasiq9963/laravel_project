<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Supplier;

class SupplierController extends Controller
{
    public function index(Type $var = null)
    {
        $supplier = Supplier::all();
        return view('supplier.supplierinfo',['supplierinfo' => $supplier]);
    }

    //insert
    public function insert(Request $req)
    {
        $insertform = array(
            'txt_name' => 'required',
            'txt_phoneno' => 'required',
            'txt_email' => 'required',
            'txt_address' => 'required',
            'txt_ntn' => 'required',
            'txt_openbalance' => 'required'
            /*[
                'txt_name.required' => 'Full Name Is Required',
                'txt_phoneno.required' => 'Phone No Is Required',
                'txt_email.required' => 'Email Is Required',
                'txt_address.required' => 'Address Is Required',
                'txt_ntn.required' => 'NTN Number Is Required',
                'txt_openbalance.required' => 'Upening Balance is Required Is Required',
            ]*/
        );
        $validator = Validator::make($req->all(),$insertform);

        if ($validator -> passes())
        {
            $supplierinser = new Supplier();
            $supplierinser->sup_name = $req->txt_name;
            $supplierinser->sup_phoneno = $req->txt_phoneno;
            $supplierinser->sup_email = $req->txt_email;
            $supplierinser->sup_address = $req->txt_address;
            $supplierinser->ntn = $req->txt_ntn;
            $supplierinser->opening_balance = $req->txt_openbalance;
            $supplierinser->longitude = $req->longi;
            $supplierinser->latitude = $req->lati;
            $supplierinser->save();
            return response()->json(['success' => 'Record Inserted Successfully']);
        }
        else
        {
            return response()->json(['errors' =>$validator->errors()->all()]);
        }
    }

    //delete
    public function delete($id)
    {
        $supdelete = Supplier::where('id',$id)->first();
        $supdelete->delete();
    }

    //update
    public function edit($id)
    {
        if (request() -> ajax()) 
        {
            $supplier = Supplier::where('id',$id)->first();
            return response()->json(['result' => $supplier]);
        }
    }
    public function update(Request $req)
    {
        $insertform = array(
            'txt_name' => 'required',
            'txt_phoneno' => 'required',
            'txt_email' => 'required',
            'txt_address' => 'required',
            'txt_ntn' => 'required',
            'txt_openbalance' => 'required'
            /*[
                'txt_name.required' => 'Full Name Is Required',
                'txt_phoneno.required' => 'Phone No Is Required',
                'txt_email.required' => 'Email Is Required',
                'txt_address.required' => 'Address Is Required',
                'txt_ntn.required' => 'NTN Number Is Required',
                'txt_openbalance.required' => 'Upening Balance is Required Is Required',
            ]*/
        );
        $validator = Validator::make($req->all(),$insertform);

        if ($validator -> passes())
        {
            $id = $req->did;
            $supplierupdate = Supplier::where('id',$id)->first();
            $supplierupdate->sup_name = $req->txt_name;
            $supplierupdate->sup_phoneno = $req->txt_phoneno;
            $supplierupdate->sup_email = $req->txt_email;
            $supplierupdate->sup_address = $req->txt_address;
            $supplierupdate->ntn = $req->txt_ntn;
            $supplierupdate->opening_balance = $req->txt_openbalance;
            $supplierupdate->longitude = $req->longi;
            $supplierupdate->latitude = $req->lati;
            $supplierupdate->save();
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' =>$validator->errors()->all()]);
        }
    }

    public function fetchmap(Request $req)
    {
       if (request() -> ajax()) 
        {
            $search = $req->get('query');
            //dd($search);
            if ($search != '')
            {
                $supplier = Supplier::where('sup_address','LIKE', '%'.$search.'%')->get();
                return response()->json(['result' => $supplier]);
            }
            else
            {
                $supplier = Supplier::all();
                return response()->json(['result' => $supplier]);
            }
        } 
        return view('supplier.suppliermap');     
    }
}
