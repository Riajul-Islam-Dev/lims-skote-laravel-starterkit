<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\Department;
use Session;

class DepartmentController extends Controller
{
    public function showDepartment()
    {
        $show_department_data = Department::all();
        // $show_department_data = Department::paginate(3);
        // $show_department_data = Department::simplePaginate(3);
        return view('Lims/department/show_department', compact('show_department_data'));
    }

    public function addDepartment()
    {
        return view('Lims/department/add_department');
    }

    public function saveDepartment(Request $request)
    {
        $department = new Department();

        $department->department_name = $request->department_name;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $department->status = $request->status;

        $department->save();

        Session::flash('msg', 'Department Created successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect()->route('showDepartment');
    }

    public function editDepartment($id = null)
    {
        $edit_department_data = Department::find($id);
        return view('Lims/department/edit_department', compact('edit_department_data'));
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::find($id);

        $department->department_name = $request->department_name;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $department->status = $request->status;

        $department->save();

        Session::flash('msg', 'Department\'s Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect()->route('showDepartment');
    }

    public function deleteDepartment($id = null)
    {
        $delete_department_data = Department::find($id);
        $delete_department_data->delete();

        Session::flash('msg', 'Department\'s Data deleted successfully!');

        return redirect()->route('showDepartment');
    }
}
