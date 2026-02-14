<?php

namespace App\Http\Controllers\Bursar;

use App\Http\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\RemitaPayment;

class BursarController extends Controller
{
    public function payments()
    {
        // $payments = Payment::get();
        $payments = RemitaPayment::orderby('id' , 'desc')->paginate(1000);

        return view("bursar.payments.index", compact("payments"));
    }

    public function verifyPayment($id)
    {
        try {

            if($payment = Payment::find($id))
            {
                $payment->verified = true;
                $payment->save();

                return redirect()->back()->with("success", "Payment has been verified successfully");
            }

            return redirect()->back()->with("danger", "Invalid payment");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function removePayment($id)
    {
        try {

            if($payment = Payment::find($id))
            {
                $payment->delete();

                return redirect()->back()->with("success", "Payment has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid payment");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
