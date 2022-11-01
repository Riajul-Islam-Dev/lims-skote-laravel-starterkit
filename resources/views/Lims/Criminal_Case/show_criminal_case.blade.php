@extends('layouts.master')

@section('title')
    Show Criminal Case
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
            Criminal Case
        @endslot
    @endcomponent

    <!-- User Data Table -->
    <div>
        @include('Lims/Criminal_Case/criminal_case_data_table')
    </div>

    <!-- Add User Modal -->
    @include('Lims/Criminal_Case/create_criminal_case_modal')

    <!-- Edit User Modal -->
    @include('Lims/Criminal_Case/edit_criminal_case_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.Criminal_Case.criminal_case_scripts')
@endpush
