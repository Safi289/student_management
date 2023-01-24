<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\AssignSubject;
use App\Model\Subject;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use Illuminate\Support\Facades\Auth;
use Mpdf\Tag\A;
use App\User;
use App\Role;
use App\Role_action;


class AssignSubjectController extends Controller
{

    function __construct()
    {
        $this->middleware('assign_subject:assign_subject-list|add-assign-subject mnjk |product-edit|product-delete', ['only' => ['index','show']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }



    public function view(){

        
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup){


        $data['allData']=AssignSubject::select('class_id')->groupBy('class_id')->get();


        return view ('backend.setup.assign_subject.view-assign-subject',$data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->assign_subject_act){
        $data['subjects']=Subject::all();
        $data['classes']=StudentClass::all();

        return view('backend.setup.assign_subject.add-assign-subject',$data);
        }
        else{
            return redirect('home');
        }
    }

    public function store(Request $request){

        $countSubject=count($request->subject_id);

        if($countSubject != Null){
            for($i=0; $i < $countSubject ; $i++){
                $assign_sub=new AssignSubject();
                $assign_sub->class_id=$request->class_id;
                $assign_sub->subject_id=$request->subject_id[$i];
                $assign_sub->full_mark=$request->full_mark[$i];
                $assign_sub->pass_mark=$request->pass_mark[$i];
                $assign_sub->subjective_mark=$request->subjective_mark[$i];
                $assign_sub->save();

            }
        }

        session()->flash('success',' assign_subject update success');
        return redirect()->route('setups.assign.subject.view');
    }

    public function edit($class_id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->assign_subject_act){

        $data['editData']=AssignSubject::where ('class_id',$class_id)->get();
        $data['subjects']=Subject::all();
        $data['classes']=StudentClass::all();

        return view('backend.setup.assign_subject.edit-assign-subject',$data);
        }
        else{
            return redirect('home');
        }
    }


    public function update(Request $request,$class_id){
        if ($request->subject_id==Null){

            return redirect()->back()->with('error', 'sorry you dont select any Item');
        }else{

           AssignSubject::WhereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
           foreach ($request->subject_id as $key=>$value){

               $assign_subject_exist=AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
            if($assign_subject_exist){
                $assignsubject=$assign_subject_exist;
            }else{
                $assignsubject= New AssignSubject();
            }
            $assignsubject->class_id=$request->class_id;
               $assignsubject->subject_id=$request->subject_id[$key];
               $assignsubject->full_mark=$request->full_mark[$key];
               $assignsubject->pass_mark=$request->pass_mark[$key];
               $assignsubject->subjective_mark=$request->subjective_mark[$key];

               $assignsubject->save();


           }
        }

        session()->flash('success',' class update success');
        return redirect()->route('setups.assign.subject.view');

    }


    public function details($class_id){
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->assign_subject_act){
        $data['editData']=AssignSubject::where ('class_id',$class_id)->get();


        return view('backend.setup.assign_subject.details-assign-subject',$data);
        }
        else{
            return redirect('home');
        }

    }



    public function delete($id){
        $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_setup && $access_action->assign_subject_act){
        $data=FeeCategory::find($id);
        $data->delete();



        session()->flash('success', 'Logo has deleted Successfully');
        return redirect()->route('setups.fee.amount.view');
        }
        else{
            return redirect('home');
        }
    }

}
