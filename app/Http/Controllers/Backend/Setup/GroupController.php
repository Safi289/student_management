<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\StudentGroup;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use DB;
use App\Model\year;
use App\Role;
use App\Role_action;
use Auth;

class GroupController extends Controller
{

    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){


        $data['allData']=StudentGroup::all();


        return view ('backend.setup.group.view-group',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){ 
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->view_group_act){
        return view('backend.setup.group.add-group');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:student_groups,name',
        ]);

        $data =new StudentGroup();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Logo update success');
        return redirect()->route('setups.student.group.view');
    }

    public function edit($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->view_group_act){
        $editData=StudentGroup::find($id);
        return view('backend.setup.group.add-group',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =StudentGroup::find($id);
        $this->validate($request,[

            'name'=>'required|unique:student_groups,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.student.group.view');

    }




}
