<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_submenu extends Model
{
    protected $fillable =[
        "name", "guard_name", "view_user", "your_profile", "change_password", "view_slider", "student_class", "view_year", "view_group", "student_shift", "free_category", "category_amount", "exam_type", "subject_view", "assign_subject", "designation" ,"student_registration", "roll_generate", "registration_fee", "monthly_fee", "exam_fee", "employee_registration", "employee_salary", "employee_leave", "employee_attendence", "employee_monthly_salary", "marks_entry", "marks_edit", "grade_point", "students_fee", "other_cost", "monthly_profit", "marksheet", "attendence_report", "student_result", "student_id_card", "role_permission"
    ];
}