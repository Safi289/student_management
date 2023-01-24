@extends('backend.layouts.master')

@section('content')
@php
    $access = App\Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_submenu = App\Role_submenu::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_action = App\Role_action::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    @endphp

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Permissions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Permissions</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->


                        <div class="card">
                            <div class="card-header">
                                <h3> <div style="font-size: medium; font-weight: bold;">Permission List</div> 
                                	<div style="color: red">{{ $roles->name }}</div>
                
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">

                            	<form action="{{ route('set-permission') }}" method="POST">
                            	@csrf
                                <table id="" class="table table-bordered table-hover">
                                    <input type="hidden" name="role_id" value="{{ $roles->id}}">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Permissions</th>
                                       
                                        
                                        <th>Menu Access</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  
                                   
                                    <tr>
                                    	
                                        <td>1</td>
                                        <td><strong>{{$permissions[0]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->manage_user)
    										<input type="checkbox" name="manage_user" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="manage_user" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[0]->name }}
                                           @if($role_submenu->view_user)
                                           <input type="checkbox" name="view_user" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="view_user" value="1">
                                           @endif
                                           
                                            Action
                                            @if($role_action->view_user_act)
                                            <input type="checkbox" name="view_user_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="view_user_act" value="1">
                                            @endif
                                           
                                        </td>

                                    </tr>
                                    <tr>
                                        
                                        <td>2</td>
                                        <td><strong>{{$permissions[1]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->manage_profile)
                                            <input type="checkbox" name="manage_profile" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="manage_profile" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[2]->name }}
                                           @if($role_submenu->your_profile)
                                           <input type="checkbox" name="your_profile" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="your_profile" value="1">
                                           @endif<br><hr>
                                           
                                           2. {{ $sub_menu[1]->name }}
                                           @if($role_submenu->change_password)
                                           <input type="checkbox" name="change_password" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="change_password" value="1">
                                           @endif
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>3</td>
                                        <td><strong>{{$permissions[2]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->manage_slider)
                                            <input type="checkbox" name="manage_slider" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="manage_slider" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[3]->name }}
                                           @if($role_submenu->view_slider)
                                           <input type="checkbox" name="view_slider" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="view_slider" value="1">
                                           @endif
                                           
                                            Action
                                            @if($role_action->view_slider_act)
                                            <input type="checkbox" name="view_slider_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="view_slider_act" value="1">
                                            @endif
                                           
                                          
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>4</td>
                                        <td><strong>{{$permissions[3]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->manage_setup)
                                            <input type="checkbox" name="manage_setup" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="manage_setup" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td colspan="2">
                                           
                                           
                                           1. {{ $sub_menu[4]->name }}
                                            @if($role_submenu->student_class)
                                           <input type="checkbox" name="student_class" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="student_class" value="1">
                                           @endif

                                           Action
                                            @if($role_action->student_class_act)
                                            <input type="checkbox" name="student_class_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="student_class_act" value="1">
                                            @endif<hr>
                                           2. {{ $sub_menu[5]->name }}
                                            @if($role_submenu->view_year)
                                           <input type="checkbox" name="view_year" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="view_year" value="1">
                                           @endif
                                            Action
                                             @if($role_action->view_year_act)
                                            <input type="checkbox" name="view_year_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="view_year_act" value="1">
                                            @endif
                                           <hr>
                                           3. {{ $sub_menu[6]->name }}
                                            @if($role_submenu->view_group)
                                           <input type="checkbox" name="view_group" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="view_group" value="1">
                                           @endif
                                            Action
                                             @if($role_action->view_group_act)
                                            <input type="checkbox" name="view_group_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="view_group_act" value="1">
                                            @endif<hr>
                                           4. {{ $sub_menu[7]->name }}
                                            @if($role_submenu->student_shift)
                                           <input type="checkbox" name="student_shift" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="student_shift" value="1">
                                           @endif
                                            Action
                                            @if($role_action->student_shift_act)
                                            <input type="checkbox" name="student_shift_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="student_shift_act" value="1">
                                            @endif<hr>
                                           5. {{ $sub_menu[13]->name }}
                                            @if($role_submenu->free_category)
                                           <input type="checkbox" name="free_category" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="free_category" value="1">
                                           @endif
                                            Action
                                            @if($role_action->fee_category_act)
                                            <input type="checkbox" name="fee_category_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="fee_category_act" value="1">
                                            @endif<hr>
                                           6. {{ $sub_menu[8]->name }}
                                            @if($role_submenu->category_amount)
                                           <input type="checkbox" name="category_amount" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="category_amount" value="1">
                                           @endif
                                            Action
                                           @if($role_action->category_amount_act)
                                            <input type="checkbox" name="category_amount_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="category_amount_act" value="1">
                                            @endif<hr>
                                           7. {{ $sub_menu[9]->name }}
                                            @if($role_submenu->exam_type)
                                           <input type="checkbox" name="exam_type" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="exam_type" value="1">
                                           @endif
                                            Action
                                            @if($role_action->exam_type_act)
                                            <input type="checkbox" name="exam_type_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="exam_type_act" value="1">
                                            @endif<hr>
                                           8. {{ $sub_menu[10]->name }}
                                            @if($role_submenu->subject_view)
                                           <input type="checkbox" name="subject_view" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="subject_view" value="1">
                                           @endif
                                            Action
                                            @if($role_action->subject_view_act)
                                            <input type="checkbox" name="subject_view_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="subject_view_act" value="1">
                                            @endif
                                           <hr>
                                           9. {{ $sub_menu[11]->name }}
                                            @if($role_submenu->assign_subject)
                                           <input type="checkbox" name="assign_subject" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="assign_subject" value="1">
                                           @endif
                                            Action
                                            @if($role_action->assign_subject_act)
                                            <input type="checkbox" name="assign_subject_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="assign_subject_act" value="1">
                                            @endif<hr>
                                           10. {{ $sub_menu[12]->name }}
                                           @if($role_submenu->designation)
                                           <input type="checkbox" name="designation" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="designation" value="1">
                                           @endif
                                            Action
                                           @if($role_action->designation_act)
                                            <input type="checkbox" name="designation_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="designation_act" value="1">
                                            @endif<br>
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>5</td>
                                        <td><strong>{{$permissions[4]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->manage_students)
                                            <input type="checkbox" name="manage_students" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="manage_students" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[18]->name }}
                                           @if($role_submenu->student_registration)
                                           <input type="checkbox" name="student_registration" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="student_registration" value="1">
                                           @endif
                                            Action
                                             @if($role_action->student_reg_act)
                                            <input type="checkbox" name="student_reg_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="student_reg_act" value="1">
                                            @endif
                                           <hr>
                                           2. {{ $sub_menu[17]->name }}
                                           @if($role_submenu->roll_generate)
                                           <input type="checkbox" name="roll_generate" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="roll_generate" value="1">
                                           @endif
                                           Action
                                            @if($role_action->roll_generate_act)
                                            <input type="checkbox" name="roll_generate_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="roll_generate_act" value="1">
                                            @endif<hr>
                                           3. {{ $sub_menu[16]->name }}
                                           @if($role_submenu->registration_fee)
                                           <input type="checkbox" name="registration_fee" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="registration_fee" value="1">
                                           @endif
                                          <hr>
                                           4. {{ $sub_menu[15]->name }}
                                          @if($role_submenu->monthly_fee)
                                           <input type="checkbox" name="monthly_fee" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="monthly_fee" value="1">
                                           @endif
                                           <hr>
                                           5. {{ $sub_menu[14]->name }}
                                            @if($role_submenu->exam_fee)
                                           <input type="checkbox" name="exam_fee" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="exam_fee" value="1">
                                           @endif
                                           <br>
                                           
                                           
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>6</td>
                                        <td><strong>{{$permissions[5]->name}}</strong></td>    
                                       
                                        <td>
                                             @if($roles->manage_employee)
                                            <input type="checkbox" name="manage_employee" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="manage_employee" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td colspan="2">
                                          
                                           1. {{ $sub_menu[21]->name }}
                                           @if($role_submenu->employee_registration)
                                           <input type="checkbox" name="employee_registration" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="employee_registration" value="1">
                                           @endif
                                           Action
                                            @if($role_action->employee_reg_act)
                                            <input type="checkbox" name="employee_reg_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="employee_reg_act" value="1">
                                            @endif<hr>
                                           2. {{ $sub_menu[22]->name }}
                                             @if($role_submenu->employee_salary)
                                           <input type="checkbox" name="employee_salary" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="employee_salary" value="1">
                                           @endif
                                           Action
                                            @if($role_action->employee_salary_act)
                                            <input type="checkbox" name="employee_salary_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="employee_salary_act" value="1">
                                            @endif<hr>
                                           3. {{ $sub_menu[20]->name }}
                                             @if($role_submenu->employee_leave)
                                           <input type="checkbox" name="employee_leave" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="employee_leave" value="1">
                                           @endif
                                           Action
                                            @if($role_action->employee_leave_act)
                                            <input type="checkbox" name="employee_leave_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="employee_leave_act" value="1">
                                            @endif<hr>
                                           4. {{ $sub_menu[19]->name }}
                                             @if($role_submenu->employee_attendence)
                                           <input type="checkbox" name="employee_attendence" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="employee_attendence" value="1">
                                           @endif
                                           Action
                                             @if($role_action->employee_att_act)
                                            <input type="checkbox" name="employee_att_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="employee_att_act" value="1">
                                            @endif<hr>
                                           5. {{ $sub_menu[23]->name }}
                                            @if($role_submenu->employee_monthly_salary)
                                           <input type="checkbox" name="employee_monthly_salary" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="employee_monthly_salary" value="1">
                                           @endif
                                           Action
                                             @if($role_action->employee_mon_salary_act)
                                            <input type="checkbox" name="employee_mon_salary_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="employee_mon_salary_act" value="1">
                                            @endif<br>
                                           
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>7</td>
                                        <td><strong>{{$permissions[6]->name}}</strong></td>    
                                       
                                        <td>
                                             @if($roles->marks_management)
                                            <input type="checkbox" name="marks_management" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="marks_management" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[26]->name }}
                                             @if($role_submenu->marks_entry)
                                           <input type="checkbox" name="marks_entry" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="marks_entry" value="1">
                                           @endif
                                           Action
                                           @if($role_action->marks_entry_act)
                                            <input type="checkbox" name="marks_entry_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="marks_entry_act" value="1">
                                            @endif<hr>
                                           2. {{ $sub_menu[24]->name }}
                                             @if($role_submenu->marks_edit)
                                           <input type="checkbox" name="marks_edit" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="marks_edit" value="1">
                                           @endif
                                           Action
                                            @if($role_action->marks_edit_act)
                                            <input type="checkbox" name="marks_edit_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="marks_edit_act" value="1">
                                            @endif<hr>
                                           3. {{ $sub_menu[25]->name }}
                                            @if($role_submenu->grade_point)
                                           <input type="checkbox" name="grade_point" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="grade_point" value="1">
                                           @endif
                                           Action
                                            @if($role_action->grade_point_act)
                                            <input type="checkbox" name="grade_point_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="grade_point_act" value="1">
                                            @endif<br>
                                          
                                           
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>8</td>
                                        <td><strong>{{$permissions[7]->name}}</strong></td>    
                                       
                                        <td>
                                             @if($roles->accounts_management)
                                            <input type="checkbox" name="accounts_management" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="accounts_management" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[27]->name }}
                                             @if($role_submenu->students_fee)
                                           <input type="checkbox" name="students_fee" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="students_fee" value="1">
                                           @endif
                                           Action
                                            @if($role_action->students_fee_act)
                                            <input type="checkbox" name="students_fee_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="students_fee_act" value="1">
                                            @endif<hr>
                                           2. {{ $sub_menu[28]->name }}
                                             @if($role_submenu->emp_salary)
                                           <input type="checkbox" name="emp_salary" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="emp_salary" value="1">
                                           @endif
                                           Action
                                            @if($role_action->emp_salary_act)
                                            <input type="checkbox" name="emp_salary_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="emp_salary_act" value="1">
                                            @endif<hr>
                                           3. {{ $sub_menu[29]->name }}
                                            @if($role_submenu->other_cost)
                                           <input type="checkbox" name="other_cost" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="other_cost" value="1">
                                           @endif
                                           Action
                                           @if($role_action->other_cost_act)
                                            <input type="checkbox" name="other_cost_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="other_cost_act" value="1">
                                            @endif<br>
                                          
                                           
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>9</td>
                                        <td><strong>{{$permissions[8]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->report_management)
                                            <input type="checkbox" name="report_management" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="report_management" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                      <tr>
                                        <td></td>
                                        <td colspan="2">
                                           1. {{ $sub_menu[30]->name }}
                                             @if($role_submenu->monthly_profit)
                                           <input type="checkbox" name="monthly_profit" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="monthly_profit" value="1">
                                           @endif
                                           <hr>
                                           2. {{ $sub_menu[31]->name }}
                                             @if($role_submenu->marksheet)
                                           <input type="checkbox" name="marksheet" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="marksheet" value="1">
                                           @endif
                                           <hr>
                                           3. {{ $sub_menu[32]->name }}
                                            @if($role_submenu->attendence_report)
                                           <input type="checkbox" name="attendence_report" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="attendence_report" value="1">
                                           @endif
                                           <hr>
                                           4. {{ $sub_menu[33]->name }}
                                            @if($role_submenu->student_result)
                                           <input type="checkbox" name="student_result" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="student_result" value="1">
                                           @endif
                                           <hr>
                                           5. {{ $sub_menu[34]->name }}
                                             @if($role_submenu->student_id_card)
                                           <input type="checkbox" name="student_id_card" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="student_id_card" value="1">
                                           @endif
                                          <br>
                                           
                                          
                                           
                                           
                                          
                                           
                                          
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td>10</td>
                                        <td><strong>{{$permissions[9]->name}}</strong></td>    
                                       
                                        <td>
                                            @if($roles->role_management)
                                            <input type="checkbox" name="role_management" value="1" checked="">
                                             @else
                                            <input type="checkbox" name="role_management" value="1">
                                            @endif
                                        </td> 
                                    </tr>
                                     <tr>
                                        <td></td>
                                        <td colspan="2">
                                          
                                           
                                          
                                           
                                           1. {{ $sub_menu[35]->name }}
                                            @if($role_submenu->role_permission)
                                           <input type="checkbox" name="role_permission" value="1" checked="">
                                           @else
                                           <input type="checkbox" name="role_permission" value="1">
                                           @endif
                                           Action
                                            @if($role_action->role_permission_act)
                                            <input type="checkbox" name="role_permission_act" value="1" checked="">
                                            @else
                                            <input type="checkbox" name="role_permission_act" value="1">
                                            @endif<br>
                                                                                    
                                        </td>
                                    </tr>
                                     
                                   

                                    </tbody>



                                </table>
                                @if($access_action->role_permission_act)
                                <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
                                @endif
                                </form>

                                

                            </div><!-- /.card-body -->
                        </div>



                    </section>

                </div>

            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection