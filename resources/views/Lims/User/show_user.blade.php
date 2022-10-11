@extends('layouts.master')

@section('title')
    Show User
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
            Show User
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">User List:</h4>
                    <p class="card-title-desc">All Users are listed in the data table here.
                    </p>

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <a href="{{ url('/add_user') }}" class="btn btn-success my-3"><i
                                class="fa-solid fa-circle-plus"></i> Add new User</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success my-3" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            <i class="fa-solid fa-circle-plus"></i> Add new User
                        </button>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($show_user_data as $key => $data)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    {{-- <td>{{ $data->status }}</td> --}}
                                    <td>Status pending</td>
                                    <td>
                                        <a href="{{ url('/edit_user/' . $data->id) }}" class="btn btn-warning"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        <a href="{{ url('/delete_user/' . $data->id) }}" class="btn btn-danger"
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



    <!-- Add User Modal -->
    <div class="container">
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add new user:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <div class="row my-2">
                                <div class="col-6">
                                    <x-lims.forms.input.label for="user_name" label="User Name" star="*" />
                                    <x-lims.forms.input.text name="user_name" id="user_name" placeholder="User Name"
                                        required />
                                </div>
                                <div class="col-6">
                                    <x-lims.forms.input.label for="email" label="Email Address" star="*" />
                                    <x-lims.forms.input.email name="email" id="email" placeholder="Email Address"
                                        required />
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-6">
                                    <x-lims.forms.input.label for="password" label="Password" star="*" />
                                    <x-lims.forms.input.password name="password" id="password" placeholder="Password"
                                        required />
                                </div>
                                <div class="col-6">
                                    <x-lims.forms.input.label for="dob" label="Date of Birth" star="*" />
                                    <x-lims.forms.input.date name="dob" id="dob" placeholder="Date of Birth"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer col-12">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
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

    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
