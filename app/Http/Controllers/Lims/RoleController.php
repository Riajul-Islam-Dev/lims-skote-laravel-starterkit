<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lims\Role;
use App\Models\Lims\RoleSection;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Validator;

class RoleController extends Controller
{
    // Role data table page view
    public function indexRole()
    {
        $show_role_section_data = RoleSection::all();
        return view('Lims/role/show_role', compact("show_role_section_data"));
    }

    // Fetch all Roles ajax request
    public function fetchAllRole()
    {
        $show_role_data = Role::all();
        $show_role_section_data = RoleSection::all();

        $output = '';
        if ($show_role_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Role Section</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_role_data as $key => $data) {

                $role_section_name = 'Data not found';
                foreach ($show_role_section_data as $role_section_data) {
                    if ($role_section_data->id == $data->role_section) {
                        $role_section_name = $role_section_data->role_section_name;
                    }
                }

                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-success';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }

                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->role_name . ' </td>
                <td>' . $role_section_name . ' </td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-info waves-effect btn-label waves-light show_role" data-bs-toggle="modal" data-bs-target="#showRoleModal"><i class="bx bx-user-circle label-icon"></i> View</a>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_role" data-bs-toggle="modal" data-bs-target="#editRoleModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_role"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    
    // Save Role ajax request
    public function saveRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => ['required', 'string', 'max:255'],
            'role_section' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {
            $role = new Role();

            $role->role_name = $request->role_name;
            $role->role_section = $request->role_section;

            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $role->status = $request->status;

            $query = $role->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Role Saved successfully!",
                    'code' => 1
                ], 200); // Status code here
            } else {
                return response()->json([
                    'isSuccess' => false,
                    'Message' => "Something went wrong!",
                    'code' => 0
                ], 200); // Status code here
            }
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Please check the inputs!",
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ], 200); // Status code here
        }
    }

    // handle edit an Role ajax request
    public function editRole(Request $request)
    {
        $id = $request->id;
        $edit_role_data = Role::find($id);

        return response()->json($edit_role_data);
    }

    // update Role ajax request
    public function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_role_id' => ['required', 'string', 'max:255'],
            'e_role_name' => ['required', 'string', 'max:255'],
            'e_role_section' => ['required', 'string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_role_id;
            $role_old_data = Role::find($id);

            $role_old_data->role_name = $request->e_role_name;
            $role_old_data->role_section = $request->e_role_section;

            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $role_old_data->status = $request->e_status;

            $query = $role_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Role Details Updated successfully!",
                    'code' => 1
                ], 200); // Status code here
            } else {
                return response()->json([
                    'isSuccess' => false,
                    'Message' => "Something went wrong!",
                    'code' => 0
                ], 200); // Status code here
            }
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Please check the inputs!",
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ], 200); // Status code here
        }
    }

    // Delete Role ajax request
    public function deleteRole(Request $request)
    {
        $id = $request->id;
        $delete_role_data = Role::find($id);

        if (Role::destroy($id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Role deleted successfully!',
                'code' => 1
            ], 200); // Status code here
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => 'Something went wrong!',
                'code' => 0
            ], 200); // Status code here
        }
    }

    // Show Role ajax request
    public function showRole(Request $request)
    {
        $id = $request->id;
        $show_role_data = Role::find($id);

        $role_section_data = RoleSection::all();

        foreach($role_section_data as $role_section_data_individual){
            if($role_section_data_individual->id == $show_role_data->role_section){
                $show_role_data->role_section =  $role_section_data_individual->role_section_name;
            }
        }

        if ($show_role_data->status == 1) {
            $show_role_data->status = "Active";
        } else {
            $show_role_data->status = "Inactive";
        }

        return response()->json($show_role_data);
    }
}
