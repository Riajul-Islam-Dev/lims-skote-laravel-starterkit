@extends('layouts.master')

@section('title')
    Show Department
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            LIMS
        @endslot
        @slot('title')
            Show Department
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Department List:</h4>
                    <p class="card-title-desc">All Departments are listed in the data table here.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <a href="{{ url('/add_department') }}" class="btn btn-success my-3"><i
                                class="fa-solid fa-circle-plus"></i> Add new Department</a>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($show_department_data as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->department_name }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="{{ url('/edit_department/' . $data->id) }}" class="btn btn-warning"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <a href="{{ url('/delete_department/' . $data->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Delete Department?')"><i class="fa-solid fa-trash-can"></i>
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
