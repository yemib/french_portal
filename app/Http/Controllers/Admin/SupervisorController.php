<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = User::where("account_type", "supervisor")->get();
        $schools = Setting::orderBy("school_title", "asc")->get();

        return view("admin.supervisors.index", compact("supervisors", "schools"));
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
                "email" => "bail|required|email|unique:users",
                "gender" => "bail|required",
                "school" => "bail|required"
            ]);

            $user = new User();
            $password = strtolower($request->surname);
            $user->surname = $request->surname;
            $user->other_names = $request->other_names;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->password = bcrypt($password);
            $user->account_type = "supervisor";
            $user->school_id = $request->school;
            $user->save();

            return redirect()->back()->with("success", "Supervisor has been added successfully");

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
                "email" => "bail|required|email",
                "gender" => "bail|required",
                "school" => "bail|required"
            ]);

            if($user = User::find($id))
            {
                if(($request->email != $user->email) && (User::where("email", $request->email)->count() > 0))
                {
                    return redirect()->back()->with("danger", "The email has already been taken.");
                }

                $user->surname = $request->surname;
                $user->other_names = $request->other_names;
                $user->email = $request->email;
                $user->gender = $request->gender;
                $user->account_type = "supervisor";
                $user->school_id = $request->school;
                $user->save();

                return redirect()->back()->with("success", "Supervisor has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid supervisor");

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

            if($user = User::find($id))
            {
                $user->delete();

                return redirect()->back()->with("success", "Supervisor has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid supervisor");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
