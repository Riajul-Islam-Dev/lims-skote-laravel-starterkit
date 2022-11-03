@extends('layouts.master')

@section('title')
    Show Court
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
            Court
        @endslot
    @endcomponent

    <!-- Court Data Table -->
    <div>
        @include('Lims/court/court_data_table')
    </div>

    <!-- Add Court Modal -->
    @include('Lims/court/create_court_modal')

    <!-- Edit Court Modal -->
    @include('Lims/court/edit_court_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.court.court_scripts')
@endpush
