<?php

namespace App\Http\Controllers\Admin;

use App\App\Http\Models\GeneratedVoucher;
use App\App\Http\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::get();
        $generated_vouchers = GeneratedVoucher::orderBy("created_at", "desc")->get();

        return view("admin.vouchers.index", compact("vouchers", "generated_vouchers"));
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
                "number_of_vouchers" => "bail|required|integer",
                "amount" => "bail|required"
            ]);

            $generated_vouchers = [];

            if($request->number_of_vouchers > 0)
            {
                for($voucher_count = 0; $voucher_count < $request->number_of_vouchers; $voucher_count++)
                {
                    $voucher_code = str_random(10);
                    $voucher_serial_number = "";
                    for ($serial_number_count=0; $serial_number_count < 15; $serial_number_count++)
                    {
                        $voucher_serial_number = $voucher_serial_number.rand(0, 9);
                    }

                    $voucher = new Voucher();
                    $voucher->code = $voucher_code;
                    $voucher->serial_number = $voucher_serial_number;
                    $voucher->amount = $request->amount;
                    $voucher->save();
                    array_push($generated_vouchers, $voucher);
                }

                $data = [
                    "vouchers" => $generated_vouchers
                ];

                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView("pdf.vouchers", $data);
                $output = $pdf->output();
                $file_name = "Generated ".$voucher_count." Vouchers - " . Carbon::now()->toDayDateTimeString().".pdf";
                Storage::put("vouchers/".$file_name, $output);

                $generated_voucher = new GeneratedVoucher();
                $generated_voucher->file_name = $file_name;
                $generated_voucher->save();
            }

            return redirect()->back()->with("success", "Vouchers have been generated successfully and is now available for download");

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function downloadGeneratedVoucher($id)
    {
        try {
            if($voucher = GeneratedVoucher::find($id))
            {
                return response()->download(storage_path("app/vouchers/".$voucher->file_name));
            }

            return redirect()->back()->with("danger", "Invalid Voucher list");

        } catch(ValidationException $exception) {

            return redirect()->back()->with("danger", $exception->validator->errors()->first());

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }

    public function downloadVouchers(Request $request)
    {
        try {
            $vouchers = Voucher::get();

            $data = [
                "vouchers" => $vouchers
            ];

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView("pdf.vouchers", $data);
            return $pdf->download("All Vouchers");

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
        //
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
                "amount" => "bail|required",
            ]);

            if($voucher = Voucher::find($id))
            {
                $voucher->amount = $request->amount;
                $voucher->save();

                return redirect()->back()->with("success", "Voucher has been updated successfully");
            }

            return redirect()->back()->with("danger", "Invalid voucher");

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

            if($voucher = Voucher::find($id))
            {
                $voucher->delete();

                return redirect()->back()->with("success", "Voucher has been removed successfully");
            }

            return redirect()->back()->with("danger", "Invalid voucher");

        } catch(\Exception $exception) {

            return redirect()->back()->with("danger", $exception->getMessage());
        }
    }
}