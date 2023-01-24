<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployeeSalaryLog;
use App\Model\AssignStudent;
use App\Model\Designation;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\User;

use Illuminate\Support\Facades\DB;
use PDF;
use App\Role_action;
use App\Role;
use Auth;

class EmployeeRegController extends Controller
{


    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee){
        $data['allData']=User::where('usertype','employee')->get();


        return view ('backend.employee.employee_reg.view-employee', $data);
        }
        else{
            return redirect('home');
        }


    }



    public function add(){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee && $access_action->employee_reg_act){
        $data['designations']=Designation::all();


        return view('backend.employee.employee_reg.add-employee',$data);
        }
        else{
            return redirect('home');
        }

    }

    public function store(Request $request){

        DB::transaction(function ()use($request){
            $chekYear=date('Ym',strtotime($request->join_date));
            $employee=User::where('usertype','employee')->orderBy('id','DESC')->first();
            if($employee==null){
                $firstReg=0;
                $employeeId=$firstReg+1;
                if($employeeId<10){
                    $id_no='000'.$employeeId;

                }elseif ($employeeId<100){

                    $id_no='00'.$employeeId;
                }elseif ($employeeId<1000){
                    $id_no='0'.$employeeId;
                }

            }else{

                $employee=User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
                $employeeId=$employee+1;
                if($employeeId<10){
                    $id_no='000'.$employeeId;
                }elseif ($employeeId<100){

                    $id_no='00'.$employeeId;
                }elseif ($employeeId<1000){
                    $id_no='0'.$employeeId;
                }
            }
            $final_id_no=$chekYear.$id_no;
            $user=new User();
            $code=rand(0000,9999);
            $user->code=$code;
            $user->password= bcrypt($code);
            $user->usertype='employee';
            $user->id_no=$final_id_no;
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->salary=$request->salary;
            $user->designation_id=$request->designation_id;
            $user->dob=date('Y-m-d',strtotime($request->dob));
            $user->join_date=date('Y-m-d',strtotime($request->join_date));

            if($request->file('image')){

                $file=$request->file('image');
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image']=$filename;
            }
            $user->save();

            $employee_salary=new EmployeeSalaryLog();
            $employee_salary->employee_id=$user->id;
            $employee_salary->effected_date=date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary=$request->salary;
            $employee_salary->present_salary=$request->present_salary;
            $employee_salary->increment_salary='0';

            $employee_salary->save();



        });

        return redirect()->route('employees.reg.view')->with('success', 'Data Insert successfull');
    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();

         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee && $access_action->employee_reg_act){
        $data['editData']=User::find($id);
        /* dd($data['editData']->toArray());*/
        $data['designations']=Designation::all();

        return view('backend.employee.employee_reg.add-employee',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function update(Request $request,$id){

        DB::transaction(function ()use($request,$id){

            $user=User::find($id);

            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;

            $user->designation_id=$request->designation_id;
            $user->dob=date('Y-m-d',strtotime($request->dob));


            if($request->file('image')){

                $file=$request->file('image');
                @unlink(public_path('upload/employee_images/'.$user->image));
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'),$filename);
                $user['image']=$filename;
            }
            $user->save();




        });

        return redirect()->route('employees.reg.view')->with('success', 'Data Insert successfull');


    }



    public function details($id)
    {
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_employee){
        $data ['details']=User::find($id);
        $pdf = PDF::loadView('backend/employee/employee_reg/employee-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
        }
        else{
            return redirect('home');
        }
    }




    /* $data ['details']= AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
     $pdf = PDF::loadView('test-pdf', $data);

     return $pdf->download('itsolutionstuff.pdf');*/


    /*$data ['details']= AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    $pdf =Pdf ::loadView('backend.student.student-reg.details-student-pdf', $data);
    $pdf->SetProtection(['copy', 'print'], '', 'pass');
    return $pdf->stream('document.pdf');*/





}
