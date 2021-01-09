<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\Employee;
use\App\Shift;
use DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $depinfo = Department::all();
        $shiftinfo = Shift::all();

        $employee = DB::table('employees')->
        join('departments','employees.department_id','departments.dep_id')->
        join('shifts','employees.shift_id','shifts.s_id')->get();

        return view('employee.employeeinfo',['depinfo' => $depinfo, 'empinfo' => $employee, 'shift' => $shiftinfo]);
    }
    //insert
    public function insert(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'txtemp_name' => 'required',
            'txtemp_phoneno' => 'required',
            'txtemp_email' => 'required',
            'txtemp_salary' => 'required',
            'txtemp_address' => 'required',
            'txtemp_qualification' => 'required',
            'txtemp_dob' => 'required',
            'txtemp_cnic' => 'required',
            'txtemp_ntn' => 'required',
            'department' => 'required',
            'shift' => 'required',
            'txtemp_doj' => 'required',
            'txtemp_dol' => 'required'
        ],
        [
            'txtemp_name.required' => 'Full Name Is Required',
            'txtemp_phoneno.required' => 'Phone No Is Required',
            'txtemp_email.required' => 'Email Is Required',
            'txtemp_salary.required' => 'Salary Is Required',
            'txtemp_address.required' => 'Address Is Required',
            'txtemp_qualification.required' => 'Qualification Is Required',
            'txtemp_dob.required' => 'DOB Is Required',
            'txtemp_cnic.required' => 'CNIC Name Is Required',
            'txtemp_ntn.required' => 'NTN Number Is Required',
            'department.required' => 'Department Is Required',
            'shift.required' => 'Shift Is Required',
            'txtemp_doj.required' => 'Date Of Join Is Required',
            'txtemp_dol.required' => 'Dte Of Last Is Required'
        ]);

        if ($validator -> passes())
        {
            $employeeinser = new Employee();
            $employeeinser->emp_name = $req->txtemp_name;
            $employeeinser->emp_phoneno = $req->txtemp_phoneno;
            $employeeinser->emp_email = $req->txtemp_email;
            $employeeinser->emp_salary = $req->txtemp_salary;
            $employeeinser->emp_address = $req->txtemp_address;
            $employeeinser->qualification = $req->txtemp_qualification;
            $employeeinser->dob = $req->txtemp_dob;
            $employeeinser->cnic = $req->txtemp_cnic;
            $employeeinser->ntn = $req->txtemp_ntn;
            $employeeinser->department_id = $req->department;
            $employeeinser->shift_id  = $req->shift;
            $employeeinser->doj = $req->txtemp_doj;
            $employeeinser->dol = $req->txtemp_dol;
            $employeeinser->save();
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
        $employee = Employee::where('id',$id)->first();
        $employee->delete();
    }

    //update
    public function editfetch(Request $req,$id)
    {
        if (request() -> ajax()) 
        {
            $emp = Employee::where('id',$id)->first();
            return response()->json(['result' => $emp]);
        }
    }
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),[

            'txtemp_name' => 'required',
            'txtemp_phoneno' => 'required',
            'txtemp_email' => 'required',
            'txtemp_salary' => 'required',
            'txtemp_address' => 'required',
            'txtemp_qualification' => 'required',
            'txtemp_dob' => 'required',
            'txtemp_cnic' => 'required',
            'txtemp_ntn' => 'required',
            'department' => 'required',
            'shift' => 'required',
            'txtemp_doj' => 'required',
            'txtemp_dol' => 'required'
        ],
        [
            'txtemp_name.required' => 'Full Name Is Required',
            'txtemp_phoneno.required' => 'Phone No Is Required',
            'txtemp_email.required' => 'Email Is Required',
            'txtemp_salary.required' => 'Salary Is Required',
            'txtemp_address.required' => 'Address Is Required',
            'txtemp_qualification.required' => 'Qualification Is Required',
            'txtemp_dob.required' => 'DOB Is Required',
            'txtemp_cnic.required' => 'CNIC Name Is Required',
            'txtemp_ntn.required' => 'NTN Number Is Required',
            'department.required' => 'Department Is Required',
            'shift.required' => 'Shift Is Required',
            'txtemp_doj.required' => 'Date Of Join Is Required',
            'txtemp_dol.required' => 'Dte Of Last Is Required'
        ]);

        if ($validator -> passes())
        {
            $id = $req->did;

            $employeeinser = Employee::where('id',$id)->first();
            $employeeinser->emp_name = $req->txtemp_name;
            $employeeinser->emp_phoneno = $req->txtemp_phoneno;
            $employeeinser->emp_email = $req->txtemp_email;
            $employeeinser->emp_salary = $req->txtemp_salary;
            $employeeinser->emp_address = $req->txtemp_address;
            $employeeinser->qualification = $req->txtemp_qualification;
            $employeeinser->dob = $req->txtemp_dob;
            $employeeinser->cnic = $req->txtemp_cnic;
            $employeeinser->ntn = $req->txtemp_ntn;
            $employeeinser->department_id = $req->department;
            $employeeinser->shift_id  = $req->shift;
            $employeeinser->doj = $req->txtemp_doj;
            $employeeinser->dol = $req->txtemp_dol;
            $employeeinser->save();
            return response()->json(['success' => 'Record Updated Successfully']);
        }
        else
        {
            return response()->json(['errors' =>$validator->errors()->all()]);
        }

    }

    //view
    public function view($id)
    {
        if (request() -> ajax()) 
        {
            //$emp = Employee::where('id',$id)->first();

            $emp = DB::table('employees')->
            join('departments','employees.department_id','departments.dep_id')->
            join('shifts','employees.shift_id','shifts.s_id')->where('id',$id)->first();

            return response()->json(['result' => $emp]);
        }
    }
}
