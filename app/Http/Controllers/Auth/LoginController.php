<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\ApplicationForm;
use App\Http\Models\Lecturer;
use App\Http\Models\Student;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        try {

            if ($request->isMethod("post"))
            {
                // Validate credentials
                $this->validate($request, [
                    "user_id" => "bail|required|string",
                    "password" => "bail|required|string"
                ]);

                // try to sign in depending on the kind of user
                // TODO: Implement login for other kinds of users

                $trySignIn = false;

                if(filter_var($request->user_id, FILTER_VALIDATE_EMAIL))
                {
                    // if user id is an email address, try to sign in using email address
                    $trySignIn = self::trySignIn($request, "email");
                } else {
                    // User id could be a staff id or a student id
                    $trySignIn = self::trySignIn($request);
                }

                if($trySignIn)
                {
                    return redirect()->route("dashboard");
                } else {

                    if(ApplicationForm::where("email", $request->user_id)->where("processed", false)->count() > 0)
                    {
                        throw new \Exception("Your application is still under review, you will hear from us very soon");
                    }

                    throw new \Exception("Invalid Login");
                }


            } else {
                throw new \Exception("Please go to the login page to login");
            }

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    static function trySignIn(Request $request, $type = null)
    {

        $remember  =  true ;
        switch ($type)
        {
            case "email":
                if(auth()->attempt([
                    "email" => $request->user_id,
                    "password" => $request->password
                ],  $remember ))
                {
                    return true;
                }
                break;
            default:
                // Search for user_id in list of lecturers and then students
                if($lecturer = Lecturer::where("staff_id", $request->user_id)->first())
                {
                    if(auth()->attempt([
                        "id" => $lecturer->user->id,
                        "password" => $request->password
                    ],  $remember ))
                    {
                        return true;
                    }
                }

                if($student = Student::where("registration_number", $request->user_id)->where("active", true)->first())
                {
                    if(auth()->attempt([
                        "id" => $student->user->id,
                        "password" => $request->password
                    ],  $remember ))
                    {
                        $student->assignHostel();

                        return true;
                    }
                }

                break;
        }

        return false;
    }
}
