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
use App\Role_submenu;
use Auth;

class MonthlySalaryController extends Controller
{

   
    public function view()
    {
        $access = Role_submenu::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        // return $access; exit();
        if($access->employee_monthly_salary){

        return view('backend.employee.monthly_salary.view-salary');
         }
        else{
            return redirect('home');
        }
    }

    public function getSalary(Request $request){

        $date = date('Y-m',strtotime($request->date));

        if ($date != '') {
            $where[] = ['date','like', $date.'%'];


        }
        $data = EmployeeAttendence::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        $html['thsource'] = '<th> SL</th>';
        $html['thsource'].= '<th>Employee Name</th>';
        $html['thsource'].= '<th>Basic Salary</th>';
        $html['thsource'].= '<th>Salary(This Month)</th>';
        $html['thsource'].= '<th>Action</th>';

        foreach ($data as $key => $attend) {

            $totalattend = EmployeeAttendence::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount=count($totalattend->where('attend_status','absent'));
            $color='success';
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'].'</td>';
            $salary=(float)$attend['user']['salary'];
            $salaryperday=(float)$salary/30;
            $totalsalaryminus=(float)$absentcount*(float)$salaryperday;
            $totalsalary=(float)$salary-(float)$totalsalaryminus;
            $html[$key]['tdsource'] .= '<td>' . $totalsalary.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color .'"  titel="Payslip" target="_blank" href=" ' . route("employees.monthly.salary.payslip",$attend->employee_id) .' "> Pay Slip </a>';
            $html[$key]['tdsource'] .= '</td>';

        }
        return response()->json(@$html);


    }

    public function payslip(Request $request,$employee_id){

        $id = EmployeeAttendence::where('employee_id',$employee_id)->first();
       $date=date('Y-m',strtotime($id->date));
       if($date!=''){
           $where[] = ['date','like', $date.'%'];
       }
        $data['totalattendgroupbyid']=EmployeeAttendence::with (['user'])->where($where)->where('employee_id',$id->employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly-salary-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }

    
}

  
