@extends('layouts.master')

@section('title')
Show Billing
@endsection

@push('custom-css')
<!-- Date Picker CSS -->
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert -->
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Toastr -->
<link href="{{ URL::asset('assets/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
@component('components.breadcrumb')
@slot('li_1')
<a href="/">LIMS</a>
@endslot
@slot('title')
Show Billing
@endslot
@endcomponent

<!-- Billing Data Table -->
<div>
    @include('lims/billing/billing_data_table')
</div>

<!-- Add Billing Modal -->
@include('lims/billing/create_billing_modal')

<!-- Edit Billing Modal -->
{{-- @include('lims/billing/edit_billing_modal') --}}

<!-- Show Billing Modal -->
{{-- @include('lims/billing/show_billing_modal') --}}
@endsection

@push('custom-scripts')
<!-- Developer's JS file -->
@include('lims.billing.billing_scripts')
@endpush