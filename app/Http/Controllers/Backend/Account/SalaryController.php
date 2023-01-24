<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountEmployeeSalary;
use App\Model\EmployeeAttendence;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use App\Role_action;
class SalaryController extends Controller
{
   
    public function view()
    {
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->accounts_management){
        $data['allData'] = AccountEmployeeSalary::all();
        return view('backend.account.employee.view-salary', $data);
        }
        else{
            return redirect('home');
        }
    }

    public function add(){

          $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->accounts_management && $access_action->emp_salary_act){
        return view ('backend.account.employee.add-salary');
        }
        else{
            return redirect('home');
        }

    }

    public function getemployee(Request $request){


        $date=date('Y-m',strtotime($request->date));
       if ($date!=''){

           $where[]=['date','like',$date.'%'];
       }
       $data=EmployeeAttendence::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();


        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID NO</th>';
        $html['thsource'].= '<th>Employee Name</th>';
        $html['thsource'].= '<th>Basic Salary</th>';
        $html['thsource'].= '<th>Salary(This Month)</th>';
        $html['thsource'].= '<th>Select</th>';

        foreach ($data as $key =>$attend){
            $account_salary=AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();

            if($account_salary !=null){
                $checked='checked';
            }else{
                $checked='';

            }


            $totalattend=EmployeeAttendence::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount=count($totalattend->where('attend_status','absent'));


            $html[$key]['tdsource']='<td>' .($key+1).'</td>';
            $html[$key]['tdsource'].='<td>' .$attend['user']['id_no'] .'<input type ="hidden" name="date" value=" '.$date.' ">'.'</td>';
            $html[$key]['tdsource'].='<td>' .$attend['user']['name'] .'</td>';
            $html[$key]['tdsource'].='<td>' .$attend['user']['salary'] .'</td>';
            $salary=(float)$attend['user']['salary'];
            $salaryperday=(float)$salary/30;
            $totalsalaryminus=(float)$absentcount*(float)$salaryperday;
            $totalsalary=(float)$salary-(float)$totalsalaryminus;

            $html[$key]['tdsource'].='<td>' .$totalsalary.'<input type ="text" name="amount[]" value=" '.$totalsalary.' " >'.'</td>';

            $html[$key]['tdsource'].='<td>' .'<input type ="hidden" name="employee_id[]" value=" '.$attend->employee_id.'">'.'<input type="checkbox" 
        name="checkmanage[]" value="'.$key.' " '.$checked.' style="transform:scale(1.5); margin-left:10px;">'   .'</td>';


        }
        return response()->json(@$html);


    }

    public function store(Request $request){

        $date =date('Y-m',strtotime($request->date));
        AccountEmployeeSalary::where('date',$date)->delete();
        $checkdata=$request->checkmanage;
        if($checkdata!=null){

            for($i=0; $i<count($checkdata);$i++){

                $data=new AccountEmployeeSalary();
                $data->date=$date;
                $data->employee_id=$request->employee_id[$checkdata[$i]];

                $data->amount=$request->amount[$checkdata[$i]];
                $data->save();


            }

        }
        if(!empty(@$data) ||empty ($checkdata)){

            return redirect()->route('accounts.salary.view')->with('success','Well done Successfully Update');
        }else{

            return redirect()->back()->with('error', 'Sorry! Data not saved');
        }

    }




}
