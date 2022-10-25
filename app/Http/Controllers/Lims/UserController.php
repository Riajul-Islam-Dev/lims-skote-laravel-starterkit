<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Validator;


class UserController extends Controller
{
    public function showUser()
    {
        return view('Lims/user/show_user');
    }

    public function fetchAllUser()
    {
        $show_user_data = User::all();

        $output = '';
        if ($show_user_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Date of Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_user_data as $key => $data) {
                if ($data->status == 1) {
                    $status_var = "Active";
                } else {
                    $status_var = "Inactive";
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->name . ' </td>
                <td>' . $data->email . '</td>
                <td>' . $data->dob . '</td>
                <td>' . $status_var . '</td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_user" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_user"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function addUser()
    {
        return view('Lims/user/add_user');
    }

    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_password' => ['required', 'string', 'min:6'],
            'dob' => ['required', 'date', 'before:today'],
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {
            $avatar = $request->avatar;
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->user_password);
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->avatar = "/images/" . $avatarName;

            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $user->status = $request->status;

            $query = $user->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "User Details Saved successfully!",
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

    // handle edit an user ajax request
    public function editUser(Request $request)
    {
        $id = $request->id;
        $edit_user_data = User::find($id);
        // $edit_user_data_pass = $edit_user_data->password;
        // $edit_user_data->test = $edit_user_data_pass;
        return response()->json($edit_user_data);
    }

    // update user ajax request
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_name' => ['required', 'string', 'max:255'],
            'e_email' => ['required', 'string', 'email', 'max:255'],
            'e_user_password' => ['nullable', 'string', 'min:6'],
            'e_dob' => ['required', 'date', 'before:today'],
            'e_avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_user_id;
            $user_old_data = User::find($id);

            if (!empty($request->e_avatar)) {
                $image_path = public_path() . $user_old_data->avatar;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $avatar = $request->e_avatar;
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/images/');
                $avatar->move($avatarPath, $avatarName);
                $user_old_data->avatar = "/images/" . $avatarName;
            }

            if (!empty($request->e_user_password)) {
                $user_old_data->password = Hash::make($request->e_user_password);
            }

            $user_old_data->name = $request->e_name;
            $user_old_data->email = $request->e_email;
            $user_old_data->dob = date('Y-m-d', strtotime($request->e_dob));

            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $user_old_data->status = $request->e_status;

            $query = $user_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "User Details Updated successfully!",
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

    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $delete_user_data = User::find($id);

        $image_path = public_path() . $delete_user_data->avatar;  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            if (File::delete($image_path)) {
                User::destroy($id);
                return response()->json([
                    'isSuccess' => true,
                    'Message' => 'User deleted successfully!',
                    'code' => 1
                ], 200); // Status code here
            } else {
                return response()->json([
                    'isSuccess' => false,
                    'Message' => 'Something went wrong!',
                    'code' => 0
                ], 200); // Status code here
            }
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => 'No Avatar found!',
                'code' => 0
            ], 200); // Status code here
        }
    }
}
