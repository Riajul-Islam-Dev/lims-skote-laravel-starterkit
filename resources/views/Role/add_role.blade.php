@extends('layouts.master')

@section('title')
    Add Role
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
            Add Role
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Role Form:</h4>
                    <p class="card-title-desc">Please fill up the new Role form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/save_role') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="role_name" class="form-label">Role Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="role_name" name="role_name"
                                        placeholder="Role Name" required>
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
                                        @foreach ($department_data as $department_individual_data)
                                            <optgroup label={{ $department_individual_data->department_name }}>
                                                @foreach ($role_section_data as $role_section_individual_data)
                                                    @if ($role_section_individual_data->department_name == $department_individual_data->id)
                                                        <option value="{{ $role_section_individual_data->id }}">
                                                            {{ $role_section_individual_data->role_section_name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                        @endforeach
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
