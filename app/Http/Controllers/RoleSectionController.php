<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleSection;
use App\Models\Department;
use Session;

class RoleSectionController extends Controller
{
    public function showRoleSection()
    {
        $show_role_section_data = RoleSection::all();
        $department_data = Department::all();
        // $show_role_section_data = RoleSection::paginate(3);
        // $show_role_section_data = RoleSection::simplePaginate(3);
        return view('role_section/show_role_section', compact('show_role_section_data', 'department_data'));
    }

    public function addRoleSection()
    {
        $department_data = Department::all();
        // $department_data = Department::pluck('department_name')->toArray();
        // dd($department_data);
        return view('role_section/add_role_section', compact('department_data'));
    }

    public function saveRoleSection(Request $request)
    {
        $role_section = new RoleSection();

        $role_section->role_section_name = $request->role_section_name;
        $role_section->department_name = $request->department_name;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $role_section->status = $request->status;

        $role_section->save();

        Session::flash('msg', 'Role Section Created successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_role_section');
    }

    public function editRoleSection($id = null)
    {
        $edit_role_section_data = RoleSection::find($id);
        // $department_data = Department::pluck('department_name')->toArray();
        $department_data = Department::all();

        return view('role_section/edit_role_section', compact('edit_role_section_data', 'department_data'));
    }

    public function updateRoleSection(Request $request, $id)
    {
        $role_section = RoleSection::find($id);

        $role_section->role_section_name = $request->role_section_name;
        $role_section->department_name = $request->department_name;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $role_section->status = $request->status;

        $role_section->save();

        Session::flash('msg', 'Role Section\'s Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect('/show_role_section');
    }

    public function deleteRoleSection($id = null)
    {
        $delete_role_section_data = RoleSection::find($id);
        $delete_role_section_data->delete();

        Session::flash('msg', 'Role Section\'s Data deleted successfully!');

        return redirect('/show_role_section');
    }
}
