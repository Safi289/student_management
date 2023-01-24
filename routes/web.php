<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'Website\PageController@index')->name('index');


Route::group(['prefix'=>'website'], function(){


    Route::get('pages.admission-info', 'Website\PageController@admissioninfo')->name('website.addmission-info');
    Route::get('pages.aboutus', 'Website\PageController@aboutus')->name('website.aboutus');
    Route::get('pages.comon', 'Website\PageController@messageprincipal')->name('website.comon');
    Route::get('pages.gallery', 'Website\PageController@gallery')->name('website.gallery');
    Route::get('pages.contact', 'Website\PageController@contact')->name('website.contact');
    Route::get('pages.notice', 'Website\PageController@notice')->name('website.notice');


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');







Route::group(['prefix'=>'users','middleware' => 'auth'], function(){

    
    
    Route::get('/view', 'Backend\UserController@view')->name('users.view');
    Route::get('/add', 'Backend\UserController@add')->name('users.add');
    Route::post('/store', 'Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
    Route::post('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    Route::resource('roles','Backend\RolesControllerr');
    

    //role permissiom
    Route::get('/role-permission', 'Backend\RoleController@index')->name('role-permission');
    Route::get('/permission/{id}', 'Backend\RoleController@permission')->name('permission');
    Route::post('/set-permission', 'Backend\RoleController@set_permission')->name('set-permission');

});


/*Route::group(['prefix'=>'permission','middleware' => 'auth'], function(){

    Route::get('/permission/view', 'Backend\RoleController@view')->name('permission.view');
    Route::get('/add', 'Backend\UserController@add')->name('users.add');
    Route::post('/store', 'Backend\UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
    Route::post('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');

});*/







Route::group(['prefix'=>'profiles','middleware' => 'auth'], function(){

    Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
    Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
    Route::post('/store', 'Backend\ProfileController@update')->name('profiles.update');
    Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
    Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');


});






Route::group(['prefix'=>'sliders','middleware' => 'auth'], function(){

    Route::get('/view', 'Backend\SliderController@view')->name('sliders.view');
    Route::get('/add', 'Backend\SliderController@add')->name('sliders.add');
    Route::post('/store', 'Backend\SliderController@store')->name('sliders.store');
    Route::get('/edit/{id}', 'Backend\SliderController@edit')->name('sliders.edit');
    Route::post('/update/{id}', 'Backend\SliderController@update')->name('sliders.update');
    Route::post('/delete/{id}', 'Backend\SliderController@delete')->name('sliders.delete');
});

Route::group(['prefix'=>'setups','middleware' => 'auth'], function(){

    Route::get('/student/class/view', 'Backend\Setup\StudentClassController@view')->name('setups.student.class.view');
    Route::get('/student/class/add', 'Backend\Setup\StudentClassController@add')->name('setups.student.class.add');
    Route::post('/student/class/store', 'Backend\Setup\StudentClassController@store')->name('setups.student.class.store');
    Route::get('/student/class/edit/{id}', 'Backend\Setup\StudentClassController@edit')->name('setups.student.class.edit');
    Route::post('/student/class/update/{id}', 'Backend\Setup\StudentClassController@update')->name('setups.student.class.update');
    Route::post('/student/class/delete/{id}', 'Backend\Setup\StudentClassController@delete')->name('setups.student.class.delete');

    //Year session

    Route::get('/student/year/view', 'Backend\Setup\YearController@view')->name('setups.student.year.view');
    Route::get('/student/year/add', 'Backend\Setup\YearController@add')->name('setups.student.year.add');
    Route::post('/student/year/store', 'Backend\Setup\YearController@store')->name('setups.student.year.store');
    Route::get('/student/year/edit/{id}', 'Backend\Setup\YearController@edit')->name('setups.student.year.edit');
    Route::post('/student/year/update/{id}', 'Backend\Setup\YearController@update')->name('setups.student.year.update');
    Route::post('/student/year/delete/{id}', 'Backend\Setup\YearController@delete')->name('setups.student.year.delete');
    //Group
    Route::get('/student/group/view', 'Backend\Setup\GroupController@view')->name('setups.student.group.view');
    Route::get('/student/group/add', 'Backend\Setup\GroupController@add')->name('setups.student.group.add');
    Route::post('/student/group/store', 'Backend\Setup\GroupController@store')->name('setups.student.group.store');
    Route::get('/student/group/edit/{id}', 'Backend\Setup\GroupController@edit')->name('setups.student.group.edit');
    Route::post('/student/group/update/{id}', 'Backend\Setup\GroupController@update')->name('setups.student.group.update');
    Route::post('/student/group/delete/{id}', 'Backend\Setup\GroupController@delete')->name('setups.student.group.delete');
    //Student Shift
    Route::get('/student/shift/view', 'Backend\Setup\ShiftController@view')->name('setups.student.shift.view');
    Route::get('/student/shift/add', 'Backend\Setup\ShiftController@add')->name('setups.student.shift.add');
    Route::post('/student/shift/store', 'Backend\Setup\ShiftController@store')->name('setups.student.shift.store');
    Route::get('/student/shift/edit/{id}', 'Backend\Setup\ShiftController@edit')->name('setups.student.shift.edit');
    Route::post('/student/shift/update/{id}', 'Backend\Setup\ShiftController@update')->name('setups.student.shift.update');
    Route::post('/student/shift/delete/{id}', 'Backend\Setup\ShiftController@delete')->name('setups.student.shift.delete');

    //Fee Category
    Route::get('/fee/category/view', 'Backend\Setup\FeeCategoryController@view')->name('setups.fee.category.view');
    Route::get('/fee/category/add', 'Backend\Setup\FeeCategoryController@add')->name('setups.fee.category.add');
    Route::post('/fee/category/store', 'Backend\Setup\FeeCategoryController@store')->name('setups.fee.category.store');
    Route::get('/fee/category/edit/{id}', 'Backend\Setup\FeeCategoryController@edit')->name('setups.fee.category.edit');
    Route::post('/fee/category/update/{id}', 'Backend\Setup\FeeCategoryController@update')->name('setups.fee.category.update');
    Route::post('/fee/category/delete/{id}', 'Backend\Setup\FeeCategoryController@delete')->name('setups.fee.category.delete');

    //Fee Category Amount
    Route::get('/fee/amount/view', 'Backend\Setup\FeeAmountController@view')->name('setups.fee.amount.view');
    Route::get('/fee/amount/add', 'Backend\Setup\FeeAmountController@add')->name('setups.fee.amount.add');
    Route::post('/fee/amount/store', 'Backend\Setup\FeeAmountController@store')->name('setups.fee.amount.store');
    Route::get('/fee/amount/edit/{fee_category_id}', 'Backend\Setup\FeeAmountController@edit')->name('setups.fee.amount.edit');
    Route::post('/fee/amount/update/{fee_category_id}', 'Backend\Setup\FeeAmountController@update')->name('setups.fee.amount.update');
    Route::post('/fee/amount/delete/{id}', 'Backend\Setup\FeeAmountController@delete')->name('setups.fee.amount.delete');
    Route::get('/fee/amount/details/{fee_category_id}', 'Backend\Setup\FeeAmountController@details')->name('setups.fee.amount.details');

    //Exam Type
    Route::get('/exam/type/view', 'Backend\Setup\ExamTypeController@view')->name('setups.exam.type.view');
    Route::get('/exam/type/add', 'Backend\Setup\ExamTypeController@add')->name('setups.exam.type.add');
    Route::post('/exam/type/store', 'Backend\Setup\ExamTypeController@store')->name('setups.exam.type.store');
    Route::get('/exam/type/edit/{id}', 'Backend\Setup\ExamTypeController@edit')->name('setups.exam.type.edit');
    Route::post('/exam/type/update/{id}', 'Backend\Setup\ExamTypeController@update')->name('setups.exam.type.update');
    Route::post('/exam/type/delete/{id}', 'Backend\Setup\ExamTypeController@delete')->name('setups.exam.type.delete');

    //Subject View
    Route::get('/subject/view', 'Backend\Setup\SubjectController@view')->name('setups.subject.view');
    Route::get('/subject/view/add', 'Backend\Setup\SubjectController@add')->name('setups.subject.add');
    Route::post('/subject/view/store', 'Backend\Setup\SubjectController@store')->name('setups.subject.store');
    Route::get('/subject/view/edit/{id}', 'Backend\Setup\SubjectController@edit')->name('setups.subject.edit');
    Route::post('/subject/view/update/{id}', 'Backend\Setup\SubjectController@update')->name('setups.subject.update');
    Route::post('/subject/view/delete/{id}', 'Backend\Setup\SubjectController@delete')->name('setups.subject.delete');

    //Assign Subject
    Route::get('/assign/subject/view', 'Backend\Setup\AssignSubjectController@view')->name('setups.assign.subject.view');
    Route::get('/assign/subject/add', 'Backend\Setup\AssignSubjectController@add')->name('setups.assign.subject.add');
    Route::post('/assign/subject/store', 'Backend\Setup\AssignSubjectController@store')->name('setups.assign.subject.store');
    Route::get('/assign/subject/edit/{class_id}', 'Backend\Setup\AssignSubjectController@edit')->name('setups.assign.subject.edit');
    Route::post('/assign/subject/update/{class_id}', 'Backend\Setup\AssignSubjectController@update')->name('setups.assign.subject.update');
    Route::post('/assign/subject/delete/{id}', 'Backend\Setup\AssignSubjectController@delete')->name('setups.assign.subject.delete');
    Route::get('/assign/subject/details/{class_id}', 'Backend\Setup\AssignSubjectController@details')->name('setups.assign.subject.details');
    //Designation
    Route::get('/designation/view', 'Backend\Setup\DesignationController@view')->name('setups.designation.view');
    Route::get('/designation/view/add', 'Backend\Setup\DesignationController@add')->name('setups.designation.add');
    Route::post('/designation/view/store', 'Backend\Setup\DesignationController@store')->name('setups.designation.store');
    Route::get('/designation/view/edit/{id}', 'Backend\Setup\DesignationController@edit')->name('setups.designation.edit');
    Route::post('/designation/view/update/{id}', 'Backend\Setup\DesignationController@update')->name('setups.designation.update');
    Route::post('/designation/view/delete/{id}', 'Backend\Setup\DesignationController@delete')->name('setups.designation.delete');


});


Route::group(['prefix'=>'students','middleware' => 'auth'], function(){
    //Student Registration Part

    Route::get('/reg/view', 'Backend\Student\RegController@view')->name('students.registration.view');
    Route::get('/reg/add', 'Backend\Student\RegController@add')->name('students.registration.add');
    Route::post('/reg/store', 'Backend\Student\RegController@store')->name('students.registration.store');
    Route::get('/reg/edit/{student_id}', 'Backend\Student\RegController@edit')->name('students.registration.edit');
    Route::post('/reg/update/{student_id}', 'Backend\Student\RegController@update')->name('students.registration.update');
    Route::get('/year-class-wise', 'Backend\Student\RegController@YearClassWise')->name('students.year.class.wise');
    Route::get('/reg/promotion/{student_id}', 'Backend\Student\RegController@promotion')->name('students.registration.promotion');
    Route::post('/reg/promotion/{student_id}', 'Backend\Student\RegController@promotionstore')->name('students.registration.promotion.store');
    Route::get('/reg/details/{student_id}', 'Backend\Student\RegController@details')->name('students.registration.details');
    //Student Roll Genarate Part
    Route::get('/roll/view', 'Backend\Student\RollController@view')->name('students.roll.view');
    Route::get('/roll/get-student', 'Backend\Student\RollController@getstudent')->name('students.roll.get-student');
    Route::post('/roll/store', 'Backend\Student\RollController@store')->name('students.roll.store');
    //Student Registration Fee
    Route::get('/reg/fee/view', 'Backend\Student\RegistrationFeeController@view')->name('students.reg.fee.view');
    Route::get('/reg/get-student', 'Backend\Student\RegistrationFeeController@getstudent')->name('students.reg.fee.get-student');
    Route::get('/reg/fee/payslip', 'Backend\Student\RegistrationFeeController@payslip')->name('students.reg.fee.payslip');
    //Student Monthly Fee
    Route::get('/month/fee/view', 'Backend\Student\MonthlyFeeController@view')->name('students.monthly.fee.view');
    Route::get('/month/get-student', 'Backend\Student\MonthlyFeeController@getstudent')->name('students.monthly.fee.get-student');
    Route::get('/month/fee/payslip', 'Backend\Student\MonthlyFeeController@payslip')->name('students.monthly.fee.payslip');

    //Student Exam Fee
    Route::get('/exam/fee/view', 'Backend\Student\ExamFeeController@view')->name('students.exam.fee.view');
    Route::get('/exam/get-student', 'Backend\Student\ExamFeeController@getstudent')->name('students.exam.fee.get-student');
    Route::get('/exam/fee/payslip', 'Backend\Student\ExamFeeController@payslip')->name('students.exam.fee.payslip');

    //Employee Registration

    Route::group(['prefix'=>'employees','middleware' => 'auth'], function(){

        Route::get('/reg/view', 'Backend\Employee\EmployeeRegController@view')->name('employees.reg.view');
        Route::get('/reg/add', 'Backend\Employee\EmployeeRegController@add')->name('employees.reg.add');
        Route::post('/reg/store', 'Backend\Employee\EmployeeRegController@store')->name('employees.reg.store');
        Route::get('/reg/edit/{id}', 'Backend\Employee\EmployeeRegController@edit')->name('employees.reg.edit');
        Route::post('/reg/update/{id}', 'Backend\Employee\EmployeeRegController@update')->name('employees.reg.update');
        Route::post('/reg/delete/{id}', 'Backend\Employee\EmployeeRegController@delete')->name('employees.reg.delete');
        Route::get('/reg/details/{id}', 'Backend\Employee\EmployeeRegController@details')->name('employees.reg.details');
    });
        //Employee Salary

    Route::group(['prefix'=>'employees','middleware' => 'auth'], function(){

        Route::get('/salary/view', 'Backend\Employee\EmployeeSalaryController@view')->name('employees.salary.view');

        Route::get('/salary/increment/{id}', 'Backend\Employee\EmployeeSalaryController@increment')->name('employees.salary.increment');
        Route::post('/salary/store/{id}', 'Backend\Employee\EmployeeSalaryController@store')->name('employees.salary.store');
        Route::get('/salary/details/{id}', 'Backend\Employee\EmployeeSalaryController@details')->name('employees.salary.details');
    });

    //Employee Leave

    Route::group(['prefix'=>'employees','middleware' => 'auth'], function() {

        Route::get('/leave/view', 'Backend\Employee\EmployeeLeaveController@view')->name('employees.leave.view');
        Route::get('/leave/add', 'Backend\Employee\EmployeeLeaveController@add')->name('employees.leave.add');
        Route::post('/leave/store', 'Backend\Employee\EmployeeLeaveController@store')->name('employees.leave.store');
        Route::get('/leave/edit/{id}', 'Backend\Employee\EmployeeLeaveController@edit')->name('employees.leave.edit');
        Route::post('/leave/update/{id}', 'Backend\Employee\EmployeeLeaveController@update')->name('employees.leave.update');

});

    //Employee Attendence

    Route::group(['prefix'=>'employees','middleware' => 'auth'], function() {

        Route::get('/attend/view', 'Backend\Employee\EmployeeAttendController@view')->name('employees.attendence.view');
        Route::get('/attend/add', 'Backend\Employee\EmployeeAttendController@add')->name('employees.attendence.add');
        Route::post('/attend/store', 'Backend\Employee\EmployeeAttendController@store')->name('employees.attendence.store');
        Route::get('/attend/edit/{date}', 'Backend\Employee\EmployeeAttendController@edit')->name('employees.attendence.edit');
        Route::post('/attend/update/{id}', 'Backend\Employee\EmployeeAttendController@update')->name('employees.attendence.update');
        Route::get('/attend/details/{date}', 'Backend\Employee\EmployeeAttendController@details')->name('employees.attendence.details');

    });

    //Employee Monthly Salary

    Route::group(['prefix'=>'employees','middleware' => 'auth'], function(){

        Route::get('/monthly/salary/view', 'Backend\Employee\MonthlySalaryController@view')->name('employees.monthly.salary.view');
        Route::get('/monthly/salary/get', 'Backend\Employee\MonthlySalaryController@getSalary')->name('employees.monthly.salary.get');
        Route::get('/monthly/salary/payslip/{employee_id}', 'Backend\Employee\MonthlySalaryController@payslip')->name('employees.monthly.salary.payslip');
    });




});

//Student Marks

Route::group(['prefix'=>'marks','middleware' => 'auth'], function(){

    Route::get('/add', 'Backend\Marks\MarksController@add')->name('marks.add');
    Route::post('/store', 'Backend\Marks\MarksController@store')->name('marks.store');
    Route::get('/edit', 'Backend\Marks\MarksController@edit')->name('marks.edit');
    Route::get('/get-student-marks', 'Backend\Marks\MarksController@getMarks')->name('get-student-marks');
    Route::post('/update', 'Backend\Marks\MarksController@update')->name('marks.update');


    //Grade Point
    Route::get('/grade/view', 'Backend\Marks\GradeController@view')->name('marks.grade.view');
    Route::get('/grade/add', 'Backend\Marks\GradeController@add')->name('marks.grade.add');
    Route::post('/grade/store', 'Backend\Marks\GradeController@store')->name('marks.grade.store');
    Route::get('/grade/edit/{id}', 'Backend\Marks\GradeController@edit')->name('marks.grade.edit');
    Route::post('/grade/update/{id}', 'Backend\Marks\GradeController@update')->name('marks.grade.update');
});


Route::get('/get-student', 'Backend\DefaultController@getStudent')->name('get-student');
Route::get('/get-subject', 'Backend\DefaultController@getSubject')->name('get-subject');

Route::group(['prefix'=>'accounts','middleware' => 'auth'], function(){
//Student Fee
    Route::get('/student/fee/view', 'Backend\Account\StudentFeeController@view')->name('accounts.fee.view');
    Route::get('/student/fee/add', 'Backend\Account\StudentFeeController@add')->name('accounts.fee.add');
    Route::post('/student/fee/store', 'Backend\Account\StudentFeeController@store')->name('accounts.fee.store');
    Route::get('/student/getstudent', 'Backend\Account\StudentFeeController@getstudent')->name('accounts.fee.getstudent');

//Employee Salary
    Route::get('/employee/salary/view', 'Backend\Account\SalaryController@view')->name('accounts.salary.view');
    Route::get('/employee/salary/add', 'Backend\Account\SalaryController@add')->name('accounts.salary.add');
    Route::post('/employee/salary/store', 'Backend\Account\SalaryController@store')->name('accounts.salary.store');
    Route::get('/employee/getemployee', 'Backend\Account\SalaryController@getemployee')->name('accounts.salary.getemployee');

    //Other Cost
    Route::get('/cost/view', 'Backend\Account\OtherCostController@view')->name('accounts.cost.view');
    Route::get('/cost/add', 'Backend\Account\OtherCostController@add')->name('accounts.cost.add');
    Route::post('/cost/store', 'Backend\Account\OtherCostController@store')->name('accounts.cost.store');
    Route::get('/cost/edit/{id}', 'Backend\Account\OtherCostController@edit')->name('accounts.cost.edit');
    Route::post('/cost/update/{id}', 'Backend\Account\OtherCostController@update')->name('accounts.cost.update');


});

Route::group(['prefix'=>'reports','middleware' => 'auth'], function(){
//Monthly Profit
    Route::get('/profit/view', 'Backend\Report\ProfitController@view')->name('reports.profit.view');
    Route::get('/profit/get', 'Backend\Report\ProfitController@profit')->name('reports.profit.datewise.get');
    Route::get('/profit/pdf', 'Backend\Report\ProfitController@pdf')->name('reports.profit.pdf');
    //Marksheet Report
    Route::get('/marksheet/view', 'Backend\Report\ProfitController@marksheetview')->name('reports.marksheet.view');
    Route::get('/marksheet/get', 'Backend\Report\ProfitController@marksheetget')->name('reports.marksheet.get');

//Attendence Report
    Route::get('/attendence/view', 'Backend\Report\ProfitController@attendenceview')->name('reports.attendence.view');
    Route::get('/attendence/get', 'Backend\Report\ProfitController@attendenceget')->name('reports.attendence.get');

//All Student Result
    Route::get('/result/view', 'Backend\Report\ProfitController@resultview')->name('reports.result.view');
    Route::get('/resulte/get', 'Backend\Report\ProfitController@resultget')->name('reports.result.get');
//All Student ID Card
    Route::get('/id-card/view', 'Backend\Report\ProfitController@idCardview')->name('reports.id-card.view');
    Route::get('/id-card/get', 'Backend\Report\ProfitController@idCardget')->name('reports.id-card.get');


});


