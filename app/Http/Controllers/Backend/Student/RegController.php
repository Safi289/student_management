<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Role;
use Auth;
use App\Role_action;


class RegController extends Controller
{
    public function view(){
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students){
        $data['years']=Year::orderBy('id', 'asc')->get();

        $data['classes']=StudentClass::all();
        $data['year_id']=Year::orderBy('id','asc')->first()->id;
        $data['class_id']=StudentClass::orderBy('id','asc')->first()->id;
        $data['allData']=AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();


        return view ('backend.student.student_reg.view-student', $data);
        }
        else{
            return redirect('home');
        }


    }

    public function YearClassWise(Request $request){

        $data['years']=Year::orderBy('id', 'asc')->get();

        $data['classes']=StudentClass::all();
        $data['year_id']=$request->year_id;
        $data['class_id']=$request->class_id;
        $data['allData']=AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();

        return view ('backend.student.student_reg.view-student', $data);

    }


    public function add(){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students && $access_action->student_reg_act){

        $data['years']=Year::orderBy('id', 'asc')->get();

        $data['classes']=StudentClass::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();

        return view('backend.student.student_reg.add-student',$data);
        }
        else{
            return redirect('home');
        }

    }

    public function store(Request $request){

        DB::transaction(function ()use($request){
    $chekYear=Year::find($request->year_id)->name;
    $student=User::where('usertype','student')->orderBy('id','DESC')->first();
    if($student==null){
        $firstReg=0;
        $studentId=$firstReg+1;
        if($studentId<10){
            $id_no='000'.$studentId;

        }elseif ($studentId<100){

            $id_no='00'.$studentId;
        }elseif ($studentId<1000){
            $id_no='0'.$studentId;
        }

    }else{

        $student=User::where('usertype','student')->orderBy('id','DESC')->first()->id;
        $studentId=$student+1;
        if($studentId<10){
            $id_no='000'.$studentId;
        }elseif ($studentId<100){

            $id_no='00'.$studentId;
        }elseif ($studentId<1000){
            $id_no='0'.$studentId;
        }
    }
        $final_id_no=$chekYear.$id_no;
        $user=new User();
        $code=rand(0000,9999);
        $user->code=$code;
        $user->password= bcrypt($code);
        $user->usertype='student';
        $user->id_no=$final_id_no;
        $user->name=$request->name;
        $user->fname=$request->fname;
        $user->mname=$request->mname;
        $user->mobile=$request->mobile;
        $user->address=$request->address;
        $user->gender=$request->gender;
        $user->religion=$request->religion;
        $user->dob=date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){

                $file=$request->file('image');
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image']=$filename;
            }
        $user->save();

        $assign_student=new AssignStudent();
        $assign_student->student_id=$user->id;
        $assign_student->year_id=$request->year_id;
        $assign_student->class_id=$request->class_id;
        $assign_student->group_id=$request->group_id;
        $assign_student->shift_id=$request->shift_id;

        $assign_student->save();

        $discount_student=new DiscountStudent();
        $discount_student->assign_student_id=$assign_student->id;
        $discount_student->discount=$request->discount;
        $discount_student->fee_category_id='1';
        $discount_student->save();


        });

        return redirect()->route('students.registration.view')->with('success', 'Data Insert successfull');
    }

    public function edit($student_id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students && $access_action->student_reg_act){

        $data['editData']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
      /* dd($data['editData']->toArray());*/

        $data['years']=Year::orderBy('id', 'asc')->get();
        $data['classes']=StudentClass::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();

        return view('backend.student.student_reg.add-student',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function update(Request $request,$student_id){

        DB::transaction(function ()use($request,$student_id){


           $user=User::where('id',$student_id)->first();
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){

                $file=$request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image']=$filename;
            }
            $user->save();

            $assign_student=AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
            $assign_student->year_id=$request->year_id;
            $assign_student->class_id=$request->class_id;
            $assign_student->group_id=$request->group_id;
            $assign_student->shift_id=$request->shift_id;

            $assign_student->save();
            $discount_student=DiscountStudent::where('assign_student_id',$request->id)->first();
            $discount_student->discount=$request->discount;
            $discount_student->save();


        });

        return redirect()->route('students.registration.view')->with('success', 'Data Insert successfull');


    }

    public function promotion($student_id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students && $access_action->student_reg_act){

        $data['editData']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        /*dd($data['editData']->toArray());*/

        $data['years']=Year::orderBy('id', 'asc')->get();
        $data['classes']=StudentClass::all();
        $data['groups']=StudentGroup::all();
        $data['shifts']=StudentShift::all();

        return view('backend.student.student_reg.promotion-student',$data);
        }
        else{
            return redirect('home');
        }


    }

    public function promotionstore(Request $request,$student_id){

        DB::transaction(function ()use($request,$student_id){


            $user=User::where('id',$student_id)->first();
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->religion=$request->religion;
            $user->dob=date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){

                $file=$request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $filename=date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'),$filename);
                $user['image']=$filename;
            }
            $user->save();

            $assign_student= new AssignStudent();
            $assign_student->student_id=$student_id;
            $assign_student->year_id=$request->year_id;
            $assign_student->class_id=$request->class_id;
            $assign_student->group_id=$request->group_id;
            $assign_student->shift_id=$request->shift_id;

            $assign_student->save();
            $discount_student=new DiscountStudent();
            $discount_student->assign_student_id=$assign_student->id;
            $discount_student->fee_category_id='1';
            $discount_student->discount=$request->discount;
            $discount_student->save();


        });

        return redirect()->route('students.registration.view')->with('success', 'Data Insert successfull');


    }

    public function details($student_id)
    {
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_students){
        $data ['details']=AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
        $pdf = PDF::loadView('backend/student/student_reg/student-details-pdf', $data);
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
