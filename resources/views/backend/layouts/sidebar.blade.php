
@php
    $access = App\Role::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
    $access_submenu = App\Role_submenu::orderBy('id', 'ASC')->where('id', '=', Auth::user()->role_id)->first();
@endphp

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if($access->manage_user)
        <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage User
                    <i class="fas fa-angle-left right"></i>

                </p>
            </a>
             @if($access_submenu->view_user)
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('users.view')}}" class="nav-link ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View User</p>
                    </a>
                </li>



            </ul>
            @endif
        </li>
        @endif
        @if($access->manage_profile)
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    Manage Profile
                    <i class="fas fa-angle-left right"></i>

                </p>
            </a>
            <ul class="nav nav-treeview">
                 @if($access_submenu->your_profile)
                <li class="nav-item">
                    <a href="{{route('profiles.view')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Your Profile</p>
                    </a>
                </li>
                @endif
                @if($access_submenu->change_password)
                <li class="nav-item">
                    <a href="{{route('profiles.password.view')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Change Your password</p>
                    </a>
                </li>
                @endif


            </ul>
        </li>
        @endif
        @if($access->manage_slider)
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage Slider
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->view_slider)
                    <li class="nav-item">
                        <a href="{{route('sliders.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Slider</p>
                        </a>
                    </li>
                    @endif

                </ul>
            </li>
            @endif
            @if($access->manage_setup)
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage Setup
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                @if($access_submenu->student_class)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('setups.student.class.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Class</p>
                        </a>
                    </li>

                </ul>
                @endif
                @if($access_submenu->view_year)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('setups.student.year.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Year</p>
                        </a>
                    </li>

                </ul>
                @endif
                @if($access_submenu->view_group)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('setups.student.group.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Group</p>
                        </a>
                    </li>

                </ul>
                @endif
                @if($access_submenu->student_shift)
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('setups.student.shift.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Shift</p>
                        </a>
                    </li>

                </ul>
                @endif
                <ul class="nav nav-treeview">
                    @if($access_submenu->free_category)
                    <li class="nav-item">
                        <a href="{{route('setups.fee.category.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Fee Category</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->category_amount)
                    <li class="nav-item">
                        <a href="{{route('setups.fee.amount.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p> Fee Category Amount</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->exam_type)
                    <li class="nav-item">
                        <a href="{{route('setups.exam.type.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exam Type</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->subject_view)
                    <li class="nav-item">
                        <a href="{{route('setups.subject.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject View</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->assign_subject)
                    <li class="nav-item">
                        <a href="{{route('setups.assign.subject.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assign Subject</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->designation)
                    <li class="nav-item">
                        <a href="{{route('setups.designation.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Designation</p>
                        </a>
                    </li>
                    @endif
                </ul>
                @endif

            @if($access->manage_students)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage Students
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->student_registration)
                    <li class="nav-item">
                        <a href="{{route('students.registration.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Registration</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->roll_generate)
                    <li class="nav-item">
                        <a href="{{route('students.roll.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Roll Genarate</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->registration_fee)
                    <li class="nav-item">
                        <a href="{{route('students.reg.fee.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Registration Fee</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->monthly_fee)
                    <li class="nav-item">
                        <a href="{{route('students.monthly.fee.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Monthly Fee</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->exam_fee)
                    <li class="nav-item">
                        <a href="{{route('students.exam.fee.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exam Fee</p>
                        </a>
                    </li>
                    @endif


                </ul>
            </li>
            @endif
            @if($access->manage_employee)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Manage Employee
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->employee_registration)
                    <li class="nav-item">

                        <a href="{{route('employees.reg.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Registration</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->employee_salary)
                    <li class="nav-item">
                        <a href="{{route('employees.salary.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Salary</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->employee_leave)
                    <li class="nav-item">
                        <a href="{{route('employees.leave.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Leave</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->employee_attendence)
                    <li class="nav-item">
                        <a href="{{route('employees.attendence.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Attendence</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->employee_monthly_salary)
                    <li class="nav-item">
                        <a href="{{route('employees.monthly.salary.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Monthly Salary</p>
                        </a>
                    </li>
                    @endif


                </ul>
            </li>
            @endif

            @if($access->marks_management)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Marks Management
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->marks_entry)
                    <li class="nav-item">
                        <a href="{{route('marks.add')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Entry</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->marks_edit)
                    <li class="nav-item">
                        <a href="{{route('marks.edit')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marks Edit</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->grade_point)
                    <li class="nav-item">
                        <a href="{{route('marks.grade.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Grade Point</p>
                        </a>
                    </li>
                    @endif




                </ul>
            </li>
            @endif

            @if($access->accounts_management)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Accounts Management
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->students_fee)
                    <li class="nav-item">
                        <a href="{{route('accounts.fee.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Students Fee</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->emp_salary)

                    <li class="nav-item">
                        <a href="{{route('accounts.salary.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Employee Salary</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->other_cost)
                    <li class="nav-item">
                        <a href="{{route('accounts.cost.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Other Cost</p>
                        </a>
                    </li>
                    @endif





                </ul>
            </li>
            @endif
            @if($access->report_management)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Report Management
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if($access_submenu->monthly_profit)
                    <li class="nav-item">
                        <a href="{{route('reports.profit.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Monthly Profit</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->marksheet)
                    <li class="nav-item">
                        <a href="{{route('reports.marksheet.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Marksheet</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->attendence_report)
                    <li class="nav-item">
                        <a href="{{route('reports.attendence.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Attendence Report</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->student_result)
                    <li class="nav-item">
                        <a href="{{route('reports.result.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student Result</p>
                        </a>
                    </li>
                    @endif
                    @if($access_submenu->student_id_card)
                    <li class="nav-item">
                        <a href="{{route('reports.id-card.view')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Student ID Card</p>
                        </a>
                    </li>
                    @endif
                   



                </ul>
            </li>
            @endif

            @if($access->role_management)
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Role Management
                        <i class="fas fa-angle-left right"></i>

                    </p>
                </a>
                <ul class="nav nav-treeview">
                   
                    @if($access_submenu->role_permission)
                    <li class="nav-item">
                        <a href="{{ route('role-permission') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Role Permission</p>
                        </a>
                    </li>
                    @endif



                </ul>
            </li>
            @endif





    </ul>
</nav>