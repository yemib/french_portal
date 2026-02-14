<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;





use App\Http\Models\ApplicationForm;
use App\Http\Models\Program;
use App\Http\Models\Student;
use App\User;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;
use App\Http\Models\Setting;
use App\Http\Controllers\Student\StudentController;
use App\Http\Models\RemitaPayment;
use App\Http\Models\registration_payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;



// routes/web.php




Route::get("dashboard", [
    "as" => "admin.dashboard",
    "uses" => "AdminController@dashboard"
]);


//Route::resource('form-fields', "FormFieldController");

Route::get('/form-fields', "FormFieldController@index");
Route::post('/form-fields', "FormFieldController@store");
Route::put('/form-fields/{formField}', "FormFieldController@update");
Route::delete('/form-fields/{formField}', "FormFieldController@destroy");

/* Route::post('/field-groups', "FieldGroupController@store");
Route::delete('/field-groups/{fieldGroup}', "FieldGroupController@destroy");
 */

Route::post('/field-groups', "FieldGroupController@store");
Route::put('/field-groups/{fieldGroup}', "FieldGroupController@update");
Route::delete('/field-groups/{fieldGroup}', "FieldGroupController@destroy");
Route::post('/field-groups/reorder', "FieldGroupController@reorder");
Route::post('/form-fields/reorder', "FieldGroupController@reorder");




//registration fee 


Route::put("registration_fee", [
    "as" => "admin.settings.registration",
    "uses" => "AdminController@registration_fee"
]);




Route::put("settings/update", [
    "as" => "admin.settings.update",
    "uses" => "AdminController@updateSettings"
]);





Route::resource("applications", "ApplicationController")->names([
    "index" => "admin.applications.index",
    "show" => "admin.applications.show",
    "update" => "admin.applications.update",
    "destroy" => "admin.applications.destroy",
]);

Route::get("applications/{id}/approve", "ApplicationController@approve")->name("admin.applications.approve");

Route::resource("department", "DepartmentController")->names([
    "index" => "admin.department.index",
    "store" => "admin.department.store",
    "update" => "admin.department.update",
    "destroy" => "admin.department.destroy",
]);

Route::resource("hostel", "HostelController")->names([
    "index" => "admin.hostel.index",
    "store" => "admin.hostel.store",
    "update" => "admin.hostel.update",
    "destroy" => "admin.hostel.destroy",
]);

Route::resource("course", "CourseController")->names([
    "index" => "admin.course.index",
    "show" => "admin.course.show",
    "store" => "admin.course.store",
    "update" => "admin.course.update",
    "destroy" => "admin.course.destroy",
]);

Route::resource("school", "SchoolController")->names([
    "index" => "admin.school.index",
    "store" => "admin.school.store",
    "update" => "admin.school.update",
    "destroy" => "admin.school.destroy",
]);

Route::resource("program", "ProgramController")->names([
    "index" => "admin.program.index",
    "store" => "admin.program.store",
    "update" => "admin.program.update",
    "destroy" => "admin.program.destroy",
]);

Route::resource("lecturer", "LecturerController")->names([

    "index" => "admin.lecturer.index",
    "store" => "admin.lecturer.store",
    "update" => "admin.lecturer.update",
    "destroy" => "admin.lecturer.destroy",
]);

Route::get("lecturer/change-status/{id}/{status}", [
    "as" => "admin.lecturer.change-status",
    "uses" => "LecturerController@changeStatus"
]);

Route::put("student/update-password", "StudentController@updatePassword")->name("admin.student.update-password");


Route::get('deactivated_students'  ,"StudentController@deactivated_students"  )->name('admin.deactivated.students');
Route::get('students_card_requests'  ,"StudentController@cardrequests"  )->name('admin.student.card.requests');



Route::resource("student", "StudentController")->names([
    "index" => "admin.student.index",
    "show" => "admin.student.show",
    "store" => "admin.student.store",
    "update" => "admin.student.update",
    "destroy" => "admin.student.destroy",
]);


Route::get("{id}/activate", [
    "as" => "admin.student.activate",
    "uses" => "StudentController@activate"
]);




Route::get("{id}/approve", [
    "as" => "admin.student.approve",
    "uses" => "StudentController@approve"
]);


Route::get("{id}/deny", [
    "as" => "admin.student.deny",
    "uses" => "StudentController@deny"
]);



Route::get("{id}/deactivate", [
    "as" => "admin.student.deactivate",
    "uses" => "StudentController@deactivate"
]);

//approve card request  
Route::get("{id}/approve_card_request", [
    "as" => "admin.student.approve_card_request",
    "uses" => "StudentController@approvecard"
]);

//deny card request

Route::get("{id}/deny_card_request", [
    "as" => "admin.student.deny_card_request",
    "uses" => "StudentController@denycard"
]);


Route::resource("session", "SessionController")->names([
    "index" => "admin.session.index",
    "store" => "admin.session.store",
    "update" => "admin.session.update",
    "destroy" => "admin.session.destroy",
]);

Route::resource("supervisor", "SupervisorController")->names([
    "index" => "admin.supervisor.index",
    "store" => "admin.supervisor.store",
    "update" => "admin.supervisor.update",
    "destroy" => "admin.supervisor.destroy",
]);

Route::resource("bursar", "BursarController")->names([
    "index" => "admin.bursar.index",
    "store" => "admin.bursar.store",
    "update" => "admin.bursar.update",
    "destroy" => "admin.bursar.destroy",
]);

Route::resource("voucher", "VoucherController")->names([
    "index" => "admin.voucher.index",
    "store" => "admin.voucher.store",
    "update" => "admin.voucher.update",
    "destroy" => "admin.voucher.destroy",
]);

Route::get("vouchers/download", [
    "as" => "admin.vouchers.download",
    "uses" => "VoucherController@downloadVouchers"
]);

Route::get("vouchers/download-generated-voucher/{id}", [
    "as" => "admin.vouchers.download-generated-voucher",
    "uses" => "VoucherController@downloadGeneratedVoucher"
]);

Route::resource("payment", "PaymentController")->names([
    "index" => "admin.payment.index",
    "destroy" => "admin.payment.destroy",
]);



Route::get("payment/{id}/verify", [
    "as" => "admin.payment.verify",
    "uses" => "PaymentController@verify"
]);



Route::get("/register_straight", [
    "as" => "admin.payment.register",
    function (Request $request) {
        $request->session()->put('confirm_payment', 3322920);


        $programs = Program::get();
        $schools = Setting::orderBy("school_title", "asc")->get();


        return view('auth.register', compact('programs', "schools"));
    }
]);











Route::post('results/{department_id}', [
    'as' => 'admin.results',
    'uses' => 'DepartmentController@results'
]);

Route::post('result-remark/{student_id}', [
    'as' => 'admin.result-remark',
    'uses' => 'DepartmentController@resultRemark'
]);
