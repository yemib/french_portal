<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = Setting::orderBy("school_title", "asc")->get();

        return view("admin.schools.index", compact("schools"));
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
                "school_name" => "bail|required|string"
            ]);

            $setting = new Setting();
            $setting->school_title = $request->school_name;
            $setting->default_program_duration = 2;
            $setting->save();

            return redirect()->back()->with("success", "School has been added successfully");

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
                "school_name" => "bail|required|string"
            ]);

            if($school = Setting::find($id))
            {
                $school->school_title = $request->school_name;
                $school->default_program_duration = 2;
                $school->save();

                return redirect()->back()->with("success", "School has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid School");

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

            if($school = Setting::find($id))
            {
                $school->delete();

                return redirect()->back()->with("success", "School has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid School");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
