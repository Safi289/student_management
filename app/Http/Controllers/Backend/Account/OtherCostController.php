<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountOtherCost;
use Illuminate\Http\Request;
use App\Role;
use Auth;
use App\Role_action;
class OtherCostController extends Controller
{
    
    public function view(){
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->accounts_management){
        $data['allData']=AccountOtherCost::orderBy('id','desc')->get();
        return view('backend.account.cost.other-cost-view', $data);
        }
        else{
            return redirect('home');
        }
    }

    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->accounts_management && $access_action->other_cost_act){

        return view('backend.account.cost.other-cost-add');
        }
        else{
            return redirect('home');
        }

    }

    public function store(Request $request){

        $cost=new AccountOtherCost();
        $cost->date=date('Y-m-d',strtotime($request->date));
        $cost->amount=$request->amount;

        if($request->file('image')){

            $file=$request->file('image');
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image']=$filename;
        }
        $cost->description=$request->description;
        $cost->save();
        return redirect()->route('accounts.cost.view')->with('success', "Data Save Successfully");



    }

    public function edit($id){
         $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
         $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->accounts_management && $access_action->other_cost_act){
        $data['editData']=AccountOtherCost::find($id);
        return view('backend.account.cost.other-cost-add',$data);
        }
        else{
            return redirect('home');
        }
    }

    public function update(Request $request,$id){
        $cost=AccountOtherCost::find($id);
        $cost->date=date('Y-m-d',strtotime($request->date));
        $cost->amount=$request->amount;
        if($request->file('image')){

            $file=$request->file('image');
            @unlink(public_path('upload/cost_images/'.$cost->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'),$filename);
            $cost['image']=$filename;
        }
        $cost->description=$request->description;
        $cost->save();
        return redirect()->route('accounts.cost.view')->with('success', "Data Save Successfully");



    }

}
