@extends('layouts.master')

@section('title')
    Edit Department
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
            Edit Department
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Department Form:</h4>
                    <p class="card-title-desc">Please fill up the edit Department form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/update_department/' . $edit_department_data->id) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="department_name" class="form-label">Department Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="department_name"
                                        name="department_name" value="{{ $edit_department_data->department_name }}"
                                        placeholder="Department Name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter new Department name!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>Department Active: </p>
                                <div>
                                    @if ($edit_department_data->status == 'Active')
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
