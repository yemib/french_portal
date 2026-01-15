<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Department;

class SupervisorController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        return view("supervisor.dashboard", compact("user"));
    }

	

	
	 public function results( Request $request)
    {
       
		 $user = auth()->user();
		
		
		
		
$all = array('program_id' => $request->program   , 'school_id'=>$user->school_id ,  'from_date'=>$request->from_date  , 'session'=>$request->session );
		
		
     return view('admin.departments.results')->with($all);
  

        //abort(404, "Department not found");
    }

	
	
	
	
	
}
