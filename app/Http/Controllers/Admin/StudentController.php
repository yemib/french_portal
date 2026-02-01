<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Department;
use App\Http\Models\Program;
use App\Http\Models\Setting;
use App\Http\Models\Student;
use App\Imports\StudentsImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderby('id'  , 'desc' )->paginate(600);
        $departments = Department::all();
        $programs = Program::all();
        $schools = Setting::orderBy("school_title", "asc")->get();

        return view("admin.students.index", compact("students", "departments", "programs", "schools"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                "surname" => "bail|required|string",
                "other_names" => "bail|required|string",
                "gender" => "bail|required|string",
                "program" => "bail|required|integer",
                "department" => "bail|required|integer",
                "registration_number" => "bail|required|string|unique:students",
                "school" => "bail|required",
                "email" => "unique:users"
            ]);

            $user = new User();
            $password = strtolower($request->surname);
            $user->surname = $request->surname;
            $user->other_names = $request->other_names;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->password = bcrypt($password);
            $user->account_type = "student";
            $user->school_id = $request->school;
            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->program_id = $request->program;
            $student->department_id = $request->department;
            $student->registration_number = $request->registration_number;
            $student->current_session = $request->current_session;
            $student->save();

            return redirect()->back()->with("success", "Student has been added successfully");

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($student = Student::find($id))
        {
            return view("admin.students.show", compact("student"));
        }

        return redirect()->route("admin.student.index")->with("danger", "Invalid Student");
    }

    public function activate($id)
    {
        try {

            if($student = Student::find($id))
            {
                $student->active = true;
                $student->save();

                return redirect()->back()->with("success", "Student has been activated successfully");
            }

            return redirect()->back()->with("danger", "Invalid student");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function deactivate($id)
    {
        try {

            if($student = Student::find($id))
            {
                $student->active = false;
                $student->save();

                return redirect()->back()->with("success", "Student has been deactivated successfully");
            }

            return redirect()->back()->with("danger", "Invalid student");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                "surname" => "bail|required|string",
                "other_names" => "bail|required|string",
                "gender" => "bail|required|string",
                "program" => "bail|required|integer",
                "department" => "bail|required|integer",
                "registration_number" => "bail|required|string",
                "current_session" => "bail|required",
                "school" => "bail|required"
            ]);

            if($student = Student::find($id))
            {
                if(($request->registration_number != $student->registration_number) && (Student::where("registration_number", $request->registration_number)->count() > 0))
                {
                    return redirect()->back()->with("danger", "The registration number has already been taken.");
                }

                $user = $student->user;
                $user->surname = $request->surname;
                $user->other_names = $request->other_names;
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->account_type = "student";
                $user->school_id = $request->school;
                $user->save();

                //$student->user_id = $user->id;
                $student->program_id = $request->program;
                $student->department_id = $request->department;
                $student->registration_number = $request->registration_number;
                $student->current_session = $request->current_session;
                $student->save();

                return redirect()->back()->with("success", "Student has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid student");

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $this->validate($request, [
                "password" => "bail|required|string|confirmed",
                "student_id" => "bail|required|integer"
            ]);

            if($student = Student::find($request->student_id))
            {
                $user = $student->user;
                $user->password = bcrypt($request->password);
                $user->save();

                return redirect()->back()->with("success", "Student password has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid student");

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if($student = Student::find($id))
            {
                $student->delete();
                $student->user->delete();

                return redirect()->back()->with("success", "Student has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid student");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
