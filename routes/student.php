<?php
/**
 * Created by PhpStorm.
 * User: dev_babs
 * Date: 04/11/2018
 * Time: 3:03 PM
 */

use Illuminate\Support\Facades\Route;

Route::get("dashboard", [
    "as" => "student.dashboard",
    "uses" => "StudentController@dashboard"
]);

Route::get("session/{count}", [
    "as" => "student.session",
    "uses" => "StudentController@session"
]);

Route::get("download-hostel-allocation-form", [
    "as" => "student.download-hostel-allocation-form",
    "uses" => "StudentController@downloadHostelAllocationForm"
]);

Route::get('results'   ,  "StudentController@result" )->name('student.results.dashboard');
Route::get('card-request'   ,  "StudentController@cardrequest" )->name('student.card.request');