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
    <!-- Date picker Js -->
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

    <!-- Sweet alert js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- toastr js -->
    <script src="{{ URL::asset('assets/libs/toastr/toastr.min.js') }}"></script>

    <!-- Developer's JS file -->
    @include('Lims.user.user_scripts')
@endpush
