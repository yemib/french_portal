<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\RemitaPayment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = RemitaPayment::where("reason", "!=", "access")->orderby('id', 'desc')->paginate(200);

        //dd($payments);

        return view("admin.payments.index", compact("payments"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        try {

            if($payment = RemitaPayment::find($id))
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
        //
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

            if($payment = RemitaPayment::find($id))
            {
                if($payment->paid)
                {
                    return redirect()->back()->with("danger", "Sorry, you cannot delete a payment that has been verified already");
                }

                $payment->delete();

                return redirect()->back()->with("success", "Payment has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid payment");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}
