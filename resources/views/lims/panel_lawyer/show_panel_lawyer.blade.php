@extends('layouts.master')

@section('title')
    Show Panel Lawyer
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
            Show Panel Lawyer
        @endslot
    @endcomponent

    <!-- Panel Lawyer Data Table -->
    <div>
        @include('Lims/panel_lawyer/panel_lawyer_data_table')
    </div>

    <!-- Add Panel Lawyer Modal -->
    @include('Lims/panel_lawyer/create_panel_lawyer_modal')

    <!-- Edit Panel Lawyer Modal -->
    @include('Lims/panel_lawyer/edit_panel_lawyer_modal')

    <!-- Show Panel Lawyer Modal -->
    @include('Lims/panel_lawyer/show_panel_lawyer_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.panel_lawyer.panel_lawyer_scripts')
@endpush
