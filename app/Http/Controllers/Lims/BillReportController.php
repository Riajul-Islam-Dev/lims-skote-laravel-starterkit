<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\BillReport;
use App\Http\Requests\StoreBillReportRequest;
use App\Http\Requests\UpdateBillReportRequest;
use App\Models\Lims\PanelLawyer;
use App\Models\Lims\User;
use Validator;

class BillReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lawyer_data = PanelLawyer::all();
        $user_data = User::all();

        return view('Lims/bill_report/show_bill_report', compact('lawyer_data', 'user_data'));
    }

    public function searchByCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'case_type1' => ['required', 'numeric', 'max:2'],
            'case_id1' => ['required', 'numeric', 'max:99999'],
            'start_date1' => ['required', 'string', 'max:255'],
            'end_date1' => ['required', 'string', 'max:255'],
            'month1' => ['required', 'string', 'max:255'],
            'year1' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $billing = new Billing();

            $billing->invoice_id = $request->invoice_id;
            $billing->case_id = $request->case_id;
            $billing->case_type = $request->case_type;
            $billing->lawyer_id = $request->lawyer_id;
            $billing->bill_amount = $request->bill_amount;
            $billing->bill_date = date('Y-m-d', strtotime($request->bill_date));
            $billing->district = $request->district;
            $billing->generated_by = Auth::user()->id;
            $billing->bank_name = $request->bank_name;
            $billing->cheque_number = $request->cheque_number;

            if ($request->bill_status == "on") {
                $request->bill_status = "1";
            } else {
                $request->bill_status = "0";
            }
            $billing->bill_status = $request->bill_status;

            $query = $billing->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Billing Details Saved successfully!",
                    'code' => 1
                ], 200); // Status code here
            } else {
                return response()->json([
                    'isSuccess' => false,
                    'Message' => "Something went wrong!",
                    'code' => 0
                ], 200); // Status code here
            }
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Please check the inputs!",
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ], 200); // Status code here
        }
    }

    public function searchByLawyer(Request $request)
    {
        return ($request);
        $lawyer_data = PanelLawyer::all();
        $user_data = User::all();

        return view('Lims/bill_report/show_bill_report', compact('lawyer_data', 'user_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ("Bill Report create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBillReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillReportRequest $request)
    {
        return ("Bill Report store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function show(BillReport $billReport)
    {
        return ("Bill Report show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function edit(BillReport $billReport)
    {
        return ("Bill Report edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBillReportRequest  $request
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBillReportRequest $request, BillReport $billReport)
    {
        return ("Bill Report edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillReport $billReport)
    {
        return ("Bill Report destroy");
    }
}
