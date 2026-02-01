<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\result;
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{

    //block accrss to it using constructor 

    public function index()
    {

        $results = result::orderBy('id'  , 'desc')->get();
        return view('results.index', compact('results'));
       
    }


    public function update(Request $request)
    {
        
        $result = result::find($request->id);
        $result->update($request->except('_token', 'id'));

        return response()->json(['status' => true]);
    }


    public function deletefunction(Request $request)
    {
        result::findOrFail($request->id)->delete();
        return response()->json(['success' => true]);
    }
}
