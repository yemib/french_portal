<?php
/**
 * Created by PhpStorm.
 * User: dev_babs
 * Date: 08/11/2018
 * Time: 2:25 AM
 */

use Illuminate\Support\Facades\Route;

Route::get("dashboard", [
    "as" => "lecturer.dashboard",
    "uses" => "LecturerController@dashboard"
]);



Route::post('results/{department_id}', [
    'as' => 'lecturer.results',
    'uses' => 'LecturerController@results'
]);



Route::resource("student", "StudentController")->names([
    "index" => "lecturer.student.index",
    "show" => "lecturer.student.show",
    "store" => "lecturer.student.store",
    "update" => "lecturer.student.update",
    "destroy" => "lecturer.student.destroy",
]);


