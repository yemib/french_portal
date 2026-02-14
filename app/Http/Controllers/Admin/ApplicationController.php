<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\ApplicationForm;
use App\Http\Models\Student;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Models\Setting;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//this shows all the applicant here 
		
        $pending_applications = ApplicationForm::orderby('id' , 'desc')->paginate(200);

        return view("admin.applications.index", compact("pending_applications"));
		
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

            ]);

            return redirect()->back()->with("success", "Application form has been added successfully");

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
        try {

            if($application_form = ApplicationForm::find($id))
            {
                $application_form->institution = (!is_null($application_form->any_post_secondary_qualification_institution)) ? Setting::find($application_form->any_post_secondary_qualification_institution)->school_title : "None";
                return view("admin.applications.show", compact("application_form"));
            }

            return redirect()->route("admin.applications.index")->with("danger", "Invalid application form");

        } catch(\Exception $exception) {

            return redirect()->route("admin.applications.index")->with("danger", $exception->getMessage());
        }
    }

    public function approve($id)
    {
        //try {

            if($application_form = ApplicationForm::find($id))
            {
                $registration_number = Student::count() + 1;

                $get_school = Setting::where('id', intval($application_form->any_post_secondary_qualification_institution))->first();

                //check if the user exist before and  delete it 

                if(User::where('email',  $application_form->email )->exists()){
                    $old_user = User::where('email',  $application_form->email )->first();
                    $old_student = Student::where( 'user_id' ,  $old_user->id  )->first();

                    if(isset( $old_student->id ) ){
                        $old_student->delete();
                    }

                    $old_user->delete();
                }

				
                $user = new User();
                $password = $application_form->password;
                $user->surname = $application_form->surname;
                $user->other_names = $application_form->other_names;
                $user->email = $application_form->email;
                $user->gender = $application_form->sex;
                $user->password = $password;
                $user->avatar = "/storage/images/passport/".$application_form->passport ;
                $user->account_type = "student";
                $user->school_id = $get_school ? $get_school->id : null;
                $user->save();

                $student = new Student();
                $student->user_id = $user->id;
                $student->registration_number = $registration_number;
                $student->current_session = 1;
                $student->program_id = $application_form->program_id;
                $student->department_id = $application_form->department_id;
                $student->save();

                $application_form->user_id = $user->id;
                $application_form->processed = true;
                $application_form->save();

                return redirect()->back()->with("success", "Student account has been activated successfully");
            }

            return redirect()->back()->with("danger", "Invalid application form");

        /*} catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }*/
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

            ]);

            return redirect()->back()->with("success", "Course has been updated successfully");

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

            if($application_form = ApplicationForm::find($id))
            {
                $application_form->delete();

                return redirect()->route("admin.applications.index")->with("success", "Application form has been removed successfully");
            }

            return redirect()->route("admin.applications.index")->with("danger", "Invalid application form");

        } catch(\Exception $exception) {

            return redirect()->route("admin.applications.index")->with("danger", $exception->getMessage());
        }
    }
}
