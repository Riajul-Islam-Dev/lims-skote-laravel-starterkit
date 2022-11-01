@extends('layouts.master')

@section('title')
    Home
@endsection

@section('css')
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="/">LIMS</a>
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6">
            <div class="card border-warning mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Next 7 days Civil Cases List:</h4>
                    <table class="table table-hover">
                        <tr>
                            <th>dummy_data</th>
                            <th>dummy_data</th>
                            <th>dummy_data</th>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-info mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3">Next 7 days Criminal Cases List:</h4>
                    <table class="table table-hover">
                        <tr>
                            <th>dummy_data</th>
                            <th>dummy_data</th>
                            <th>dummy_data</th>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                        </tr>
                        <tr>
                            <td>dummy_data</td>
                            <td>dummy_data</td>
                            <td>dummy_data </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- auth-2-carousel init -->
    <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script>
@endsection
