<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Hostel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostels = Hostel::all();

        return view("admin.hostels.index", compact("hostels"));
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
                "rooms" => "bail|required",
                "room_capacity" => "bail|required"
            ]);

            $hostel = new Hostel();
            $hostel->title = $request->title;
            $hostel->rooms = $request->rooms;
            $hostel->room_capacity = $request->room_capacity;
            $hostel->save();

            return redirect()->back()->with("success", "Hostel has been added successfully");

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
                "title" => "bail|required|string",
                /*"rooms" => "bail|required",
                "room_capacity" => "bail|required"*/
            ]);

            if($hostel = Hostel::find($id))
            {
                $hostel->title = $request->title;
                //$hostel->rooms = $request->rooms;
                //$hostel->room_capacity = $request->room_capacity;
                $hostel->save();

                return redirect()->back()->with("success", "Hostel has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid hostel");

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

            if($hostel = Hostel::find($id))
            {
                $hostel->delete();

                return redirect()->back()->with("success", "Hostel has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid hostel");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
