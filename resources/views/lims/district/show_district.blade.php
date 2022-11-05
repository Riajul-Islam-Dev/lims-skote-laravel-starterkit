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
            District
        @endslot
    @endcomponent

    <!-- District Data Table -->
    <div>
        @include('Lims/district/district_data_table')
    </div>

    <!-- Add District Modal -->
    @include('Lims/district/create_district_modal')

    <!-- Edit District Modal -->
    @include('Lims/district/edit_district_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.district.district_scripts')
@endpush
