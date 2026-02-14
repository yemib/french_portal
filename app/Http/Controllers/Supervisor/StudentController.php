<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Models\Department;
use App\Http\Models\Program;
use App\Http\Models\Student;
use App\Imports\StudentsImport;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\result;
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
        $user = auth()->user();

        $students = Student::whereHas("user", function($query) use ($user)
        {
            $query->where("school_id", $user->school_id);
        })->get();
		
		
        $departments = Department::all();
        $programs = Program::all();

        return view("supervisor.students.index", compact("students", "departments", "programs"));
		
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
            //send the result  
            $results =result::where([['matric' ,  $student->registration_number] ,  ['publish' , 1]])->orderby('id' ,  'desc')->get();
            return view("supervisor.students.show", compact("student"   ,  "results"));
        }

        return redirect()->route("supervisor.student.index")->with("danger", "Invalid Student");
    }
}
