<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use Carbon\Carbon;
use App\Http\Models\RemitaPayment;
use App\Http\Models\ApplicationForm;
use Illuminate\Http\Request;
use App\Http\Models\Program;
use App\Http\Models\registration_fee;
use App\Http\Models\result;
use App\Http\Models\results_format;
use App\Http\Models\registration_payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route("home");
});


Route::post("register_straight", [RegisterController::class,  'Register']);

//download  application  




Route::match(["GET", "POST"], "make-payment", [
    "as" => "student.make-payment",
    "uses" => "Student\StudentController@makePayment"
]);


Route::match(["GET", "POST"], "deny-student-access", [
    "as" => "student.denyaccess",
    "uses" => "Student\StudentController@denyaccess"
]);






Route::match(["GET", "POST"], "biodata", [
    "as" => "student.bio",
    "uses" => "Student\StudentController@bio",
    //"middleware" => "student"
]);

Auth::routes();


//result upload 



Route::get('/upload_result', [ResultController::class ,  'upload'])->name('upload-result');

Route::get('/results', [ResultController::class, 'index'])->name('results.index');

Route::post('/results/update', [ResultController::class, 'update'])->name('results.update');

Route::post('/student/result/delete/', [ResultController::class, 'deletefunction'])->name('results.delete');

Route::post('/results/update-courses', [ResultController::class, 'updateCourses'])->name('results.update.courses');

Route::post('/results/toggle-publish', [ResultController::class, 'togglePublish'])->name('results.toggle.publish');


//get the list of date in the result database based on program id  or name

//registration form details and confirmation 

Route::get('registration_payment', function () {

    return   view('registration_payment');
})->name('registration_payment');




//create RRR for registration code  



Route::post('registration_payment',   function (Request  $request) {
    // get the program amount 
    //registration amount fee 


    $registration =  registration_fee::first();


    $amount = $registration->fee;


    //check if the email is presense in registration table b/4 input

    $reason = 'application';
    $merchantId = "4054002435";

    $apiKey = "184762";

    $serviceTypeId = "535199552";

    $order_id = Carbon::now()->timestamp . "-1";
    $totalAmount = $amount;
    $hash_string = $merchantId . $serviceTypeId . $order_id . $totalAmount .  $apiKey;

    $hash = hash("sha512", $hash_string);
    $headers = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
        "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
    ];

    $studentController = new StudentController();

    $generate_rrr = $studentController->getRrrFromRemita("POST", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit", [
        "serviceTypeId" => $serviceTypeId,
        "amount" => $totalAmount,
        "orderId" => $order_id,
        "payerName" => $request->first_name . " " . $request->last_name,
        "payerEmail" => $request->email,
        "payerPhone" =>  $request->phone,
        "hash" => $hash,
    ], $headers);

    //return($generate_rrr);

    if ($generate_rrr[0]) {
        $rrr = $generate_rrr[1]->RRR;

        // if(RemitaPayment::where("rrr", $rrr)->count() > 0)
        // {
        //     return redirect()->back()->with("danger", "Invalid RRR");
        // }



        //here just saved the remita details .......

        $remita_payment = new RemitaPayment();



        $remita_payment->rrr = $rrr;
        $remita_payment->reason = $reason;
        $remita_payment->amount = $amount;
        $remita_payment->save();

        // save inside registration table 


        $registration_payment   =  new registration_payment();

        $registration_payment->remita  =  $rrr;
        $registration_payment->amount  =  $amount;
        $registration_payment->name  =  $request->first_name . "  " . $request->last_name;
        $registration_payment->phone  =     $request->phone;

        $registration_payment->paid  = 'no';

        $registration_payment->email  = $request->email;
        $registration_payment->save();

        // Redirect to remita to complete application payment
        return redirect()->route("make-application-payment", ["rrr" => $rrr])->with("success", "<h1> Loading........  </h1> <script>  document.SubmitRemitaForm.submit() </script> ");
    }



    return back()->with("danger", "Your application could not be processed, please try again");
});








Route::get('confirm_registration_code', function () {

    return   view('confirm_registration_code');
})->name('confirm_registration_code_view');



Route::post('confirm_registration_code', function (Request  $request) {
    $studentController = new StudentController();
    $rrr   = $request->rrr;
    $apiKey = "184762";
    $merchantId = "4054002435";
    $hash_string = $rrr . $apiKey . $merchantId;
    $hash = hash("sha512", $hash_string);

    $headers = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
        "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
    ];

    $check_rrr =  $studentController->getRrrFromRemita("GET", "https://login.remita.net/remita/ecomm/" . $merchantId . "/" . $rrr . "/" . $hash . "/status.reg", null, $headers);
    // dd($check_rrr);
    if (strtolower($check_rrr[1]->message) == "approved") {
        //it make an update here directly  period okay  
        if ($remita_payment = RemitaPayment::where("rrr", $rrr)->where("paid", false)->where('reason', 'application')->first()) {
            //create registration session  ....

            $request->session()->put('confirm_payment', $rrr);



            return redirect('/register');
        }

        //update the registration   form 


        if ($registration_payment = registration_payment::where("remita", $rrr)->where("paid", 'no')->first()) {


            $request->session()->put('confirm_payment', $rrr);

            return redirect('/register');
        }

        //search the rrr in the application form area  .

        $application_id = ApplicationForm::where('remita',  $rrr)->first();

        //$request->session()->put('download_application_form',$rrr);


        if (isset($application_id->id)) {
            $request->session()->put('download_application_form', $application_id->id);

            return redirect()->route('view_application_now', ['id' => $application_id->id]);

            return view('download_application_pdf')->with("id",  $application_id->id);
        } else {

            //return redirect()->route("student.make-payment")->with("success", "Payment verified successfully");
            return  back()->with("success", "Payment verified successfully");
        }
    }

    return redirect('/registration_payment')->with("danger", "Payment not verified");
});



