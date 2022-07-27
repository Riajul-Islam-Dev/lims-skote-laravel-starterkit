@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/add_user') }}" class="btn btn-success my-3"><i class="fa-solid fa-circle-plus"></i> Add
            User</a>

        <h1>Show User</h1>

        @if (Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($show_user_data as $key => $data)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        {{-- <td>{{ $data->status }}</td> --}}
                        <td>Status pending</td>
                        <td>
                            <a href="{{ url('/edit_user/' . $data->id) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="{{ url('/delete_user/' . $data->id) }}" class="btn btn-danger"
                                onclick="return confirm('Delete User?')"><i class="fa-solid fa-trash-can"></i>
                                Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $show_user_data->links() }}
    </div>
@endsection
