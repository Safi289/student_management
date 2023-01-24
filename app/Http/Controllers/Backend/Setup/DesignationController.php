<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\Designation;
use Illuminate\Http\Request;
use App\Role;
use App\Role_action;
use Auth;

class DesignationController extends Controller
{
    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){
        $data['allData']=Designation::all();


        return view ('backend.setup.designation.view-designation',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->designation_act){
        return view('backend.setup.designation.add-designation');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:designations,name',
        ]);

        $data =new Designation();
        $data->name=$request->name;

        $data->save();
        session()->flash('success','Designation update success');
        return redirect()->route('setups.designation.view');
    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->designation_act){

        $editData=Designation::find($id);
        return view('backend.setup.designation.add-designation',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =Designation::find($id);
        $this->validate($request,[

            'name'=>'required|unique:designations,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.designation.view');

    }


    public function delete($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->designation_act){
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
