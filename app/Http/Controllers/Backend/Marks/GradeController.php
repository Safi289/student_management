<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Model\MarksGrade;
use Illuminate\Http\Request;
use App\Role;
use App\Role_action;
use Auth;
class GradeController extends Controller
{
   
    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->marks_management){
        $data['allData']=MarksGrade::all();
        return view('backend.marks.grade-marks-view', $data);
        }
        else{
            return redirect('home');
        }

    }

    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->marks_management && $access_action->grade_point_act){
        return view('backend.marks.grade-marks-add');
        }
        else{
            return redirect('home');
        }

    }
    public function store(Request $request){

        $data= new MarksGrade();
        $data->grade_name=$request->grade_name;
        $data->grade_point=$request->grade_point;
        $data->start_marks=$request->start_marks;
        $data->end_marks=$request->end_marks;
        $data->start_point=$request->start_point;
        $data->end_point=$request->end_point;
        $data->remarks=$request->remarks;
        $data->save();
        return redirect()->route('marks.grade.view')->with('success', 'Data Insert Success');

    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->marks_management && $access_action->grade_point_act){
        $data['editData']=MarksGrade::find($id);
        return view('backend.marks.grade-marks-add',$data);
        }
        else{
            return redirect('home');
        }
    }

    public function update(Request $request,$id){
        $data=MarksGrade::find($id);
        $data->grade_name=$request->grade_name;
        $data->grade_point=$request->grade_point;
        $data->start_marks=$request->start_marks;
        $data->end_marks=$request->end_marks;
        $data->start_point=$request->start_point;
        $data->end_point=$request->end_point;
        $data->remarks=$request->remarks;
        $data->save();
        return redirect()->route('marks.grade.view')->with("success", "Data Updated Successfuly");

    }

}
