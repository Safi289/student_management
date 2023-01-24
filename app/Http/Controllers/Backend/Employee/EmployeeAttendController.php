<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LeavePurpose;
use App\Model\EmployeeSalaryLog;
use App\Model\AssignStudent;
use App\Model\Designation;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\EmployeeAttendence;
use App\Model\EmployeeLeave;
use App\User;

use Illuminate\Support\Facades\DB;
use PDF;
use App\Role;
use Auth;
use App\Role_action;

class EmployeeAttendController extends Controller
{
    public function view(){


        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee){

        $data['allData']=EmployeeAttendence::select('date')->groupBy('date')->orderBy('id','desc')->get();


        return view ('backend.employee.employee_attend.view-attendence', $data);
        }
        else{
            return redirect('home');
        }


    }



    public function add(){
      $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
      $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee && $access_action->employee_att_act){
        $data['employees']=User::where('usertype','employee')->get();

        $data['leave_purpose']=LeavePurpose::all();


        return view('backend.employee.employee_attend.add-attendence',$data);
        }
        else{
            return redirect('home');
        }

    }

    public function store(Request $request){

        EmployeeAttendence::where('date',date('Y-m-d',strtotime($request->date)))->delete();

       $countemployee=count($request->employee_id);
       for($i=0; $i<$countemployee;$i++){
           $attend_status='attend_status'.$i;
           $attend=new EmployeeAttendence();
           $attend->date=date('Y-m-d',strtotime($request->date));
           $attend->employee_id=$request->employee_id[$i];
           $attend->attend_status=$request->$attend_status;
           $attend->save();

       }

        return redirect()->route('employees.attendence.view')->with('success', 'Data insert successfull');


    }

    public function edit($date){
      $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
      $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee && $access_action->employee_att_act){
        $data['editData']=EmployeeAttendence::where('date',$date)->get();
        $data['employees']=User::where('usertype','employee')->get();

        $data['leave_purpose']=LeavePurpose::all();


        return view('backend.employee.employee_attend.add-attendence',$data);
         }
        else{
            return redirect('home');
        }



    }




    public function details($date)
    {
       $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee){
        $data['details']=EmployeeAttendence::where('date',$date)->get();


        return view('backend.employee.employee_attend.details-attendence',$data);
        }
        else{
            return redirect('home');
        }

    }



}
