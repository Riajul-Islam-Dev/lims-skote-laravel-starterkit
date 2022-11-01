@extends('layouts.master')

@section('title')
    Show Menu
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="/">LIMS</a>
        @endslot
        @slot('title')
            Show Menu
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Menu List:</h4>
                    <p class="card-title-desc">All Menu are listed in the data table here.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <a href="{{ url('/add_menu') }}" class="btn btn-success my-3"><i
                                class="fa-solid fa-circle-plus"></i> Add new Menu</a>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menu</th>
                                <th>Module Name</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($show_menu_data as $key => $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->module_name }}</td>
                                    <td><i class="{{ $data->icon }}"></i></td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="{{ url('/edit_menu/' . $data->id) }}" class="btn btn-warning"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <a href="{{ url('/delete_menu/' . $data->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Delete Data?')"><i class="fa-solid fa-trash-can"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
