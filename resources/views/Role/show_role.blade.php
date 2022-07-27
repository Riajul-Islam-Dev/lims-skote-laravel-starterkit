@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/add_role') }}" class="btn btn-success my-3"><i class="fa-solid fa-circle-plus"></i> Add
            Role</a>

        <h1>Show Role</h1>

        @if (Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Role Name</th>
                    <th scope="col">Role Section</th>
                    <th scope="col">Role Access Level</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($show_role_data as $key => $data)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $data->role_name }}</td>
                        <td>{{ $data->role_section }}</td>
                        <td>{{ $data->role_access_level }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ url('/edit_role/' . $data->id) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="{{ url('/delete_role/' . $data->id) }}" class="btn btn-danger"
                                onclick="return confirm('Delete Role?')"><i class="fa-solid fa-trash-can"></i>
                                Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $show_role_data->links() }}
    </div>
@endsection
