@extends('layouts.master')

@section('title')
    Show User
@endsection

@section('css')
    @stack('css_data_table')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            LIMS
        @endslot
        @slot('title')
            Show User
        @endslot
    @endcomponent

    <!-- User Data Table -->
    <div>
        @include('Lims/user/user_data_table')
    </div>


    <!-- Add User Modal -->
    @include('Lims/user/create_user_modal')
@endsection

@section('script')
    {{-- Developer's JS file --}}
    @include('Lims.user.user_scripts')
    <script>
        // load_office_list();

        // function load_office_list() {
        //     $("#user_data_table_load").load(
        //         View::make('Lims/user/user_data_table') - > renderSections();
        //     );
        // }
    </script>
    <!-- apexcharts -->
    {{-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- dashboard init -->
    {{-- <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script> --}}

    @stack('js_data_table')


    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection
