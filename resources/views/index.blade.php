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
            LIMS
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-8">
            <div class="text-center">

                <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span
                        class="text-primary">5k</span>+ Satisfied clients</h4>

                <div dir="ltr">
                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                        <div class="item">
                            <div class="py-3">
                                <p class="font-size-16 mb-4">" Fantastic theme with a
                                    ton of options. If you just want the HTML to
                                    integrate with your project, then this is the
                                    package. You can find the files in the 'dist'
                                    folder...no need to install git and all the other
                                    stuff the documentation talks about. "</p>

                                <div>
                                    <h4 class="font-size-16 text-primary">Riajul Islam</h4>
                                    <p class="font-size-14 mb-0">- Developer</p>
                                </div>
                            </div>

                        </div>

                        <div class="item">
                            <div class="py-3">
                                <p class="font-size-16 mb-4">" If Every Vendor on Envato
                                    are as supportive as Themesbrand, Development with
                                    be a nice experience. You guys are Wonderful. Keep
                                    us the good work. "</p>

                                <div>
                                    <h4 class="font-size-16 text-primary">Riajul Islam</h4>
                                    <p class="font-size-14 mb-0">- Developer</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="350" height="300" id="gmap_canvas"
                        src="https://maps.google.com/maps?q=leotechbd&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0"
                        scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                        href="https://fmovies-online.net"></a><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 300px;
                            width: 350px;
                        }
                    </style>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 300px;
                            width: 350px;
                        }
                    </style>
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
