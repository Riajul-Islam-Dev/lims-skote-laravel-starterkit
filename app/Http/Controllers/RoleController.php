<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Session;

class RoleController extends Controller
{
    public function showRole()
    {
        $show_role_data = Role::all();
        // $show_role_data = Role::paginate(3);
        // $show_role_data = Role::simplePaginate(3);
        return view('role/show_role', compact('show_role_data'));
    }

    public function addRole()
    {
        return view('role/add_role');
    }

    public function saveRole(Request $request)
    {
        $role = new Role();

        $role->role_name = $request->role_name;
        $role->role_section = $request->role_section;
        $role->role_access_level = $request->role_access_level;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $role->status = $request->status;

        $role->save();

        Session::flash('msg', 'Role Created successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_role');
    }

    public function editRole($id = null)
    {
        $edit_role_data = Role::find($id);
        return view('role/edit_role', compact('edit_role_data'));
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::find($id);

        $role->role_name = $request->role_name;
        $role->role_section = $request->role_section;
        $role->role_access_level = $request->role_access_level;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $role->status = $request->status;

        $role->save();

        Session::flash('msg', 'Role\'s Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_role');
    }

    public function deleteRole($id = null)
    {
        $delete_role_data = Role::find($id);
        $delete_role_data->delete();

        Session::flash('msg', 'Role\'s Data deleted successfully!');

        return redirect('/show_role');
    }
}
