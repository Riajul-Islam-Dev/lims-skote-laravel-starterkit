@extends('layouts.master')

@section('title')
    Edit Role Section
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            LIMS
        @endslot
        @slot('title')
            Edit Role Section
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Role Section Form:</h4>
                    <p class="card-title-desc">Please fill up the edit Role Section form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/update_role_section/' . $edit_role_section_data->id) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="role_section_name" class="form-label">Role Section Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="role_section_name"
                                        name="role_section_name" value="{{ $edit_role_section_data->role_section_name }}"
                                        placeholder="Role Section Name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter new Role Section name!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="department_name" class="form-label">Department Name <span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" id="department_name" name="department_name"
                                        value="{{ $edit_role_section_data->department_name }}"
                                        placeholder="Select Department Name" required>
                                        <option selected disabled>Select Department Name</option>
                                        @foreach ($department_data as $department_individual_data)
                                            <option value="{{ $department_individual_data->id }}">
                                                {{ $department_individual_data->department_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Select Department Name!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>Role Section Active: </p>
                                <div>
                                    @if ($edit_role_section_data->status == 'Active')
                                        <input type="checkbox" id="status" name="status" switch="bool" checked />
                                    @else
                                        <input type="checkbox" id="status" name="status" switch="bool" />
                                    @endif
                                    <label for="status" data-on-label="Yes" data-off-label="No"></label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary mt-5" type="submit" value="submit">Submit form</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
