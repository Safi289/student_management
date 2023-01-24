<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_action extends Model
{
    protected $fillable =[
        "name", "guard_name", "view_user_act", "view_slider_act", "student_class_act", "view_year_act", "view_group_act", "student_shift_act", "fee_category_act", "category_amount_act", "exam_type_act", "subject_view_act", "assign_subject_act", "designation_act" ,"student_reg_act", "roll_generate_act", "reg_fee_act", "monthly_fee_act", "exam_fee_act", "employee_reg_act", "employee_salary_act", "employee_leave_act", "employee_att_act", "employee_mon_salary_act", "marks_entry_act", "marks_edit_act", "grade_point_act", "students_fee_act", "other_cost_act", "monthly_profit_act", "marksheet_act", "attendence_report_act", "student_result_act", "student_id_card_act", "role_permission_act"
    ];
}