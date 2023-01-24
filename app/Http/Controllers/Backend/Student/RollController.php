<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\User;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Role;
use Auth;

class RollController extends Controller
{


    public function view()
    {
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students){
        $data['years'] = Year::orderBy('id','asc')->get();

        $data['classes'] = StudentClass::all();

        return view('backend.student.student_roll.view-roll-generate', $data);

        }
        else{
            return redirect('home');
        }
    }

    public function getStudent(Request $request){
      /* dd('ok');*/
      $allData=AssignStudent::with(['student'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();

return response()->json($allData);

    }

    public function store(Request $request){

        $year_id=$request->year_id;
        $class_id=$request->class_id;
        if($request->student_id !=null){
            for($i=0;$i<count($request->student_id);$i++){
                AssignStudent::where(['year_id'=>$year_id,'class_id'=>$class_id, 'student_id'=>$request->student_id[$i]])
                    ->update(['roll'=>$request->roll[$i]]);
            }

        }else{
            return redirect()->back()->with('error', "sorry there are no sudent");
        }
        return redirect()->route('students.roll.view')->with('success', "successfully roll generate");
    }


    }