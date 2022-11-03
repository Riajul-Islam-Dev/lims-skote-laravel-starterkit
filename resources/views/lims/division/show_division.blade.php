@extends('layouts.master')

@section('title')
    Show Division
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
            Division
        @endslot
    @endcomponent

    <!-- Division Data Table -->
    <div>
        @include('Lims/division/division_data_table')
    </div>

    <!-- Add Division Modal -->
    @include('Lims/division/create_division_modal')

    <!-- Edit Division Modal -->
    @include('Lims/division/edit_division_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.division.division_scripts')
@endpush
