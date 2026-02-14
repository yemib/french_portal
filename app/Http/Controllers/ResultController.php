<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\result;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{

    //block accrss to it using constructor 

    public function  __construct()
    {




        $this->middleware('resultUploaders');
    }

    public function index()
    {

        //check the  suser   
        $user  = auth()->user();

     
        if ($user->account_type ==  'lecturer'   ||   $user->account_type  ==  "senior_lecturer") {

            $results = result::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        } else {
            $results = result::orderBy('id', 'desc')->get();
        }




        return view('results.index', compact('results'));
    }

    public function  upload()
    {

        return  view('result_upload.result_upload');
    }


    public function update(Request $request)
    {

        $result = result::find($request->id);
        $result->update($request->except('_token', 'id'));

        return response()->json(['status' => true]);
    }

    public function updateCourses(Request $request)
    {
        $result = result::findOrFail($request->id);
        $result->course = $request->course; // JSON column
        $result->save();

        return response()->json(['success' => true]);
    }



    public function deletefunction(Request $request)
    {
        result::findOrFail($request->id)->delete();
        return response()->json(['success' => true]);
    }


    public function togglePublish(Request $request)
    {
        $result = result::findOrFail($request->id);
        $result->publish = !$result->publish;
        $result->save();

        return response()->json(['publish' => $result->publish]);
    }
}
