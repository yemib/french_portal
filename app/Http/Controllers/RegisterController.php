<?php

namespace App\Http\Controllers;


use App\Http\Models\ApplicationForm;
use App\Http\Models\Program;
use App\Http\Models\Student;
use App\User;
use PDF;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;
use App\Http\Models\Setting;
use App\Http\Controllers\Student\StudentController;
use App\Http\Models\RemitaPayment;
use App\Http\Models\registration_payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use App\Old_Application;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showRegistrationForm()
    {
        $programs = Program::get();
        $schools = Setting::orderBy("school_title", "asc")->get();

        return view('auth.register', compact('programs', "schools"));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        //try {
        $this->validate($request, [
            "surname" => "bail|required|string",
            "first_name" => "bail|required|string",
            "other_names" => "bail|required|string",
            "email" => "bail|required|email|unique:users|unique:application_forms",
            "password" => "bail|required|confirmed",
            "sex" => "bail|required|string",
            "marital_status" => "bail|required|string",
            "phone" => "bail|required|string",
            "year_of_birth" => "bail|required|string",
            "month_of_birth" => "bail|required|string",
            "day_of_birth" => "bail|required|string",
            "nationality" => "bail|required|string",
            "state_of_origin" => "bail|required|string",
            "place_of_birth" => "bail|required|string",
            "postal_address" => "bail|required|string",
            //"permanent_address" => "bail|required|string",
            "next_of_kin" => "bail|required|string",
            "next_of_kin_relationship" => "bail|required|string",
            "next_of_kin_occupation" => "bail|required|string",
            "next_of_kin_address" => "bail|required|string",
            //"nysc_status" => "bail|required|string",
            "had_disability" => "bail|required|string",
            //"had_disability_yes" => "bail|required|string",
            "level_of_french_proficiency" => "bail|required|string",
            "any_post_secondary_qualification" => "bail|required|string",
            //"any_post_secondary_qualification_yes" => "bail|required|string",
            //"any_post_secondary_qualification_year" => "bail|required|string",
            //"any_post_secondary_qualification_institution" => "bail|required|string",
            //"course_in_view" => "bail|required|string",
            //"course_in_view_award" => "bail|required|string",
            "applied_before" => "bail|required|string",
            //"applied_before_yes" => "bail|required|string",
            "attended_course_before" => "bail|required|string",
            //"attended_course_before_yes" => "bail|required|string",
            "program" => "bail|required|integer",
            "department" => "bail|required|integer",
            "passport" => "bail|required|image|mimes:jpeg,jpg,png,gif,bmp|max:20480000000",
            "secondary_education_subject_1" => "bail|required",
            "secondary_education_grade_1" => "bail|required",
            "secondary_education_subject_2" => "bail|required",
            "secondary_education_grade_2" => "bail|required",
            "secondary_education_subject_3" => "bail|required",
            "secondary_education_grade_3" => "bail|required",
            "secondary_education_subject_4" => "bail|required",
            "secondary_education_grade_4" => "bail|required",
            "secondary_education_subject_5" => "bail|required",
            "secondary_education_grade_5" => "bail|required",
            "secondary_education_subject_6" => "bail|required",
            "secondary_education_grade_6" => "bail|required",
            "secondary_education_subject_7" => "bail|required",
            "secondary_education_grade_7" => "bail|required",
            "secondary_education_subject_8" => "bail|required",
            "secondary_education_grade_8" => "bail|required",
            "secondary_education_subject_9" => "bail|required",
            "secondary_education_grade_9" => "bail|required",
        ]);





        // Check if the application exists
        $check = ApplicationForm::where('email', $request->email)->first();

        if ($check) {

            $tableName = (new Old_Application())->getTable();

            // Convert model to array
            $data = $check->toArray();
            $data['old_application_id'] = $data['id'];

            // Exclude system columns
            $excludedColumns = ['id', 'created_at', 'updated_at'];

            foreach ($data as $key => $value) {

                if (in_array($key, $excludedColumns)) {
                    continue;
                }

                if (!Schema::hasColumn($tableName, $key)) {

                    Schema::table($tableName, function (Blueprint $table) use ($key, $value) {

                    
                            $table->text($key)->nullable();
                        
                    });
                }
            }

            // Insert into old_applications table
            Old_Application::create($data);

            // Now delete from application_forms table
            $check->delete();
        }





        $application_form = new ApplicationForm();

        try {

            $user = auth()->user();

            // Ensure a file was uploaded and is valid
            if (!$request->hasFile('passport') || !$request->file('passport')->isValid()) {
                return redirect()->back()->with("danger", "Please upload a valid passport image file.");
            }

            $passport = $request->file('passport');

            // Extra server-side check of allowed extensions
            $allowed = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            $extension = strtolower($passport->getClientOriginalExtension());
            if (!in_array($extension, $allowed)) {
                return redirect()->back()->with("danger", "Passport must be an image (jpg, jpeg, png, gif, bmp).");
            }

            // Generate a unique filename to avoid collisions
            $passport_name = time() . '_' . uniqid() . '.' . $extension;

            // Ensure destination directory exists
            $destinationPath = public_path('storage/images/passport');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Move the uploaded file
            $passport->move($destinationPath, $passport_name);

            $application_form->passport = $passport_name;
        } catch (\Exception $exception) {

            return redirect()->back()->with("danger", "There was an error with your uploaded file, please try again");
        }

        $application_form->surname = $request->surname;
        $application_form->first_name = $request->first_name;
        $application_form->other_names = $request->other_names;
        $application_form->email = $request->email;
        $application_form->password = bcrypt($request->password);
        $application_form->sex = $request->sex;
        $application_form->marital_status = $request->marital_status;
        $application_form->phone = $request->phone;
        $application_form->dob = Carbon::create($request->year_of_birth, $request->month_of_birth, $request->day_of_birth)->toDateString();
        $application_form->nationality = $request->nationality;
        $application_form->state_of_origin = $request->state_of_origin;
        $application_form->place_of_birth = $request->place_of_birth;
        $application_form->postal_address = $request->postal_address;
        $application_form->permanent_address = $request->permanent_address;
        $application_form->next_of_kin = $request->next_of_kin;
        $application_form->next_of_kin_relationship = $request->next_of_kin_relationship;
        $application_form->next_of_kin_occupation = $request->next_of_kin_occupation;
        $application_form->next_of_kin_address = $request->next_of_kin_address;
        $application_form->nysc_status = $request->nysc_status;
        $application_form->had_disability = $request->had_disability;
        $application_form->had_disability_yes = $request->had_disability_yes;
        $application_form->level_of_french_proficiency = $request->level_of_french_proficiency;
        $application_form->any_post_secondary_qualification = $request->any_post_secondary_qualification;
        $application_form->any_post_secondary_qualification_yes = $request->any_post_secondary_qualification_yes;
        $application_form->any_post_secondary_qualification_year = $request->any_post_secondary_qualification_year;
        $application_form->any_post_secondary_qualification_institution = $request->any_post_secondary_qualification_institution;
        $application_form->course_in_view = $request->course_in_view;
        $application_form->course_in_view_award = $request->course_in_view_award;
        $application_form->applied_before = $request->applied_before;
        $application_form->applied_before_yes = $request->applied_before_yes;
        $application_form->attended_course_before = $request->attended_course_before;
        $application_form->attended_course_before_yes = $request->attended_course_before_yes;
        $application_form->program_id = $request->program;
        $application_form->department_id = $request->department;
        $application_form->referee_1_name = $request->referee_1_name;
        $application_form->referee_1_position = $request->referee_1_position;
        $application_form->referee_1_address = $request->referee_1_address;
        $application_form->referee_2_name = $request->referee_2_name;
        $application_form->referee_2_position = $request->referee_2_position;
        $application_form->referee_2_address = $request->referee_2_address;
        $application_form->referee_3_name = $request->referee_3_name;
        $application_form->referee_3_position = $request->referee_3_position;
        $application_form->referee_3_address = $request->referee_3_address;
        $application_form->sponsor_name = $request->sponsor_name;
        $application_form->sponsor_address = $request->sponsor_address;
        $application_form->proposed_vocation = $request->proposed_vocation;

        $application_form->secondary_education_subject_1 = $request->secondary_education_subject_1;
        $application_form->secondary_education_grade_1 = $request->secondary_education_grade_1;
        $application_form->secondary_education_subject_2 = $request->secondary_education_subject_2;
        $application_form->secondary_education_grade_2 = $request->secondary_education_grade_2;
        $application_form->secondary_education_subject_3 = $request->secondary_education_subject_3;
        $application_form->secondary_education_grade_3 = $request->secondary_education_grade_3;
        $application_form->secondary_education_subject_4 = $request->secondary_education_subject_4;
        $application_form->secondary_education_grade_4 = $request->secondary_education_grade_4;
        $application_form->secondary_education_subject_5 = $request->secondary_education_subject_5;
        $application_form->secondary_education_grade_5 = $request->secondary_education_grade_5;
        $application_form->secondary_education_subject_6 = $request->secondary_education_subject_6;
        $application_form->secondary_education_grade_6 = $request->secondary_education_grade_6;
        $application_form->secondary_education_subject_7 = $request->secondary_education_subject_7;
        $application_form->secondary_education_grade_7 = $request->secondary_education_grade_7;
        $application_form->secondary_education_subject_8 = $request->secondary_education_subject_8;
        $application_form->secondary_education_grade_8 = $request->secondary_education_grade_8;
        $application_form->secondary_education_subject_9 = $request->secondary_education_subject_9;


        $application_form->secondary_education_grade_9 = $request->secondary_education_grade_9;



        $application_form->remita = (session('confirm_payment')) ? session('confirm_payment') : '  ';



        $application_form->paid =  true;





        $application_form->save();

        $id  =   $application_form->id;

        //update the registration form here  fast 

        if (session('confirm_payment')) {
            $registration   =  registration_payment::where('remita', session('confirm_payment'))->first();
        }

        if (isset($registration->id)) {


            $registration->paid  =  'yes';

            $registration->save();
        }

        // also update remita area 


        if (session('confirm_payment')) {

            $remita_payment  = RemitaPayment::where('rrr',  session('confirm_payment'))->first();
        }
        if (isset($remita_payment->id)) {


            $remita_payment->paid  =  1;


            $remita_payment->save();
        }



        $request->session()->forget('confirm_payment');



        return view('download_application_pdf')->with('id', $id);



        // download the pdf here 
        // just print all the details of application  here peroid   and forget the registration payment session period  ......


    }
}