Route::get('view_application/{id}',   [RegisterController::class, 'viewApplication'])->name('view_application_now');


// direct payment 


Route::get('paynow', function () {

    return   view('paystraight');
});


// confirmopayment link  


Route::get('confirmpayment', function () {

    return  view('payment_confirm');
});


Route::post('confirmpayment', function (Request  $request) {
    $studentController = new StudentController();
    $rrr   = $request->rrr;

    $apiKey = "184762";
    $merchantId = "4054002435";

    $hash_string = $rrr . $apiKey . $merchantId;
    $hash = hash("sha512", $hash_string);

    $headers = [
        "Content-Type" => "application/json",
        "Accept" => "application/json",
        "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
    ];

    $check_rrr =  $studentController->getRrrFromRemita("GET", "https://login.remita.net/remita/ecomm/" . $merchantId . "/" . $rrr . "/" . $hash . "/status.reg", null, $headers);

    // dd($check_rrr);

    if (strtolower($check_rrr[1]->message) == "approved") {
        //it make an update here directly  period okay  
        // check the reason  



        if ($remita_payment = RemitaPayment::where("rrr", $rrr)->where("paid", false)->first()) {
            if ($remita_payment->reason  == 'tuition') {

                $remita_payment->paid = true;
                $remita_payment->amount = $check_rrr[1]->amount;
                $remita_payment->save();
            } else {




                $request->session()->put('confirm_payment', $rrr);



                return redirect('/register');
            }
        }




        return back()->with("success", "Payment verified successfully");
        // return redirect()->route("student.make-payment")->with("success", "Payment verified successfully");
    }

    return back()->with("danger", "Payment not verified");
});


//pay directly to the portal straigh without problem  ......



Route::post('payment_gateway', [
    "as" => "tuition fee",
    "uses" => "Student\StudentController@generatePaymentRrr_fromhome"
]);




Route::post('download_application', function (Request  $request) {

    $data = [


        "application_form" => ApplicationForm::find($request->id)


    ];


    $pdf = App::make('dompdf.wrapper');
    $pdf->loadView("admin.applications.download_app
", $data);
    //remove session 
    $request->session()->forget('confirm_payment');

    //update registration and remita table 
    return $pdf->download("Application_form.pdf");
});


Route::get("register/remita-payment/{rrr}", [
    "as" => "make-application-payment",
    "uses" => "Student\StudentController@makeApplicationPayment"
]);






Route::get('/home', [
    "as" => "home",
    "uses" => "HomeController@index"
]);

Route::group(['middleware' => 'custom_auth'], function () {
    Route::get('/dashboard', [
        "as" => "dashboard",
        "uses" => "HomeController@dashboard"
    ]);

    Route::group(["prefix" => "student"], function () {
        Route::get("show/{id}", [
            "as" => "student.show",
            "uses" => "Student\StudentController@show"
        ]);


        Route::get("download-result/{format}/{student_id}/{session}", [
            "as" => "student.download-result",
            "uses" => "Student\StudentController@downloadResult"
        ]);



        Route::get("download-biodata/{student_id}", [
            "as" => "student.download-biodata",
            "uses" => "Student\StudentController@downloadBiodata"
        ]);
    });

    Route::group(["prefix" => "course/"], function () {
        Route::get("{id}", [
            "as" => "course.show",
            "uses" => "HomeController@course"
        ]);

        Route::get("{id}/student-sheet/{format}", [
            "as" => "course.student-sheet",
            "uses" => "HomeController@studentSheet"
        ]);



        Route::group(["prefix" => "students"], function () {
            Route::post("bulk-upload", [
                "as" => "students.bulk-upload",
                "uses" => "HomeController@uploadStudent"
            ]);

            Route::get("download-all-students-sheet/{format}", [
                "as" => "students.download-all-students-sheet",
                "uses" => "HomeController@downloadAllStudentsSheet"
            ]);

            Route::post("upload-results", [
                "as" => "students.upload-results",
                "uses" => "HomeController@uploadResults"
            ])->middleware('resultUploaders');
        });
    });



    Route::match(["GET", "POST"], "manage-settings", [
        "as" => "user.manage-settings",
        "uses" => "HomeController@manageSettings"
    ]);




    Route::post("change-avatar", [
        "as" => "user.change-avatar",
        "uses" => "HomeController@changeAvatar"
    ]);

    Route::post("change-password", [
        "as" => "user.change-password",
        "uses" => "HomeController@changePassword"
    ]);

    Route::post("payment/generate-rrr", [
        "as" => "payment.generate-rrr",
        "uses" => "Student\StudentController@generatePaymentRrr"
    ]);

    // Route::get('pay-remita', [
    //     "as" => "pay-remita",
    //     "uses" => "Student\StudentController@verifyRemitaPayment"
    // ]);

    Route::get('check-remita-payment-status/{rrr}', [
        "as" => "check-remita-payment-status",
        "uses" => "Student\StudentController@checkRemitaPaymentStatus"
    ]);
});

Route::match(["GET", "POST"], 'pay-remita/{verify?}', [
    "as" => "pay-remita",
    "uses" => "Student\StudentController@verifyRemitaPayment"
]);

Route::get('/logout', [
    "uses" => 'Auth\LoginController@logout'
]);
