<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\StudentShift;
use Illuminate\Http\Request;
use DB;
use App\Role;
use App\Role_action;
use Auth;

class ShiftController extends Controller
{


    public function view(){
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){


        $data['allData']=StudentShift::all();


        return view ('backend.setup.shift.view-shift',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->student_shift_act){

        return view('backend.setup.shift.add-shift');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:student_shifts,name',
        ]);

        $data =new StudentShift();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Logo update success');
        return redirect()->route('setups.student.shift.view');
    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->student_shift_act){

        $editData=StudentShift::find($id);
        return view('backend.setup.shift.add-shift',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =StudentShift::find($id);
        $this->validate($request,[

            'name'=>'required|unique:student_shifts,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.student.shift.view');

    }



}
