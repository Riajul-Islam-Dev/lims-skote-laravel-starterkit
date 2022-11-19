@extends('layouts.master')

@section('title')
    Show Idea Box
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
            Show Idea Box
        @endslot
    @endcomponent

    <!-- Idea Box Data Table -->
    <div>
        @include('Lims/idea_box/idea_box_data_table')
    </div>

    <!-- Add Idea Box Modal -->
    @include('Lims/idea_box/create_idea_box_modal')

    <!-- Edit Idea Box Modal -->
    @include('Lims/idea_box/edit_idea_box_modal')

    <!-- Show Idea Box Modal -->
    @include('Lims/idea_box/show_idea_box_modal')
@endsection

@push('custom-scripts')
    <!-- Developer's JS file -->
    @include('Lims.idea_box.idea_box_scripts')
@endpush
