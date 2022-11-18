@extends('layouts.master')

@section('title')
    Show Meeting
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
            Show Meeting
        @endslot
    @endcomponent

    <!-- Meeting Data Table -->
    <div>
        @include('Lims/meeting/meeting_data_table')
    </div>

    <!-- Add Meeting Modal -->
    @include('Lims/meeting/create_meeting_modal')

    <!-- Edit Meeting Modal -->
    @include('Lims/meeting/edit_meeting_modal')

    <!-- Show Meeting Modal -->
    @include('Lims/meeting/show_meeting_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.meeting.meeting_scripts')
@endpush
