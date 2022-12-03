@extends('layouts.master')

@section('title')
Role Box
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
Role
@endslot
@endcomponent

<!-- Role Data Table -->
<div>
    @include('Lims/role/role_data_table')
</div>

<!-- Add Role Modal -->
@include('Lims/role/create_role_modal')

<!-- Edit Role Modal -->
@include('Lims/role/edit_role_modal')

<!-- Role Box Modal -->
@include('Lims/role/show_role_modal')
@endsection

@push('custom-scripts')
<!-- Developer's JS file -->
@include('Lims.role.role_scripts')
@endpush