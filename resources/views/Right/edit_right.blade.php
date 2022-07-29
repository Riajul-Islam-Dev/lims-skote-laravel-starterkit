@extends('layouts.master')

@section('title')
    Edit Right
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            LIMS
        @endslot
        @slot('title')
            Edit Right
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Right Form:</h4>
                    <p class="card-title-desc">Please fill up the edit Right form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/update_right/' . $edit_right_data->id) }}" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="right_name" class="form-label">Right Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="right_name" name="right_name"
                                        value="{{ $edit_right_data->right_name }}" placeholder="Right Name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter new Right name!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="right_code" class="form-label">Right Code <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="right_code" name="right_code"
                                        value="{{ $edit_right_data->right_code }}" placeholder="Right Code" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter Right Code!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p>Right Active: </p>
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
@endsection
