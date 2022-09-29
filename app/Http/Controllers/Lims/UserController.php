<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\User;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    public function showUser()
    {
        $show_user_data = User::all();
        // $show_user_data = User::paginate(3);
        // $show_user_data = User::simplePaginate(3);
        return view('user/show_user', compact('show_user_data'));
    }

    public function addUser()
    {
        return view('user/add_user');
    }

    public function saveUser(Request $request)
    {
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }

        $user = new User();

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
        // $user->status = $request->status;

        $user->save();

        Session::flash('msg', 'User Created successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_user');
    }

    public function editUser($id = null)
    {
        $edit_user_data = User::find($id);
        return view('user/edit_user', compact('edit_user_data'));
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
        return redirect('/show_user');
    }

    public function deleteUser($id = null)
    {
        $delete_user_data = User::find($id);
        $delete_user_data->delete();

        Session::flash('msg', 'User\'s Data deleted successfully!');

        return redirect('/show_user');
    }
}
