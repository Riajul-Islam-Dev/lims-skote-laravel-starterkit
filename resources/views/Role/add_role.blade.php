@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url('/show_role') }}" class="btn btn-primary my-3"><i class="fa-solid fa-table-list"></i> Show
            Role</a>

        <h1>Create Role</h1>

        <form action="{{ url('/save_role') }}" method="POST">
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
                <label for="role_name" class="form-label">Role Name</label>
                <input type="text" class="form-control" id="role_name" name="role_name">
                @error('role_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role_section" class="form-label">Role Section</label>
                <select class="form-select" aria-label="Default select example" id="role_section" name="role_section">
                    <option selected disabled>Select Role Section</option>
                    <option value="Management">Management</option>
                    <option value="Development">Development</option>
                    <option value="SQA">SQA</option>
                </select>
                @error('role_section')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role_access_level" class="form-label">Role Access Level</label>
                <select class="form-select" aria-label="Default select example" id="role_access_level"
                    name="role_access_level">
                    <option selected disabled>Select Role Access Level</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Manager">Manager</option>
                    <option value="Leader">Leader</option>
                    <option value="Senior">Senior</option>
                    <option value="Junior">Junior</option>
                    <option value="Intern">Intern</option>
                </select>
                @error('role_access_level')
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
