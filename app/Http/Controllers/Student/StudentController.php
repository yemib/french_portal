<?php

namespace App\Http\Controllers\Student;

use App\App\Http\Models\StudentBio;
use App\App\Http\Models\Voucher;
use App\Http\Models\Payment;
use App\Http\Models\Program;


use App\Http\Models\ApplicationForm;
use App\Http\Models\State;
use App\Http\Models\Student;
use Illuminate\Validation\ValidationException;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Unirest;
use Carbon\Carbon;
use App\Http\Models\RemitaPayment;
use App\User;


class StudentController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        // TODO: Change at what point hostels are assigned
        //$user->student->assignHostel();

        return view("student.dashboard", compact("user"));
    }

    public function session($session_count)
    {
        $user = auth()->user();

        $registration_no = $user->student;


        //echo( 	$registration_no->registration_number);

        $session_courses = $user->student->get_session_courses($session_count);


        $all = array('matric' => $registration_no->registration_number, 'user' => $user, 'session_courses' => $session_courses, 'session_count' => $session_count);


        return view("student.session")->with($all);
    }

    public function makePayment(Request $request)
    {
        $user = auth()->user();
        if (
            !$user->student ||
            ($user->student->payments && ($user->student->payments->where("session", $user->student->current_session)->where("reason", "tuition")->where("verified", true)->count() > 0))
        ) {
            return redirect()->route("dashboard");
        }

        try {
            if ($request->isMethod("post")) {
                $this->validate($request, [
                    "code" => "bail|required",
                    "serial_number" => "bail|required"
                ]);

                if ($voucher = Voucher::where("code", $request->code)->where("serial_number", $request->serial_number)->first()) {

                    if (Payment::where("voucher_id", $voucher->id)->count() > 0) {
                        return redirect()->back()->with("danger", "The voucher code you entered has already been used");
                    }

                    $payment = new Payment();
                    $payment->student_id = $user->student->id;
                    $payment->session = $user->student->current_session;
                    $payment->voucher_id = $voucher->id;
                    $payment->verified = true;
                    $payment->save();

                    return redirect()->back()->with("success", "Payment saved successfully");
                }

                return redirect()->back()->with("danger", "Invalid Voucher");
            }
        } catch (ValidationException $exception) {
            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {
            return redirect()->back()->with("danger", $exception->getMessage());
        }

        $remita_payments = $user->student->remita_payments;

        return view("student.make_payment", compact("user", "remita_payments"));
    }

    public function bio(Request $request)
    {
        $user = auth()->user();
        if (!$user->student) {
            return redirect()->route("dashboard");
        }

        try {
            if ($request->isMethod("post")) {
                $this->validate($request, []);

                if (!$bio = $user->student->biodata) {
                    $bio = new StudentBio();
                    $bio->student_id = $user->student->id;
                }
                $bio->state_of_origin = $request->state_of_origin;
                $bio->school_of_origin = $request->school_of_origin;
                $bio->phone = $request->phone;
                $bio->dob = $request->date_of_birth;
                $bio->next_of_kin_name = $request->next_of_kin;
                $bio->next_of_kin_phone = $request->next_of_kin_phone;
                $bio->next_of_kin_address = $request->next_of_kin_address;
                $bio->save();

                return redirect()->back()->with("success", "Information saved successfully");
            }
        } catch (ValidationException $exception) {
            return redirect()->back()->with("danger", $exception->validator->errors()->first());
        } catch (\Exception $exception) {
            return redirect()->back()->with("danger", $exception->getMessage());
        }

        $states = State::where("country_id", 160)->get();

        return view("student.bio", compact("user", "states"));
    }

    public function downloadHostelAllocationForm()
    {
        $user = auth()->user();

        $data = [
            "student" => $user->student,
            "hostel_allocation" => $user->student->current_accommodation
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("pdf.student.hostel", $data);
        return $pdf->download("Hostel Allocation Form");
    }



    public function downloadBiodata($student_id)
    {
        if ($student = Student::find($student_id)) {
            if (auth()->user()->account_type == "student" && auth()->user()->student->id != $student_id) {
                return redirect()->back()->with("danger", "Sorry, you are not permitted to download the results you requested");
            }

            $data = [
                "student" => $student
            ];

            $pdf = App::make('dompdf.wrapper');

            $pdf->loadView("pdf.student.biodata", $data);

            return $pdf->download("Student Biodata for " . $student->user->full_name . '.pdf');
        }

        return redirect()->back()->with("danger", "Invalid Student");
    }


    public function test_pdf()
    {

        // test pdf download here 




    }



    public function downloadResult($format, $student_id, $session)
    {
        $user = auth()->user();

        if ($user->account_type == "student" && $user->student->id != $student_id) {
            return redirect()->back()->with("danger", "Sorry, you are not permitted to download the results you requested");
        }

        if ($student = Student::find($student_id)) {
            return $student->downloadResult($format, $student, $session);
        }
    }

    public function show($student_id)
    {
        $user = auth()->user();

        if ($user->account_type == "student") {
            return redirect()->route("dashboard");
        }

        if ($student = Student::find($student_id)) {
            return view("admin.students.show", compact("student"));
        }
    }








    public function generatePaymentRrr(Request $request)
    {


        $user = auth()->user();

        if (
            !$user->student ||
            ($user->student->payments && ($user->student->payments->where("session", $user->student->current_session)->where("reason", "tuition")->where("verified", true)->count() > 0))
        ) {
            return redirect()->route("dashboard");
        }

        //try {

        $this->validate($request, [
            "email" => "bail|required|email",
            "payment_type" => "bail|required|string"
        ]);

        $amount = 0;
        $reason = $request->payment_type;

        /*   if($reason == "access")
            {
                $amount = 1000;
                $merchantId = "3986583200";
                $apiKey = "S8MAX6QP";
                $serviceTypeId = "3994822060";
            } else { */

        //$amount = $user->student->program->tuition + 1000;
        $amount = $user->student->program->tuition  /* + 1000 */;
        $merchantId = "4054002435";
        $apiKey = "184762";
        $serviceTypeId = "535199552";
        // $single_semester = $amount = 61000;
        // if($user->student->program->duration == 1) {
        //     $amount = $single_semester;
        // } else if($user->student->program->duration == 2)
        // {
        //     $amount = 111000;
        // } else {
        //     $amount = $single_semester * $user->student->program->duration;
        // }
        //}

        $order_id = Carbon::now()->timestamp . "-1";
        $totalAmount = $amount;

        $hash_string = $merchantId . $serviceTypeId . $order_id . $totalAmount . $apiKey;
        $hash = hash("sha512", $hash_string);
        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
        ];

        $rrr_body = [
            "serviceTypeId" => $serviceTypeId,
            "amount" => $totalAmount,
            "hash" => $hash,
            "orderId" => $order_id,
            "payerName" => $user->full_name,
            "payerEmail" => $user->full_name,
            "payerPhone" => "",
            "lineItems" => [
                // French Village Acount Details
                [
                    "lineItemsId" => "tuition",
                    "beneficiaryName" => "Nigeria french language village",
                    "beneficiaryAccount" => "1000132",
                    "bankCode" => "000",
                    "beneficiaryAmount" => $user->student->program->tuition,
                    "deductFeeFrom" => "1"
                ],
                /*  // Schoollite Account Details
                    [
                        "lineItemsId" => "access",
                        "beneficiaryName" => "Schoollite Educational Systems",
                        "beneficiaryAccount" => "1016143019",
                        "bankCode" => "057",
                        "beneficiaryAmount" => 1000,
                        "deductFeeFrom" => "0"
                    ] */
            ]
        ];

        $generate_rrr = $this->getRrrFromRemita("POST", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit", $rrr_body, $headers);
        // $generate_rrr = $this->getRrrFromRemita("POST", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit", [
        //     "serviceTypeId" => $serviceTypeId,
        //     "amount" => $totalAmount,
        //     "orderId" => $order_id,
        //     "payerName" => $user->full_name,
        //     "payerEmail" => $request->email,
        //     "payerPhone" => "",
        //     "hash" => $hash,
        // ], $headers);

        //dd($generate_rrr);

        if ($generate_rrr[0]) {
            $rrr = $generate_rrr[1]->RRR;

            // if(RemitaPayment::where("rrr", $rrr)->count() > 0)
            // {
            //     return redirect()->back()->with("danger", "Invalid RRR");
            // }

            $remita_payment = new RemitaPayment();
            $remita_payment->student_id = $user->student->id;
            $remita_payment->rrr = $rrr;
            $remita_payment->session = $user->student->current_session;
            $remita_payment->reason = $reason;
            $remita_payment->amount = $amount;
            $remita_payment->save();

            return redirect()->back()->with("success", "RRR generated successfully");
        }

        return redirect()->back()->with("danger", "Invalid Voucher");
        // } catch (ValidationException $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->validator->errors()->first());
        // } catch (\Exception $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->getMessage());
        // }
    }







    public function generatePaymentRrr_fromhome(Request $request)
    {

        //search user based on the email .
        $this->validate($request, [

            "email" => "bail|required",
            "name" => "bail|required",
            "session" => "bail|required",
            "number" => "bail|required",

            "program_id" => "bail|required",


        ]);

        //search based on registration number period 		

        //$approved  = ApplicationForm::where('email' , $request->email)->where('processed' , true)->count();

        //$details  = ApplicationForm::where('email' , $request->email)->where('processed' , true)->first();

        if (isset($request->registration)) {

            if ($request->registration != '') {

                $student = student::where('registration_number', $request->registration)->first();
            }
        }



        //$student2 = student::where('registration_number' , $request->email)->count();



        //$user = User::where('id' , $student->user_id)->first();

        $program   =  Program::where('id',  $request->program_id)->first();
        // Generate RRR for application payment
        $amount = $program->tuition;

        $reason = 'tuition';
        $number = ($request->number  <= 1) ?  1  : $request->number;

        $amount = 0;
        //$reason = $request->payment_type;
        /* 
            if($reason == "access")
            {
                $amount = 1000 ;
                $merchantId = "3986583200";
                $apiKey = "S8MAX6QP";
                $serviceTypeId = "3994822060";
            } else { */

        //$amount = $user->student->program->tuition + 1000;
        $amount = ($program->tuition  * $number)  /* + (1000* $number) */;
        $merchantId = "4054002435";
        $apiKey = "184762";
        $serviceTypeId = "535199552";
        // $single_semester = $amount = 61000;
        // if($user->student->program->duration == 1) {
        //     $amount = $single_semester;
        // } else if($user->student->program->duration == 2)
        // {
        //     $amount = 111000;
        // } else {
        //     $amount = $single_semester * $user->student->program->duration;
        // }
        //}

        $order_id = Carbon::now()->timestamp . "-1";
        $totalAmount = $amount;

        $hash_string = $merchantId . $serviceTypeId . $order_id . $totalAmount . $apiKey;
        $hash = hash("sha512", $hash_string);
        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
        ];

        $rrr_body = [
            "serviceTypeId" => $serviceTypeId,
            "amount" => $totalAmount,
            "hash" => $hash,
            "orderId" => $order_id,
            "payerName" => $request->name,
            "payerEmail" => $request->email,
            "payerPhone" => "",
            "lineItems" => [
                // French Village Acount Details
                [
                    "lineItemsId" => "tuition",
                    "beneficiaryName" => "Nigeria french language village",
                    "beneficiaryAccount" => "1000132",
                    "bankCode" => "000",
                    "beneficiaryAmount" => $program->tuition * $number,
                    "deductFeeFrom" => "1"
                ]/* ,
                    // Schoollite Account Details
                    [
                        "lineItemsId" => "access",
                        "beneficiaryName" => "Schoollite Educational Systems",
                        "beneficiaryAccount" => "1016143019",
                        "bankCode" => "057",
                        "beneficiaryAmount" => 1000  * $number,
                        "deductFeeFrom" => "0"
                    ] */
            ]
        ];

        $generate_rrr = $this->getRrrFromRemita("POST", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit", $rrr_body, $headers);
        // $generate_rrr = $this->getRrrFromRemita("POST", "https://login.remita.net/remita/exapp/api/v1/send/api/echannelsvc/merchant/api/paymentinit", [
        //     "serviceTypeId" => $serviceTypeId,
        //     "amount" => $totalAmount,
        //     "orderId" => $order_id,
        //     "payerName" => $user->full_name,
        //     "payerEmail" => $request->email,
        //     "payerPhone" => "",
        //     "hash" => $hash,
        // ], $headers);

        //   dd($generate_rrr);

        if ($generate_rrr[0]) {
            $rrr = $generate_rrr[1]->RRR;

            // if(RemitaPayment::where("rrr", $rrr)->count() > 0)
            // {
            //     return redirect()->back()->with("danger", "Invalid RRR");
            // }

            $remita_payment = new RemitaPayment();

            if (isset($student->id)) {

                $remita_payment->student_id = $student->id;
            }

            $remita_payment->rrr = $rrr;
            $remita_payment->session = $request->session;
            $remita_payment->reason = $reason;
            $remita_payment->amount = $amount;
            $remita_payment->save();

            return redirect()->route("make-application-payment", ["rrr" => $rrr])->with("success", "<h1> Loading........  </h1> <script>  document.SubmitRemitaForm.submit() </script>");



            //return redirect()->back()->with("success", "RRR generated successfully");
        }

        return redirect()->back()->with("danger", "Invalid Voucher");



        // } catch (ValidationException $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->validator->errors()->first());
        // } catch (\Exception $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->getMessage());
        // }


        return redirect()->back()->with("danger", "You are not a student");
    }









    public function verifyRemitaPayment(Request $request, $verify = null)
    {
        // if(!$user->student ||
        //     ($user->student->payments && ($user->student->payments->where("session", $user->student->current_session)->where("reason", "tuition")->where("verified", true)->count() > 0)))
        // {
        //     return redirect()->route("dashboard");
        // }

        //try {
        if ($request->isMethod("post") && !is_null($verify)) {
            // {
            //     "rrr":"200007660143",
            //     "channel":"BRANCH",
            //     "amount":9400.0,
            //     "transactiondate":"05/12/2017",
            //     "debitdate":"05/12/2017",
            //     "bank":"011",
            //     "branch":"011152387",
            //     "serviceTypeId":"4430731",
            //     "dateRequested":"05/12/2017",
            //     "orderRef":"5a26535187c2a_1597",
            //     "payerName":"Folivi Joshua",
            //     "payerPhoneNumber":"08084966076",
            //     "payeremail":"folivi@systemspecs.com.ng",
            //     "uniqueIdentifier":""
            //   }

            $this->validate($request, [
                "rrr" => "bail|required|string",
                "amount" => "bail|required"
            ]);

            if ($remita_payment = RemitaPayment::where("rrr", $request->rrr)->where("paid", false)->first()) {
                $remita_payment->paid = true;
                $remita_payment->amount = $request->amount;
                $remita_payment->save();
            }

            return response()->json([
                "message" => "Payment verified successfully"
            ]);
        } else {
            $rrr = $request->RRR;
            $apiKey = "184762";
            $merchantId = "4054002435";

            if (is_null($rrr) || $rrr == "") {
                return redirect()->back()->with("danger", "Invalid RRR");
            }

            $hash_string = $rrr . $apiKey . $merchantId;
            $hash = hash("sha512", $hash_string);

            $headers = [
                "Content-Type" => "application/json",
                "Accept" => "application/json",
                "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
            ];

            $check_rrr = $this->getRrrFromRemita("GET", "https://login.remita.net/remita/ecomm/" . $merchantId . "/" . $rrr . "/" . $hash . "/status.reg", null, $headers);

            if (strtolower($check_rrr[1]->message) == "approved") {
                if ($remita_payment = RemitaPayment::where("rrr", $rrr)->where("paid", false)->first()) {
                    $remita_payment->paid = true;
                    $remita_payment->amount = $check_rrr[1]->amount;
                    $remita_payment->save();

                    if ($remita_payment->reason == "access") {
                        return redirect()->route("register")->with("success", "Your application has been received and will be processed.");
                    }
                }

                return redirect()->route("student.make-payment")->with("success", "Payment verified successfully");
            }

            if (auth()->check()) {
                return redirect()->route("student.make-payment")->with("danger", "Payment not verified");
            }

            return redirect()->route("register")->with("danger", "Your payment was not verified");
        }
        // } catch (ValidationException $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->validator->errors()->first());
        // } catch (\Exception $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->getMessage());
        // }
    }

    public function checkRemitaPaymentStatus($rrr)
    {
        $user = auth()->user();

        // if(!$user->student ||
        //     ($user->student->payments && ($user->student->payments->where("session", $user->student->current_session)->where("reason", "tuition")->where("verified", true)->count() > 0)))
        // {
        //     return redirect()->route("dashboard");
        // }

        //try {
        $apiKey = "184762";
        $merchantId = "4054002435";

        $hash_string = $rrr . $apiKey . $merchantId;
        $hash = hash("sha512", $hash_string);

        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "remitaConsumerKey=" . $merchantId . ",remitaConsumerToken=" . $hash
        ];

        $check_rrr = $this->getRrrFromRemita("GET", "https://login.remita.net/remita/ecomm/" . $merchantId . "/" . $rrr . "/" . $hash . "/status.reg", null, $headers);

        // dd($check_rrr);

        if (strtolower($check_rrr[1]->message) == "approved") {
            //also check the kind of payment  made ......  also don't allow payment 

            if ($remita_payment = RemitaPayment::where("rrr", $rrr)->where("paid", false)->first()) {
                $remita_payment->paid = true;
                //get the student id  
                $student_id  = Student::where('user_id', $user->id)->first();

                $remita_payment->student_id = $student_id->id;
                //update the username and registration number  .....

                $remita_payment->amount = $check_rrr[1]->amount;
                $remita_payment->save();
            }

            return back()->with("success", "Payment verified successfully");
            // return redirect()->route("student.make-payment")->with("success", "Payment verified successfully");
        }

        return back()->with("danger", "Payment not verified");
        // return redirect()->route("student.make-payment")->with("danger", "Payment not verified");
        // } catch (ValidationException $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->validator->errors()->first());
        // } catch (\Exception $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->getMessage());
        // }
    }

    public function makeApplicationPayment($rrr)
    {

        return view("auth.make_payment", ["rrr" => $rrr]);

        $user = auth()->user();

        if (
            !$user->student ||
            ($user->student->payments && ($user->student->payments->where("session", $user->student->current_session)->where("reason", "tuition")->where("verified", true)->count() > 0))
        ) {
            return redirect()->route("dashboard");
        }

        //try {

        return redirect()->back()->with("danger", "Invalid Voucher");
        // } catch (ValidationException $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->validator->errors()->first());
        // } catch (\Exception $exception)
        // {
        //     return redirect()->back()->with("danger", $exception->getMessage());
        // }
    }

    public function getRrrFromRemita($method, $url, $data, $headers = null)
    {
        if (is_null($headers)) {
            $headers = [
                'content-type' => 'application/json'
            ];
        }

        $body = Unirest\Request\Body::json($data);

        // dd($method);
        // dd(json_decode($body));
        //dd($headers);

        $response = Unirest\Request::send($method, $url, $body, $headers);

        //check that the status is success
        if (isset($response->body) && $response->body->status == "Payment Reference generated") {
            return [
                true,
                $response->body
            ];
        }

        return [
            false,
            $response->body
        ];
    }
}
