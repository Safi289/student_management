<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\FeeCategoryAmount;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\User;
use Illuminate\Support\Facades\DB;
use Mpdf\Tag\A;
use PDF;
use App\Role;
use Auth;

class RegistrationFeeController extends Controller
{


    public function view()
    {
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students){
        $data['years'] = Year::orderBy('id', 'asc')->get();

        $data['classes'] = StudentClass::all();

        return view('backend.student.registration_fee.view-registration-fee', $data);
        }
        else{
            return redirect('home');
        }


    }

    public function getStudent(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id != '') {
            $where[] = ['year_id','like', $year_id.'%'];

        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];

        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        $html['thsource'] = '<th> SL</th>';
        $html['thsource'].= '<th>ID NO</th>';
        $html['thsource'].= '<th>Student Name</th>';
        $html['thsource'].= '<th>Roll No</th>';
        $html['thsource'].= '<th>Registration Fee</th>';
        $html['thsource'].= '<th>Discount Amount</th>';
        $html['thsource'].= '<th>Fee (This Student)</th>';
        $html['thsource'].= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {

            $registrationfee = FeeCategoryAmount::where('fee_category_id', '1')->where('class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . 'TK' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '%' . '</td>';

            $orginalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount / 100 * $orginalfee;
            $finalfee = (float)$orginalfee - (float)$discountablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . 'TK' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color .'"  titel="Payslip" target="_blank" href=" ' . route("students.reg.fee.payslip") .'?class_id=' . $v->class_id . '&student_id=' . $v->student_id . '">  Fee Slip </a>';
            $html[$key]['tdsource'] .= '</td>';


        }
        return response()->json(@$html);

    }

    public function payslip(Request $request){

        $student_id=$request->student_id;
        $class_id=$request->class_id;
        $allstudent['details']=AssignStudent::with (['discount','student'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
       /* $allstudent['report']=ReportHeading::where('status','1')->first();*/
        $pdf = PDF::loadView('backend.student.registration_fee.registration-fee-slip-pdf', $allstudent);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');


    }


}

