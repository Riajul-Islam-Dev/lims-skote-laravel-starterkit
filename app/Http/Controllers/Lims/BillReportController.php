<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use App\Models\Lims\BillReport;
use App\Http\Requests\StoreBillReportRequest;
use App\Http\Requests\UpdateBillReportRequest;
use App\Models\Lims\PanelLawyer;
use App\Models\Lims\User;

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
        
        // $show_bill_report_data = BillReport::all();
        // return view('Lims/idea_box/show_idea_box', compact("show_bill_report_data"));
        return view('Lims/bill_report/show_bill_report', compact('lawyer_data','user_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return("Bill Report create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBillReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillReportRequest $request)
    {
        return("Bill Report store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function show(BillReport $billReport)
    {
        return("Bill Report show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function edit(BillReport $billReport)
    {
        return("Bill Report edit");
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
        return("Bill Report edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lims\BillReport  $billReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(BillReport $billReport)
    {
        return("Bill Report destroy");
    }
}
