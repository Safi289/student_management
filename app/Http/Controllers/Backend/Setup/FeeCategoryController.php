<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\FeeCategory;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\year;
use DB;
use App\Role;
use App\Role_action;
use Auth;
class FeeCategoryController extends Controller
{

    public function view(){

        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){

        $data['allData']=FeeCategory::all();


        return view ('backend.setup.fee_category.view-fee-category',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->fee_category_act){

        return view('backend.setup.fee_category.add-fee-category');
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){
        $this->validate($request,[

            'name'=>'required|unique:fee_categories,name',
        ]);

        $data =new FeeCategory();
        $data->name=$request->name;

        $data->save();
        session()->flash('success',' Logo update success');
        return redirect()->route('setups.fee.category.view');
    }

    public function edit($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->fee_category_act){
        $editData=FeeCategory::find($id);
        return view('backend.setup.fee_category.add-fee-category',compact('editData'));
         }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$id){

        $data =FeeCategory::find($id);
        $this->validate($request,[

            'name'=>'required|unique:fee_categories,name,'.$data->id
        ]);


        $data->name=$request->name;

        $data->save();
        session()->flash('success',' class update success');
        return redirect()->route('setups.fee.category.view');

    }


    public function delete($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->fee_category_act){

        $data=FeeCategory::find($id);
        $data->delete();



        session()->flash('success', 'Logo has deleted Successfully');
        return redirect()->route('setups.fee.category.view');
        }
        else{
            return redirect('home');
        }
    }

}
