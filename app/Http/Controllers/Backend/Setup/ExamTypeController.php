<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\ExamType;
use Illuminate\Http\Request;
use App\Role;
use App\Role_action;
use Auth;

class ExamTypeController extends Controller
{

    public function view(){
        
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){

        $data['allData']=ExamType::all();


        return view ('backend.setup.exam_type.view-exam-type',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->exam_type_act){

        return view('backend.setup.exam_type.add-exam-type');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:exam_types,name',
        ]);

        $data =new ExamType();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Exam update success');
        return redirect()->route('setups.exam.type.view');
    }

    public function edit($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->exam_type_act){
        $editData=ExamType::find($id);
        return view('backend.setup.exam_type.add-exam-type',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =ExamType::find($id);
        $this->validate($request,[

            'name'=>'required|unique:exam_types,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.exam.type.view');

    }


    public function delete($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->exam_type_act){
        $data=StudentClass::find($id);
        $data->delete();



        session()->flash('success', 'Logo has deleted Successfully');
        return redirect()->route('setups.student.class.view');
        }
        else{
            return redirect('home');
        }
    }


}
