<?php

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

Route::get('/', function () {
    return view('home');
});


Route::post('/adminlogin', 'Auth\LoginController@adminlogin')->name('adminlogin');
Route::get('/admin', 'Admin\AdminController@index');
Route::get('/dashboard', 'ProfileController@view')->name('pro');
Route::auth();

Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['admin']], function () {  
        
        Route::any('/employee/search','Admin\UsermanagementController@search');
        Route::resource('employee','Admin\UsermanagementController');
        Route::post('/employee/checkemail',['uses'=>'Admin\UsermanagementController@checkEmail']);
       
        Route::any('/designation/search','Admin\SystemroleController@search');
        Route::resource('designation','Admin\SystemroleController');
        
        Route::resource('leave','Admin\LeaveController');
        Route::any('/leave/search','Admin\LeaveController@search');
    
        Route::get('attendance','Admin\AttendanceController@index')->name('attendance.index');
        Route::get('attendance/add','Admin\AttendanceController@create')->name('attendance.create');
        Route::post('attendance/store','Admin\AttendanceController@store')->name('attendance.store');
// Route::get('attendance/edit','Admin\AttendanceController@edit1')->name('attendance.edit1');
        Route::post('attendance/update','Admin\AttendanceController@update1')->name('attendance.update1');
        Route::any('/attendance/search','Admin\AttendanceController@search');
        Route::post('/attendance/checkdate','Admin\AttendanceController@checkDate');

        // Route::post('attendance/addUser', 'Admin\AttendanceController@addUser');        
       
        Route::post('/masterattendance/checkdate','Admin\MasterAttendanceController@checkDate');        
        Route::get('master-attendance', 'Admin\MasterAttendanceController@index')->name('master-attendance');
        Route::get('master-attendance/getUsers', 'Admin\MasterAttendanceController@getUsers');
        Route::post('master-attendance/addUser', 'Admin\MasterAttendanceController@addUser');
        Route::post('master-attendance/updateUser', 'Admin\MasterAttendanceController@updateUser');

        Route::get('events','Admin\EventController@index')->name('event-index');
        Route::get('event/add','Admin\EventController@createEvent')->name('event-add');
        Route::post('event/store','Admin\EventController@store')->name('event-store');
        Route::get('admin/calendar','Admin\EventController@calender')->name('calendar');
        Route::any('/event/search','Admin\EventController@search');
       
        Route::get('report','Admin\EventController@report')->name('report');
        Route::any('/report/search','Admin\EventController@search1');

        Route::resource('paystructure','Admin\SalarystructureController');
        Route::any('/paystructure/search','Admin\SalarystructureController@search');

        Route::get('payroll','Admin\PayrollController@index')->name('payroll.index');
        Route::any('/payroll/search','Admin\PayrollController@search');
        Route::get('payroll/add','Admin\PayrollController@create')->name('payroll.create');
        Route::post('payroll/store','Admin\PayrollController@store')->name('payroll.store');
        Route::get('payroll/{id}','Admin\PayrollController@view')->name('payroll.show');
        Route::get('pdfview/{id}','Admin\PayrollController@pdfview')->name('pdfview1');

    });
});


Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['employee']], function () {
        Route::resource('profile', 'Employee\DetailsController');
        
        Route::resource('userleave','Employee\UserLeaveController');
        
        Route::get('calendar','Employee\EventController@calender')->name('ecalendar');
        
        Route::get('salary','Employee\PayrollController@index')->name('salary.index');
        Route::get('salary/{id}','Employee\PayrollController@pdfview')->name('pdfview');
    });
});


