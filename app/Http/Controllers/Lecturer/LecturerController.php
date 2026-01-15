<?php

namespace App\Http\Controllers\Lecturer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LecturerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return view("lecturer.dashboard", compact("user"));
    }
	
	
	 
	
	 public function results( Request $request)
    {
       
$all = array('program_id' => $request->program   , 'school_id'=>$request->school ,  'from_date'=>$request->from_date  , 'session'=>$request->session );
		
		
     return view('admin.departments.results')->with($all);
  

        //abort(404, "Department not found");
    }

	

	
}
