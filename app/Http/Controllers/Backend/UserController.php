<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role_action;
use App\Role as Rol;
use Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
class UserController extends Controller
{

    public function view(){


            /*Role::create(['name'=>'admin']);*/
            /*Permission::create(['name'=>'edit']);*/
        $access = Rol::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->manage_user){

            $data['allData']=User::where('usertype','admin')->get();


            return view ('backend.user.view-user', $data);
        }
        else{
            return redirect('home');
        }


    }


    public function add(){

    $access = Rol::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    if($access->manage_user &&  $access_action->view_user_act){
      return view('backend.user.add-user');
    }
    else{
            return redirect('home');
    }

    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email',
            

        ]);


        $data =new User();
        $code=rand(0000,9999);
        $data->usertype= 'admin';
        $data->role_id= $request->role;
        $data->name= $request->name;
        $data->email= $request->email;
        $data->password= bcrypt($code);
        $data->code=$code;
        $data->save();
        session()->flash('success',' Student update success');
        return redirect()->route('users.view');
    }

    public function edit($id){

    $access = Rol::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    if($access->manage_user &&  $access_action->view_user_act){
     $editData=User::find($id);
     return view('backend.user.edit-user',compact('editData'));
      }
    else{
            return redirect('home');
    }
    }


    public function update(Request $request,$id){

        $data =User::find($id);

        $data->name= $request->name;
        $data->email= $request->email;
        $data->role_id= $request->role;
        $data->save();
        session()->flash('success',' Student update success');
        return redirect()->route('users.view');


    }


    public function delete($id){


 $access = Rol::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
  $access_action = Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    if($access->manage_user &&  $access_action->view_user_act){
$user=User::find($id);

        if(! is_null($user)){
            //if it is parent Brand delete sub Brand


            if (File::exists('upload/users' .$user->image)){
                File::delete('upload/users' .$user->image);
            }

            $user->delete();
        }

        session()->flash('success', 'user has deleted Successfully');
        return back();
          }
    else{
            return redirect('home');
    }

    }

}
