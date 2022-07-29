@extends('layouts.master')

@section('title')
    Edit Role
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
            Edit Role
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Role Form:</h4>
                    <p class="card-title-desc">Please fill up the edit Role form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/update_role/' . $edit_role_data->id) }}" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="role_name" class="form-label">Role Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="role_name" name="role_name"
                                        value="{{ $edit_role_data->role_name }}" placeholder="Role Name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter new Role name!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="role_section" class="form-label">Role Section <span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" id="role_section" name="role_section"
                                        placeholder="Select Role Section" required>
                                        <option selected disabled>Select Role Section</option>
                                        <optgroup label="IT">
                                            <option value="Web Development">Web Development</option>
                                            <option value="Android Development">Android Development</option>
                                            <option value="IOS Development">IOS Development</option>
                                            <option value=".NET Core">.NET Core</option>
                                        </optgroup>
                                        <optgroup label="SQA">
                                            <option value="Front End">Front End</option>
                                            <option value="Back End">Back End</option>
                                        </optgroup>
                                        <optgroup label="Management">
                                            <option value="CEO">CEO</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Emplyee">Emplyee</option>
                                        </optgroup>
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Select Role Section!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="role_access_level" class="form-label">Role Access Level <span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" id="role_access_level" name="role_access_level"
                                        placeholder="Select Role Access Level" required>
                                        <option selected disabled>Select Role Access Level</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Team Lead">Team Lead</option>
                                        <option value="Senior">Senior</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Intern">Intern</option>
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Select Role Section!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>Role Active: </p>
                                <div>
                                    <input type="checkbox" id="status" name="status" switch="bool" checked />
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
