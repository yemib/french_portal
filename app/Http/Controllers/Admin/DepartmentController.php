<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Department;
use App\Http\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Student;
use App\Models\ResultRemark;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $programs = Program::all();

        return view("admin.departments.index", compact("departments", "programs"));
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
                "program" => "bail|required",
                "title" => "bail|required|string"
            ]);

            $department = new Department();
            $department->program_id = $request->program;
            $department->title = $request->title;
            $department->save();

            return redirect()->back()->with("success", "Department has been added successfully");

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
    public function results( Request $request)
    {
       
$all = array('program_id' => $request->program   , 'school_id'=>$request->school ,  'from_date'=>$request->from_date  , 'session'=>$request->session );
		
		
     return view('admin.departments.results')->with($all);
  

        //abort(404, "Department not found");
    }

	
	
	
    public function resultRemark(Request $request, $student_id)
    {
        if($student = Student::find($student_id))
        {
            if(!$result_remark = $student->result_remark)
            {
                $result_remark = new ResultRemark();
                $result_remark->student_id = $student->id;
            }

            $result_remark->content = $request->remark;
            $result_remark->save();

            return back()->with('success', 'Remark added successfully');
        }

        abort(404, "Student not found");
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
                "program" => "bail|required",
                "title" => "bail|required|string"
            ]);

            if($department = Department::find($id))
            {
                $department->program_id = $request->program;
                $department->title = $request->title;
                $department->save();

                return redirect()->back()->with("success", "Department has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid department");

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

            if($department = Department::find($id))
            {
                $department->delete();

                return redirect()->back()->with("success", "Department has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid department");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
