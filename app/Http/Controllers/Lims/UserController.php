<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;


class UserController extends Controller
{
    public function showUser()
    {
        $show_user_data = User::all();
        // $show_user_data = User::paginate(3);
        // $show_user_data = User::simplePaginate(3);
        return view('Lims/user/show_user', compact('show_user_data'));
    }

    public function fetchAllUser()
    {
        $show_user_data = User::all();

        $output = '';
        if ($show_user_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
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
                <td>' . $status_var . '</td>
                <td>
                <a href="/edit_user/' . $data->id . '" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <a href="#" id="test" class="btn btn-danger delete_user" data-id="' . $data->id . '"><i class="fa-solid fa-trash-can"></i> Delete</a>
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

    public function editUser($id = null)
    {
        $edit_user_data = User::find($id);
        return view('Lims/user/edit_user', compact('edit_user_data'));
    }

    public function updateUser(Request $request, $id)
    {
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }

        $user = User::find($id);


        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $user->avatar = "/images/" . $avatarName;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }

        $user->save();

        Session::flash('msg', 'User\'s Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect()->route('showUser');
    }

    public function deleteUser($id = null)
    {
        $delete_user_data = User::find($id);

        if ($delete_user_data->delete()) {
            Session::flash('message', 'User deleted successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => 'User deleted successfully!',
                'deleteStatus' => 1
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Something went wrong',
                'deleteStatus' => 0
            ], 200); // Status code here
        }
    }
}
