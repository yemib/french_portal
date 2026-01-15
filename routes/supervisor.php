<?php
/**
 * Created by PhpStorm.
 * User: dev_babs
 * Date: 10/11/2018
 * Time: 5:57 PM
 */

use Illuminate\Support\Facades\Route;

Route::get("dashboard", [
    "as" => "supervisor.dashboard",
    "uses" => "SupervisorController@dashboard"
]);

Route::resource("student", "StudentController")->names([
    "index" => "supervisor.student.index",
    "show" => "supervisor.student.show"
]);

Route::post('results/{department_id}', [
    'as' => 'supervisor.results',
    'uses' => 'SupervisorController@results'
]);



