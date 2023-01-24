<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\Subject;
use Illuminate\Http\Request;
use App\Role;
use App\Role_action;
use Auth;

class SubjectController extends Controller
{


    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){
        $data['allData']=Subject::all();


        return view ('backend.setup.subject.view-subject',$data);
        }
        else{
            return redirect('home');
        }

    }


    public function add(){

        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->subject_view_act){
        return view('backend.setup.subject.add-subject');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:subjects,name',
        ]);

        $data =new Subject();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Subjuect update success');
        return redirect()->route('setups.subject.view');
    }

    public function edit($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->subject_view_act){
        $editData=Subject::find($id);
        return view('backend.setup.subject.add-subject',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =Subject::find($id);
        $this->validate($request,[

            'name'=>'required|unique:subjects,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.subject.view');

    }


    public function delete($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->subject_view_act){
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
