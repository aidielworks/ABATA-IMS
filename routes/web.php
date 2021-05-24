<?php

use App\Http\Controllers\TopicController;
use App\Receipt;
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

//employees (references)


//Landing Page
Route::get('/', 'AuthController@index')->middleware('isLogin');

//Logout session
Route::get('/auth/destroy', 'AuthController@destroy');
Route::post('/auth', 'AuthController@store');

Route::get('/test', 'PagesController@test');


Route::middleware('isNotLogin')->group(function () {

    //-----------------------------ADMIN / EMPLOYEE USE------------------------------------
    Route::middleware('isEmployee')->group(function () {

        //-----------------------------ADMIN USE ONLY------------------------------------
        Route::middleware('isAdmin')->group(function () {
            //ASSIGN AND WITHOLD ADMIN ACCESS FOR EMPLOYEE
            Route::get('/admin/accessTimestamp', 'AdminController@accessTimestamp');
            Route::get('/admin/assignAccess', 'AdminController@assignAccess');
            Route::patch('/assign/{employee}', 'AdminController@assign');
            Route::patch('/withhold/{employee}', 'AdminController@withhold');

            //JOBTYPE
            Route::get('/admin/job_types', 'AdminController@job_types');
            Route::get('/admin/job_types/create', 'AdminController@create_job_types');
            Route::post('/admin/job_types', 'AdminController@store_job_types');
            Route::get('/admin/job_types/{job}/edit', 'AdminController@edit_job_types');
            Route::patch('/admin/job_types/{job}', 'AdminController@update_job_types');
            Route::delete('/admin/job_types/{job}', 'AdminController@destroy_job_types');

            //DELETE AND RESTORE USER(EMLPOLYEE< TEAHCER< STUDENT)
            Route::get('/admin/archive_user', 'AdminController@archiveUser');
            Route::get('/admin/restore_user/{type}/{id}', 'AdminController@restoreUser');

            //STUDENT RECEIPT
            Route::get('/admin/receipt/create', 'ReceiptController@create');
            Route::get('/admin/receipt', 'ReceiptController@index');
            Route::get('/admin/receipt/{receipt}', 'ReceiptController@show');
            Route::post('/admin/receipt', 'ReceiptController@store');
            Route::delete('/admin/receipt/{receipt}', 'ReceiptController@destroy');
            Route::get('/admin/receipt/{receipt}/edit', 'ReceiptController@edit');
            Route::patch('/admin/receipt/{receipt}', 'ReceiptController@update');

            //EMPLOYEE PAYROLL
            Route::get('/admin/payroll', 'PayrollController@index');
            Route::get('/admin/payroll/create', 'PayrollController@create');
            Route::get('/admin/payroll/{payroll}', 'PayrollController@show');
            Route::post('/admin/payroll', 'PayrollController@store');
            Route::delete('/admin/payroll/{payroll}', 'PayrollController@destroy');
            Route::get('/admin/payroll/{payroll}/edit', 'PayrollController@edit');
            Route::patch('/admin/payroll/{payroll}', 'PayrollController@update');
            Route::get('/admin/payroll/employee/{employee}', 'PayrollController@emp_payroll_setting');
            Route::get('/admin/payroll/{payroll}/{employee}', 'PayrollController@show');

            //MANAGE EMPLOYEE
            Route::get('/employee/create', 'ManageEmployeeController@create');
            Route::get('/employee', 'ManageEmployeeController@index');
            Route::get('/employee/{employee}', 'ManageEmployeeController@show');
            Route::post('/employee', 'ManageEmployeeController@store');
            Route::delete('/employee/{employee}', 'ManageEmployeeController@destroy');
            Route::get('/employee/{employee}/edit', 'ManageEmployeeController@edit');
            Route::patch('/employee/{employee}', 'ManageEmployeeController@update');

            //Teacher Payroll
            Route::get('/teacher/payroll/create', 'TeacherPayrollController@create');
            Route::get('/teacher/payroll', 'TeacherPayrollController@index');
            Route::get('/teacher/payroll/{payroll}', 'TeacherPayrollController@show');
            Route::post('/teacher/payroll', 'TeacherPayrollController@store');
            Route::delete('/teacher/payroll/{payroll}', 'TeacherPayrollController@destroy');
            Route::get('/teacher/payroll/{payroll}/edit', 'TeacherPayrollController@edit');
            Route::patch('/teacher/payroll/{payroll}', 'TeacherPayrollController@update');

            //Topic
            Route::get('/topic', 'TopicController@index');
            Route::get('/topic/create', 'TopicController@create');
            Route::get('/topic/{topic}', 'TopicController@show');
            Route::post('/topic', 'TopicController@store');
            Route::delete('/topic/{topic}', 'TopicController@destroy');
            Route::get('/topic/{topic}/edit', 'TopicController@edit');
            Route::patch('/topic/{topic}', 'TopicController@update');
        });
        //-----------------------------ADMIN USE ONLY------------------------------------


        Route::get('/student/create', 'ManageStudentsController@create');
        Route::get('/student', 'ManageStudentsController@index');
        Route::get('/student/{student}', 'ManageStudentsController@show');
        Route::post('/student', 'ManageStudentsController@store');
        Route::delete('/student/{student}', 'ManageStudentsController@destroy');
        Route::get('/student/{student}/edit', 'ManageStudentsController@edit');
        Route::patch('/student/{student}', 'ManageStudentsController@update');

        Route::get('/teacher/create', 'ManageTeachersController@create');
        Route::get('/teacher', 'ManageTeachersController@index');
        Route::get('/teacher/{teacher}', 'ManageTeachersController@show');
        Route::post('/teacher', 'ManageTeachersController@store');
        Route::delete('/teacher/{teacher}', 'ManageTeachersController@destroy');
        Route::get('/teacher/{teacher}/edit', 'ManageTeachersController@edit');
        Route::patch('/teacher/{teacher}', 'ManageTeachersController@update');


        Route::get('/home', 'PagesController@index'); // Main page display graph 
        Route::get('/profile', 'PagesController@profile'); //display profile page
        Route::get('/setting', 'PagesController@setting'); //update profile and password page
        Route::patch('/setting/{employee}', 'PagesController@updateProfile'); //update profile 
        Route::patch('/setting/password/{employee}', 'PagesController@updatePassword'); //update password
        Route::post('/setting/upload', 'PagesController@uploadImage'); //upload image
        Route::get('setting/removeImage/{employee}/{image}', 'PagesController@removeImage'); // remove profile picture

        Route::post('/findTeacher', 'ManageStudentsController@findTeacher'); //AJAX POST FOR FIND NEARBY TEACHERS (New Student)

        Route::get('/noti_pending', 'SpformController@notification'); //AJAX pending spform

        //SPFORM
        Route::get('/spform', 'SpformController@indexSpForm'); //Page display list of sp form
        Route::get('/spform/{spform}', 'SpformController@showSpForm'); //Page  display form selected to approved or declined
        Route::patch('/spform/{spform}', 'SpformController@updateSpForm'); //approved or declined SP Form

        //Receipt
        Route::post('/findAddress', 'ReceiptController@findAddress'); //AJAX POST FOR FIND address in creating receipt
    });


    //------------------------------------TEACHER USE------------------------------------
    Route::middleware('isTeacher')->group(function () {

        Route::get('/teachers/spform', 'SpformController@index');
        Route::get('/teachers/spform/create', 'SpformController@create');
        Route::get('/teachers/spform/{spform}', 'SpformController@show');
        Route::post('/teachers/spform', 'SpformController@store');
        Route::delete('/teachers/spform/{spform}', 'SpformController@destroy');
        Route::get('/teachers/spform/{spform}/edit', 'SpformController@edit');
        Route::patch('/teachers/spform/{spform}', 'SpformController@update');


        Route::get('/teachers/payroll-history', 'TeachersController@payrollHistoryIndex');
        Route::get('/teachers/payroll-history/{id}', 'TeachersController@payrollHistoryShow');

        Route::get('/teachers/profile', 'TeachersController@showProfile');
        Route::get('/teachers/profile/edit', 'TeachersController@editProfile');
        Route::get('/teachers/setting', 'TeachersController@setting'); //show setting
        Route::patch('/teachers/setting/{teacher}', 'TeachersController@updatePassword'); //update password

        Route::post('/teachers/setting/upload', 'TeachersController@uploadImage'); //upload image
        Route::get('/teachers/setting/removeImage/{teacher}/{image}', 'TeachersController@removeImage'); // remove profile picture

        Route::post('/noti_decline', 'TeachersController@notification'); //AJAX decline spform

        Route::get('/teachers', 'TeachersController@index');
        Route::patch('/teachers/{teachers}', 'TeachersController@update');
    });


    //------------------------------------STUDENT USE------------------------------------
    Route::middleware('isStudent')->group(function () {

        Route::get('/students/books', 'StudentsController@books'); // view Books
        Route::get('/students/spforms', 'StudentsController@spformIndex'); //index SP Form
        Route::get('/students/spforms/{spform}', 'StudentsController@spfShow'); //show SP Form
        Route::get('/students/receipt/{receipt}', 'StudentsController@receipt'); //show receipt
        Route::get('/students/setting', 'StudentsController@setting'); //show setting
        Route::patch('/students/setting/{student}', 'StudentsController@updatePassword'); //update password
        Route::get('/students/receipt', 'StudentsController@receiptIndex'); // view Receipt

        Route::post('/students/setting/upload', 'StudentsController@uploadImage'); //upload image
        Route::get('/students/setting/removeImage/{teacher}/{image}', 'StudentsController@removeImage'); // remove profile picture

        Route::get('/students', 'StudentsController@index');
        Route::patch('/students/{students}', 'StudentsController@update');
    });
});

Route::get('/teacher/payroll/{id}/download', 'TeacherPayrollController@teacherPayroll');
Route::get('/printReceipt/{receipt}', 'ReceiptController@printReceipt'); // display to print Receipt
Route::get('/payroll/{payroll}/{employee}/{type}', 'PagesController@user_payroll'); //view print or download own payroll