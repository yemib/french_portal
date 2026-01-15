<?php

namespace App\Http\Controllers;

use App\Http\Models\Course;
use App\Http\Models\Student;
use App\Imports\CourseResultImport;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("index");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view("web.index");
        return redirect()->route("dashboard");
    }

    public function dashboard()
    {
        $user = auth()->user();
        $account_types = ["student", "lecturer", "senior_lecturer", "super_admin", "supervisor", "bursar"];

        switch ($user->account_type) {
            case "super_admin":
                return redirect()->route("admin.dashboard");
                break;
            case "supervisor":
                return redirect()->route("supervisor.dashboard");
                break;
            case "bursar":
                return redirect()->route("bursar.payments");
                break;
            case "senior_lecturer":
                return redirect()->route("lecturer.dashboard");
                break;
            case "lecturer":
                return redirect()->route("lecturer.dashboard");
                break;
            default: //case "student":
                return redirect()->route("student.dashboard");
                break;
        }
    }

    public function course($id)
    {
        try {
            $user = auth()->user();
            // Allow only lecturers, Admin and supervisors to view this page
            if (!in_array($user->account_type, ['super_admin', 'lecturer', 'senior_lecturer', 'supervisor'])) {
                return redirect()->back()->with("danger", "You are not permitted to view the page you requested");
            }

            if ($course = Course::find($id)) {
                return view("courses.show", compact("course"));
            }

            return redirect()->back()->with("danger", "Invalid course");
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function studentSheet($id, $format)
    {
        try {
            $user = auth()->user();
            // Allow only lecturers, Admin and supervisors to view this page
            if (!in_array($user->account_type, ['super_admin', 'lecturer', 'senior_lecturer', 'supervisor'])) {
                return redirect()->back()->with("danger", "You are not permitted to view the page you requested");
            }

            if ($course = Course::find($id)) {

                return $course->downloadStudentSheet($format);
            }

            return redirect()->back()->with("danger", "Invalid course");
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function downloadAllStudentsSheet($format)
    {
        try {
            $user = auth()->user();
            // Allow only lecturers, Admin and supervisors to view this page
            if (!in_array($user->account_type, ['super_admin', 'lecturer', 'senior_lecturer', 'supervisor'])) {
                return redirect()->back()->with("danger", "You are not permitted to view the page you requested");
            }

            return Student::downloadStudentSheet($format);
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function uploadStudent(Request $request)
    {
        try {
            $user = auth()->user();
            // Allow only lecturers, Admin and supervisors to view this page
            if (!in_array($user->account_type, ['super_admin'])) {
                return redirect()->back()->with("danger", "You are not permitted to view the page you requested");
            }

            $this->validate($request, [
                "program" => "bail|required|integer",
                "department" => "bail|required|integer",
                "current_session" => "bail|required",
                "bulk_students" => "bail|required",
                "school" => "bail|required"
            ]);

            Excel::import(new StudentsImport([
                "school" => $request->school,
                "program" => $request->program,
                "department" => $request->department,
                "current_session" => $request->current_session,
            ]), request()->file('bulk_students'));

            return redirect()->back()->with("success", "Students have been imported successfully");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", "There was an error with your uploaded file, please try again"/*$exception->getMessage()*/);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */







    public function uploadResults(Request $request)
    {
        try {

            $this->validate($request, [

                "from_date" =>  "bail|required",

                "to_date" => "bail|required",

                "program" => "bail|required",

                "school" => "bail|required",

                "session" => "bail|required",

                "result_sheet" => "bail|required"



            ]);

            //the result is uploaded here 



            Excel::import(new CourseResultImport([

                "program" => $request->program,
                "school" => $request->school,
                "session" => $request->session,
                "from_date" => $request->from_date,
                "to_date" => $request->to_date,
                "session" => $request->session

            ]), request()->file('result_sheet'));




            $all = array(
                'from_date' => $request->from_date,
                'program_id' => $request->program,
                'school_id' => $request->school,
                'session' => $request->session,
                'success' => "Student results have been imported successfully"
            );




            return   view('admin.departments.results')->with($all);






            // return redirect()->back()->with("danger", "Invalid Course");

        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", "There was an error with your uploaded file, please try again" . $exception->getMessage());
        }
    }




    public function uploadResultsbefore(Request $request)
    {
        try {
            if ($course = Course::find($request->course_id)) {
                if (!$course->can_upload_result) {
                    return redirect()->back()->with("danger", "You are not permitted to view the page you requested");
                }

                $this->validate($request, [
                    "course_id" => "bail|required|integer",
                    "student_sheet" => "bail|required",
                ]);

                //the result is uploaded here 


                Excel::import(new CourseResultImport([
                    "course_id" => $request->course_id
                ]), request()->file('student_sheet'));




                return redirect()->back()->with("success", "Student results have been imported successfully");
            }

            return redirect()->back()->with("danger", "Invalid Course");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", "There was an error with your uploaded file, please try again"/*.$exception->getMessage()*/);
        }
    }







    public function manageSettings(Request $request)
    {
        try {

            if ($request->isMethod("POST")) {
                $this->validate($request, [
                    "surname" => "bail|required|string",
                    "other_names" => "bail|required|string"
                ]);

                auth()->user()->surname = $request->surname;
                auth()->user()->other_names = $request->other_names;
                auth()->user()->save();

                return redirect()->back()->with("success", "Profile saved successfully");
            }

            return view("manage_settings");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {

            if ($request->isMethod("POST")) {
                $this->validate($request, [
                    "password" => "bail|required|string|confirmed"
                ]);

                auth()->user()->password = bcrypt($request->password);
                auth()->user()->save();

                return redirect()->back()->with("success", "Password changed successfully");
            }

            return view("manage_settings");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function changeAvatar(Request $request)
    {
        try {
            $user = auth()->user();

            $avatar = $request->file("avatar");

            $avatar_name = time() . "." . $avatar->getClientOriginalExtension();

            //Storage::put("public/images/avatar/".$user->id."/".$avatar_name, file_get_contents($avatar));


            // $passport_name = time().".".$passport->getClientOriginalExtension();
            //Storage::put("public/images/passport/".$passport_name, file_get_contents($passport));
            $passport->move(public_path("images/avatar/" . $user->id . "/"), $avatar_name);


            $user->avatar = $avatar_name;
            $user->save();

            return redirect()->back()->with("success", "Avatar has been saved successfully");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", "There was an error with your uploaded file, please try again"/*.$exception->getMessage()*/);
        }
    }
}
