@extends('layouts.master')

@section('title')
    Add Menu
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
            Add Menu
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Menu Form:</h4>
                    <p class="card-title-desc">Please fill up the new Menu form carefully. Fields marked with <span
                            style="color: red">*</span> are required.
                    </p>
                    <form action="{{ url('/save_menu') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="name" class="form-label">Menu Name <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter new Menu name!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="module_name" class="form-label">Module Name <span
                                            style="color: red">*</span></label>
                                    <select class="form-control select2" id="module_name" name="module_name"
                                        placeholder="Select Module Name" required>
                                        <option selected disabled>Select Module Name</option>
                                        @foreach ($module_data as $module_name)
                                            {
                                            <option value="{{ $module_name }}">{{ $module_name }}</option>
                                            }
                                        @endforeach
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Select Module Name!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="icon" class="form-label">Icon <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="icon" name="icon"
                                        placeholder="Icon" required>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please select Icon!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p>Menu Active: </p>
                                <div>
                                    <input type="checkbox" id="status" name="status" switch="bool" checked />
                                    <label for="status" data-on-label="Yes" data-off-label="No"></label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary mt-5" type="submit" value="submit">Submit</button>
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
