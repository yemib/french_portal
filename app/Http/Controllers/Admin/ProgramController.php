<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Program;
use App\Http\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();

        return view("admin.programs.index", compact("programs"));
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
                "title" => "bail|required|string"
            ]);

            $program = new Program();
            $program->title = $request->title;
            $program->duration = ($request->duration) ? $request->duration : Setting::first()->default_program_duration;
            $program->tuition = $request->tuition;
            $program->save();

            return redirect()->back()->with("success", "Program has been added successfully");

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
                "title" => "bail|required|string"
            ]);

            if($program = Program::find($id))
            {
                $program->title = $request->title;
                $program->duration = ($request->duration) ? $request->duration : Setting::first()->default_program_duration;
                $program->tuition = $request->tuition;
                $program->save();

                return redirect()->back()->with("success", "Program has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid program");

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

            if($program = Program::find($id))
            {
                $program->delete();

                return redirect()->back()->with("success", "Program has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid program");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
