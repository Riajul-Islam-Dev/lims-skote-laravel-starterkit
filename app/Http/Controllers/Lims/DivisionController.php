<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\Division;
use Validator;

class DivisionController extends Controller
{
    // Division data table page view
    public function showDivision()
    {
        return view('Lims/division/show_division');
    }

    // Fetch all Divisions ajax request
    public function fetchAllDivision()
    {
        $show_division_data = Division::all();

        $output = '';
        if ($show_division_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Division Name</th>
                    <th>Division Code</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_division_data as $key => $data) {
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-info';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->division_name . ' </td>
                <td>' . $data->division_code . ' </td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_division" data-bs-toggle="modal" data-bs-target="#editDivisionModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_division"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Division ajax request
    public function saveDivision(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division_name' => ['required', 'string', 'max:255'],
            'division_code' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $division = new Division();

            $division->division_name = $request->division_name;
            $division->division_code = $request->division_code;
            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $division->status = $request->status;

            $query = $division->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Division Details Saved successfully!",
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

    // handle edit an Division ajax request
    public function editDivision(Request $request)
    {
        $id = $request->id;
        $edit_division_data = Division::find($id);

        return response()->json($edit_division_data);
    }

    // update Division ajax request
    public function updateDivision(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_division_name' => ['required', 'string', 'max:255'],
            'e_division_code' => ['required', 'string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_division_id;
            $division_old_data = Division::find($id);

            $division_old_data->division_name = $request->e_division_name;
            $division_old_data->division_code = $request->e_division_code;
            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $division_old_data->status = $request->e_status;

            $query = $division_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Division Details Updated successfully!",
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

    // Delete Division ajax request
    public function deleteDivision(Request $request)
    {
        $id = $request->id;

        if (Division::destroy($id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Division deleted successfully!',
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
}
