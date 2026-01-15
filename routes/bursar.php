<?php
/**
 * Created by PhpStorm.
 * User: dev_babs
 * Date: 10/11/2018
 * Time: 5:57 PM
 */

use Illuminate\Support\Facades\Route;

Route::get("dashboard", [
    "as" => "bursar.dashboard",
    "uses" => "BursarController@dashboard"
]);

Route::get("payment", [
    "as" => "bursar.payments",
    "uses" => "BursarController@payments"
]);

Route::get("payment/{id}/verify", [
    "as" => "bursar.payment.verify",
    "uses" => "BursarController@verifyPayment"
]);

Route::delete("payment/{id}/destroy", [
    "as" => "bursar.payment.destroy",
    "uses" => "BursarController@removePayment"
]);

Route::resource("student", "StudentController")->names([
    "index" => "bursar.student.index",
    "show" => "bursar.student.show"
]);
