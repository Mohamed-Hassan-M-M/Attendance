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
date_default_timezone_set("Africa/Cairo");
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
    ############################### Start Authentication ##############################
    Auth::routes(['register' => false]);
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth:web')->name('admin.logout');

    ############################### Start DashBoard ##############################
    Route::group(['middleware'=>'auth', 'namespace' => 'Admin'],function (){

        Route::get('/admin/{id}', 'DashboardController@adminIndex')->name('admin.home');

        //admin profile routes
        Route::group(['prefix'=>'profile'],function (){
            Route::get('/','ProfileController@index')->name('admin.profile');
            Route::get('-overview','ProfileController@overview')->name('admin.profile.overview');
            Route::get('-editProfile','ProfileController@editProfile')->name('admin.profile.editProfile');
            Route::post('-editProfile','ProfileController@updateProfile')->name('admin.profile.doEditProfile');
            Route::get('-password','ProfileController@password')->name('admin.profile.password');
            Route::post('-password','ProfileController@resetPassword')->name('admin.profile.password.reset');
        });

        //for super admin
        Route::group(['middleware'=>'super_admin'],function (){

            Route::get('/', 'DashboardController@index')->name('superAdmin.home');

            Route::resource('role', 'RoleController');

            Route::resource('entity', 'EntitiesController');

            Route::resource('user', 'UserController');

        });

        // department routes
        Route::group(['prefix'=>'admin'], function (){
            Route::get('{id}/department','DepartmentsController@index')->name('admin.department.index');
            Route::get('{id}/department/create','DepartmentsController@create')->name('admin.department.create');
            Route::post('{id}/department/create','DepartmentsController@store')->name('admin.department.store');
            Route::get('{id}/department/{d_id}/edit','DepartmentsController@edit')->name('admin.department.edit');
            Route::post('{id}/department/{d_id}','DepartmentsController@update')->name('admin.department.update');
            Route::get('{id}/department/{d_id}','DepartmentsController@destroy')->name('admin.department.destroy');
            Route::get('{id}/department/{d_id}/show','DepartmentsController@show')->name('admin.department.show');
        });

        // employee routes
        Route::group(['prefix'=>'admin'], function (){
            Route::get('{id}/employee','EmployeesController@index')->name('admin.employee.index');
            Route::get('{id}/employee/create','EmployeesController@create')->name('admin.employee.create');
            Route::post('{id}/employee/create','EmployeesController@store')->name('admin.employee.store');
            Route::get('{id}/employee/{e_id}/edit','EmployeesController@edit')->name('admin.employee.edit');
            Route::post('{id}/employee/{e_id}','EmployeesController@update')->name('admin.employee.update');
            Route::get('{id}/employee/{e_id}','EmployeesController@destroy')->name('admin.employee.destroy');
            Route::get('{id}/employee/{e_id}/show','EmployeesController@show')->name('admin.employee.show');
        });

        // schedule routes
        Route::group(['prefix'=>'admin'], function (){
            Route::get('{id}/schedule','SchedulesController@index')->name('admin.schedule.index');
            Route::get('{id}/schedule/create','SchedulesController@create')->name('admin.schedule.create');
            Route::post('{id}/schedule/create','SchedulesController@store')->name('admin.schedule.store');
            Route::get('{id}/schedule/{s_id}/edit','SchedulesController@edit')->name('admin.schedule.edit');
            Route::post('{id}/schedule/{s_id}','SchedulesController@update')->name('admin.schedule.update');
            Route::get('{id}/schedule/{s_id}','SchedulesController@destroy')->name('admin.schedule.destroy');
            Route::get('{id}/schedule/{e_id}/show','SchedulesController@show')->name('admin.schedule.show');
        });
        Route::get('getDepartmentEmployee/','SchedulesController@getEmployees')->name('admin.schedule.getDepartmentEmployees');

        // attendance routes
        Route::group(['prefix'=>'admin'], function (){
            Route::get('{id}/attendance','AttendanceController@index')->name('admin.attendance.index');
            Route::post('attendance','AttendanceController@getAttendance')->name('admin.attendance.getAttendance');
            Route::get('{id}/timeSheet','AttendanceController@timeSheet')->name('admin.attendance.timeSheet');
            Route::post('timeSheet','AttendanceController@getTimeSheet')->name('admin.attendance.getTimeSheet');
            Route::get('{id}/deduction','AttendanceController@deduction')->name('admin.attendance.deduction');
            Route::post('deduction','AttendanceController@getDeduction')->name('admin.attendance.getDeduction');
            Route::get('deduction/save','AttendanceController@saveDeduction')->name('admin.attendance.saveDeduction');
        });

    });
});
