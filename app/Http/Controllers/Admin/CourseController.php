<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Course;
use App\Http\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $departments = Department::all();

        return view("admin.courses.index", compact("courses", "departments"));
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
                "title" => "bail|required|string",
                "code" => "bail|required|string",
                "department" => "bail|required|integer",
                "level" => "bail|required|integer"
            ]);

            $course = new Course();
            $course->department_id = $request->department;
            $course->title = $request->title;
            $course->code = $request->code;
            $course->level = $request->level;
            $course->save();

            return redirect()->back()->with("success", "Course has been added successfully");

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
                "title" => "bail|required|string",
                "department" => "bail|required|integer",
                "level" => "bail|required|integer"
            ]);

            if($course = Course::find($id))
            {
                $course->department_id = $request->department;
                $course->title = $request->title;
                $course->code = $request->code;
                $course->level = $request->level;

                $course->save();

                return redirect()->back()->with("success", "Course has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid course");

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

            if($course = Course::find($id))
            {
                $course->delete();

                return redirect()->back()->with("success", "Course has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid course");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
