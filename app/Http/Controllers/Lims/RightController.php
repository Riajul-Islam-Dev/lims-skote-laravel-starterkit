<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\Right;
use Session;

class RightController extends Controller
{
    public function showRight()
    {
        $show_right_data = Right::all();

        return view('Lims/right/show_right', compact('show_right_data'));
    }

    public function addRight()
    {
        return view('Lims/right/add_right');
    }

    public function saveRight(Request $request)
    {
        $right = new Right();

        $right->right_name = $request->right_name;
        $right->right_code = $request->right_code;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $right->status = $request->status;

        $right->save();

        Session::flash('msg', 'Right Created successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect()->route('showRight');
    }

    public function editRight($id = null)
    {
        $edit_right_data = Right::find($id);
        return view('Lims/right/edit_right', compact('edit_right_data'));
    }

    public function updateRight(Request $request, $id)
    {
        $right = Right::find($id);

        $right->right_name = $request->right_name;
        $right->right_code = $request->right_code;

        if ($request->status == "on") {
            $request->status = "Active";
        } else {
            $request->status = "Inactive";
        }
        $right->status = $request->status;

        $right->save();

        Session::flash('msg', 'Right\'s Data updated successfully!');

        // return $request->all();
        // return redirect()->back();
        return redirect()->route('showRight');
    }

    public function deleteRight($id = null)
    {
        $delete_right_data = Right::find($id);
        $delete_right_data->delete();

        Session::flash('msg', 'Right\'s Data deleted successfully!');

        return redirect()->route('showRight');
    }
}
