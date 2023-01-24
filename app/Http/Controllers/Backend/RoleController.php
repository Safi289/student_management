<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Role_submenu;
use App\Role_action;
use App\Permission;
use App\User;
use Auth;

class RoleController extends Controller
{

    public function index()
    {
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->role_management){
            
            $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
            
            $roles = Role::orderBy('id', 'DESC')->get();
            return view('backend.role_permission.index', compact('roles', 'access'));
        }
        else{
            return redirect('home');
        }
    }

    public function permission($id)
    {
        $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
        if($access->role_management){

            $access = Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
            $roles       = Role::orderBy('id', 'DESC')->where('id', $id)->first();
            $permissions = Permission::orderBy('id', 'ASC')->get();

            $role_permission = Permission::orderBy('permissions.id', 'ASC')
                                ->join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                                ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                                ->get();

            $sub_menu = Permission::orderBy('22permissions22.parent_id', 'ASC')
                                    ->join('22permissions22', '22permissions22.parent_id', '=', 'permissions.id')
                                    ->select('22permissions22.name', '22permissions22.parent_id', '22permissions22.id')
                                    ->get();
            $role_submenu = Role_submenu::orderBy('id', 'DESC')->where('id', $id)->first();

            $role_action = Role_action::orderBy('id', 'DESC')->where('id', $id)->first();
            // return $child_menu; exit();
            return view('backend.role_permission.permission', compact('roles', 'permissions', 'role_permission', 'access', 'sub_menu', 'role_submenu', 'role_action'));
         }
        else{
            return redirect('home');
        }
    }

    public function set_permission(Request $request)
    {
        // return $request; exit();
        $role = Role::find($request->role_id);

        $role->manage_user     = $request->manage_user;
        $role->manage_profile  = $request->manage_profile;
        $role->manage_slider   = $request->manage_slider;
        $role->manage_setup    = $request->manage_setup;
        $role->manage_students = $request->manage_students;
        $role->manage_employee = $request->manage_employee;
        $role->marks_management    = $request->marks_management;
        $role->accounts_management = $request->accounts_management;
        $role->report_management   = $request->report_management;
        $role->role_management     = $request->role_management;
        $role->save();



        $role_submenu = Role_submenu::find($request->role_id);

        $role_submenu->view_user         = $request->view_user;
        $role_submenu->your_profile      = $request->your_profile;
        $role_submenu->change_password   = $request->change_password;
        $role_submenu->view_slider       = $request->view_slider;
        $role_submenu->student_class     = $request->student_class;
        $role_submenu->view_year         = $request->view_year;
        $role_submenu->view_group        = $request->view_group;
        $role_submenu->student_shift     = $request->student_shift;
        $role_submenu->free_category     = $request->free_category;
        $role_submenu->category_amount   = $request->category_amount;
        $role_submenu->exam_type         = $request->exam_type;
        $role_submenu->subject_view      = $request->subject_view;
        $role_submenu->assign_subject    = $request->assign_subject;
        $role_submenu->designation       = $request->designation;
        $role_submenu->student_registration     = $request->student_registration;
        $role_submenu->roll_generate            = $request->roll_generate;
        $role_submenu->registration_fee         = $request->registration_fee;
        $role_submenu->monthly_fee              = $request->monthly_fee;
        $role_submenu->exam_fee                 = $request->exam_fee;
        $role_submenu->employee_registration    = $request->employee_registration;
        $role_submenu->employee_salary          = $request->employee_salary;
        $role_submenu->employee_leave           = $request->employee_leave;
        $role_submenu->employee_attendence     = $request->employee_attendence;
        $role_submenu->employee_monthly_salary = $request->employee_monthly_salary;
        $role_submenu->marks_entry             = $request->marks_entry;
        $role_submenu->marks_entry             = $request->marks_entry;
        $role_submenu->marks_edit              = $request->marks_edit;
        $role_submenu->grade_point             = $request->grade_point;
        $role_submenu->students_fee            = $request->students_fee;
        $role_submenu->emp_salary            = $request->emp_salary;
        $role_submenu->other_cost              = $request->other_cost;
        $role_submenu->monthly_profit          = $request->monthly_profit;
        $role_submenu->marksheet               = $request->marksheet;
        $role_submenu->attendence_report       = $request->attendence_report;
        $role_submenu->student_result          = $request->student_result;
        $role_submenu->student_id_card         = $request->student_id_card;
        $role_submenu->role_permission         = $request->role_permission;
        $role_submenu->save();



        $role_action = Role_action::find($request->role_id);

        $role_action->view_user_act         = $request->view_user_act;
        $role_action->view_slider_act       = $request->view_slider_act;
        $role_action->student_class_act     = $request->student_class_act;
        $role_action->view_year_act         = $request->view_year_act;
        $role_action->view_group_act        = $request->view_group_act;
        $role_action->student_shift_act       = $request->student_shift_act;
        $role_action->fee_category_act        = $request->fee_category_act;
        $role_action->category_amount_act     = $request->category_amount_act;
        $role_action->exam_type_act           = $request->exam_type_act;
        $role_action->subject_view_act        = $request->subject_view_act;
        $role_action->assign_subject_act      = $request->assign_subject_act;
        $role_action->designation_act         = $request->designation_act;
        $role_action->student_reg_act         = $request->student_reg_act;
        $role_action->roll_generate_act       = $request->roll_generate_act;
        $role_action->reg_fee_act             = $request->reg_fee_act;
        $role_action->monthly_fee_act         = $request->monthly_fee_act;
        $role_action->exam_fee_act            = $request->exam_fee_act;
        $role_action->employee_reg_act        = $request->employee_reg_act;
        $role_action->employee_salary_act     = $request->employee_salary_act;
        $role_action->employee_leave_act      = $request->employee_leave_act;
        $role_action->employee_att_act        = $request->employee_att_act;
        $role_action->employee_mon_salary_act    = $request->employee_mon_salary_act;
        $role_action->marks_entry_act            = $request->marks_entry_act;
        $role_action->marks_edit_act             = $request->marks_edit_act;
        $role_action->grade_point_act            = $request->grade_point_act;
        $role_action->students_fee_act           = $request->students_fee_act;
        $role_action->emp_salary_act             = $request->emp_salary_act;
        $role_action->other_cost_act             = $request->other_cost_act;
        $role_action->monthly_profit_act         = $request->monthly_profit_act;
        $role_action->marksheet_act              = $request->marksheet_act;
        $role_action->attendence_report_act      = $request->attendence_report_act;
        $role_action->student_result_act         = $request->student_result_act;
        $role_action->student_id_card_act        = $request->student_id_card_act;
        $role_action->role_permission_act        = $request->role_permission_act;
        $role_action->save();


        session()->flash('success',' Permission update success');
        return back();
    }
    
}
