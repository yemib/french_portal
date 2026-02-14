<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Hostel;
use App\Http\Models\Lecturer;
use App\Http\Models\Session;
use App\Http\Models\Setting;
use App\Http\Models\Student;
use App\Http\Models\registration_fee;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function dashboard()
    {
        $students = Student::where('active' ,  1)->get();
        $lecturers = User::where('account_type'  ,  'lecturer')->orwhere( 'account_type'  ,  'senior_lecturer' )->get();
        $supervisor  = User::where('account_type'  ,  'supervisor')->get();
        $bursar  = User::where('account_type'  ,  'bursar')->get();

        $hostels = Hostel::get();
        $settings = Setting::first();
        $sessions = Session::get();

        $hostel_capacity = 0;
        foreach ($hostels as $hostel)
        {
            $hostel_capacity += $hostel->rooms * $hostel->room_capacity;
        }

        $users = User::orderByRaw("FIELD(account_type, 'super_admin', 'supervisor', 'bursar' ,'senior_lecturer', 'lecturer', 'student') ASC")->get();

        return view("admin.dashboard", compact("students", "lecturers",  'supervisor', 'bursar', "hostels", "settings", "users", "sessions", "hostel_capacity"));
    }

    public function updateSettings(Request $request)
    {
        try {
            if($request->isMethod("PUT"))
            {
                $this->validate($request, [
                    "program_duration" => "bail|required|integer"
                ]);

                $settings = Setting::first();
                $settings->default_program_duration = $request->program_duration;
                $settings->save();

                return redirect()->back()->with("success", "Settings saved successfully");
            }

            return redirect()->back()->with("danger", "Invalid action");
        } catch (ValidationException $exception)
        {
            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception)
        {
            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
	
	 public function registration_fee(Request $request)
    {
        try {
            if($request->isMethod("PUT"))
            {
                $this->validate($request, [
                    "fee" => "bail|required|integer"
                ]);

                $settings = registration_fee::first();
                $settings->fee = $request->fee;
                $settings->save();

                return redirect()->back()->with("success", "Settings saved successfully");
            }

            return redirect()->back()->with("danger", "Invalid action");
        } catch (ValidationException $exception)
        {
            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception)
        {
            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
	
	
	
}
