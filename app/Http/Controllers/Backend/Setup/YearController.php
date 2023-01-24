<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use DB;
use App\Model\year;
use App\Role;
use App\Role_action;
use Auth;

class YearController extends Controller
{

    public function view(){
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){


        $data['allData']=Year::all();


        return view ('backend.setup.year.view-year',$data);
         }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->view_year_act){

        return view('backend.setup.year.add-year');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:years,name',
        ]);

        $data =new Year();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Logo update success');
        return redirect()->route('setups.student.year.view');
    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->view_year_act){

        $editData=Year::find($id);
        return view('backend.setup.year.add-year',compact('editData'));
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =Year::find($id);
        $this->validate($request,[

            'name'=>'required|unique:years,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.student.year.view');

    }


    public function delete($id){ 
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->view_year_act){


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
