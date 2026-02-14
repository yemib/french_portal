<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Department;
use App\Http\Models\Lecturer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::all();
        $departments = Department::all();

        return view("admin.lecturers.index", compact("lecturers", "departments"));
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

              /*   "staff_id" => "bail|required|string|unique:lecturers", */
                "email" => "unique:users"
            ]);

            $user = new User();
            $password = strtolower($request->surname);
            $user->surname = $request->surname;
            $user->other_names = $request->other_names;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->password = bcrypt($password);
            $user->account_type = "senior_lecturer";
            $user->save();

            $lecturer = new Lecturer();
            $lecturer->user_id = $user->id;
            $lecturer->department_id = 1;
            $lecturer->staff_id =   " ";  /* $request->staff_id; */
            $lecturer->save();

            return redirect()->back()->with("success", "Lecturer has been added successfully");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

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
        //
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
                "department" => "bail|required|integer",
                "staff_id" => "bail|required|string"
            ]);

            if ($lecturer = Lecturer::find($id)) {
                if (($request->staff_id != $lecturer->staff_id) && (Lecturer::where("staff_id", $request->staff_id)->count() > 0)) {
                    return redirect()->back()->with("danger", "The staff id has already been taken.");
                }

                $user = $lecturer->user;
                $user->surname = $request->surname;
                $user->other_names = $request->other_names;
                $user->email = $request->email;
                $user->account_type = "lecturer";
                $user->save();

                $lecturer->department_id = $request->department;
                $lecturer->staff_id = $request->staff_id;
                $lecturer->save();

                return redirect()->back()->with("success", "Lecturer has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid lecturer");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  String  $status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id, $status)
    {
        try {
            if ($lecturer = Lecturer::find($id)) {
                $user = $lecturer->user;
                switch ($status) {
                    case "senior":
                        $user->account_type = "senior_lecturer";
                        break;
                    default:
                        $user->account_type = "lecturer";
                        break;
                }
                $user->save();

                return redirect()->back()->with("success", "Lecturer has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid lecturer");
        } catch (ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {

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

            if ($lecturer = Lecturer::find($id)) {
                $lecturer->delete();
                $lecturer->user->delete();

                return redirect()->back()->with("success", "Lecturer has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid lecturer");
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
