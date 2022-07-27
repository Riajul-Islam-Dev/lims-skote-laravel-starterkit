@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/show_right') }}" class="btn btn-primary my-3"><i class="fa-solid fa-table-list"></i> Show
            Right</a>

        <h1>Create Right</h1>

        <form action="{{ url('/save_right') }}" method="POST">
            @csrf

            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <!-- Create Post Form -->

            <div class="mb-3">
                <label for="right_name" class="form-label">Right Name</label>
                <input type="text" class="form-control" id="right_name" name="right_name">
                @error('right_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="right_code" class="form-label">Right Code</label>
                <input type="text" class="form-control" id="right_code" name="right_code">
                @error('right_code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" aria-label="Default select example" id="status" name="status">
                    <option selected disabled>Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary" value="submit">Submit</button>
        </form>
    </div>
@endsection
