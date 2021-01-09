<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;
class CustomerController extends Controller
{
    public function index(Type $var = null)
    {
        $customer = Customer::all();
        return view('customer.customerinfo',['customerinfo' => $customer]);
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
            $customerinser = new Customer();
            $customerinser->cus_name = $req->txt_name;
            $customerinser->cus_phoneno = $req->txt_phoneno;
            $customerinser->cus_email = $req->txt_email;
            $customerinser->cus_address = $req->txt_address;
            $customerinser->ntn = $req->txt_ntn;
            $customerinser->opening_balance = $req->txt_openbalance;
            $customerinser->longitude = $req->longi;
            $customerinser->latitude = $req->lati;
            $customerinser->save();
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
        $customer = Customer::where('id',$id)->first();
        $customer->delete();
    }

    //update
    public function edit($id)
    {
        if (request() -> ajax()) 
        {
            $customer = Customer::where('id',$id)->first();
            return response()->json(['result' => $customer]);
        }
    }
    public function update(Request $req)
    {
        $updateform = array(
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
        $validator = Validator::make($req->all(),$updateform);

        if ($validator -> passes())
        {
            $id = $req->did;
            $customerupdate = Customer::where('id',$id)->first();
            $customerupdate->cus_name = $req->txt_name;
            $customerupdate->cus_phoneno = $req->txt_phoneno;
            $customerupdate->cus_email = $req->txt_email;
            $customerupdate->cus_address = $req->txt_address;
            $customerupdate->ntn = $req->txt_ntn;
            $customerupdate->opening_balance = $req->txt_openbalance;
            $customerupdate->longitude = $req->longi;
            $customerupdate->latitude = $req->lati;
            $customerupdate->save();
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' =>$validator->errors()->all()]);
        }
    }
    public function fetchmap(Request $req)
    {
       if ($req -> ajax()) 
        {
            $search = $req->get('query');
            //dd($search);
            if ($search != '')
            {
                $customer = Customer::where('cus_address','LIKE', '%'.$search.'%')->get();
                return response()->json(['result' => $customer]);
            }
            else
            {
                $customer = Customer::all();
                return response()->json(['result' => $customer]);
            }
            
        }     
        return view('customer.customermap'); 
    }

}
