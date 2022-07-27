@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/add_right') }}" class="btn btn-success my-3"><i class="fa-solid fa-circle-plus"></i> Add
            Right</a>

        <h1>Show Right</h1>

        @if (Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Right Name</th>
                    <th scope="col">Right Code</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($show_right_data as $key => $data)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $data->right_name }}</td>
                        <td>{{ $data->right_code }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ url('/edit_right/' . $data->id) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="{{ url('/delete_right/' . $data->id) }}" class="btn btn-danger"
                                onclick="return confirm('Delete Right?')"><i class="fa-solid fa-trash-can"></i>
                                Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $show_right_data->links() }}
    </div>
@endsection
