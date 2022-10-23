@extends('layouts.master')

@section('title')
    Show User
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
            LIMS
        @endslot
        @slot('title')
            Show User
        @endslot
    @endcomponent

    <!-- User Data Table -->
    <div>
        @include('Lims/user/user_data_table')
    </div>

    <!-- Add User Modal -->
    @include('Lims/user/create_user_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.user.user_scripts')
@endpush
