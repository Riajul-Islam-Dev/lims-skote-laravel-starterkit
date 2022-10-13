@extends('layouts.master')

@section('title')
    Show User
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
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
                        {{-- <a href="{{ url('/add_user') }}" class="btn btn-success my-3"><i
                                class="fa-solid fa-circle-plus"></i> Add new User</a> --}}

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
                    <h6 class="mt-2 ms-3">Please fill up the new User form carefully. Fields marked with <span
                            style="color: red">*</span>
                        are required.</h6>
                    <div class="modal-body">
                        <form id="create_user_form" action="javascript:void(0)">
                            @csrf
                            <div class="row my-2">
                                <div class="col-6 test">
                                    <x-lims.forms.input.label for="name" label="User Name" star="*" />
                                    <x-lims.forms.input.text name="name" id="name" placeholder="User Name"
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
                                    <x-lims.forms.input.label for="user_password" label="Password" star="*" />
                                    <x-lims.forms.input.password name="user_password" id="user_password"
                                        placeholder="Password" required />
                                </div>
                                <div class="col-6">
                                    <x-lims.forms.input.label for="dob" label="Date of Birth" star="*" />
                                    <x-lims.forms.input.date name="dob" id="dob" placeholder="Date of Birth"
                                        required />
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-6">
                                    <x-lims.forms.input.label for="avatar" label="Upload Avatar" star="*" />
                                    <x-lims.forms.input.file name="avatar" id="avatar" placeholder="Upload Avatar"
                                        required />
                                </div>
                                <div class="col-6">
                                    <x-lims.forms.input.label for="status" label="Status" star="*" />
                                    <x-lims.forms.input.toggle name="status" id="status" required />
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn_create" onclick="create_user_info()">
                                Create User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Toast message --}}
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 7000">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                    <strong class="me-auto"><i class="fas fa-info-circle"></i> Caution</strong>
                    <small>Just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toast-body">
                    Hello, world! This is a toast message.
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

        <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

        <script>
            var toastLiveExample = document.getElementById('liveToast')

            function create_user_info() {
                var name = $("#name").val();
                var email = $("#email").val();
                var password = $("#user_password").val();
                var dob = $("#dob").val();
                var avatar = $("#avatar").val();
                var status = $("#status").val();
                // alert(name);
                // alert(email);
                // alert(password);
                // alert(dob);
                // alert(avatar);
                // alert(status);
                if (name == "") {
                    var toast = new bootstrap.Toast(toastLiveExample);
                    document.getElementById("toast-body").innerHTML = "Name can't be empty.";
                    toast.show();
                    document.getElementById("name").style.border = "solid 1px red";
                    setTimeout(changeBorder, 3000);

                    function changeBorder() {
                        document.getElementById("name").style.border = "solid 1px rgb(206,212,218)";
                    }
                    $("#name").focus();
                    return false;
                } else if (email == "") {
                    var toast = new bootstrap.Toast(toastLiveExample);
                    document.getElementById("toast-body").innerHTML = "Email can't be empty.";
                    toast.show();
                    document.getElementById("email").style.border = "solid 1px red";
                    setTimeout(changeBorder, 3000);

                    function changeBorder() {
                        document.getElementById("email").style.border = "solid 1px rgb(206,212,218)";
                    }
                    $("#email").focus();
                    return false;
                } else if (password == "") {
                    var toast = new bootstrap.Toast(toastLiveExample);
                    document.getElementById("toast-body").innerHTML = "Password can't be empty.";
                    toast.show();
                    document.getElementById("user_password").style.border = "solid 1px red";
                    setTimeout(changeBorder, 3000);

                    function changeBorder() {
                        document.getElementById("user_password").style.border = "solid 1px rgb(206,212,218)";
                    }
                    $("#user_password").focus();
                    return false;
                } else if (dob == "") {
                    var toast = new bootstrap.Toast(toastLiveExample);
                    document.getElementById("toast-body").innerHTML = "Date of Birth can't be empty.";
                    toast.show();
                    document.getElementById("dob").style.border = "solid 1px red";
                    setTimeout(changeBorder, 3000);

                    function changeBorder() {
                        document.getElementById("dob").style.border = "solid 1px rgb(206,212,218)";
                    }
                    $("#dob").focus();
                    return false;
                } else if (avatar == "") {
                    var toast = new bootstrap.Toast(toastLiveExample);
                    document.getElementById("toast-body").innerHTML = "Avatar can't be empty.";
                    toast.show();
                    document.getElementById("avatar").style.border = "solid 1px red";
                    setTimeout(changeBorder, 3000);

                    function changeBorder() {
                        document.getElementById("avatar").style.border = "solid 1px rgb(206,212,218)";
                    }
                    $("#avatar").focus();
                    return false;
                }
            }
        </script>
    @endsection
