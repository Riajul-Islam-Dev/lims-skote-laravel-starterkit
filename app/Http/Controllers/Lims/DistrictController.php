<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\District;
use Validator;

class DistrictController extends Controller
{
    // District data table page view
    public function showDistrict()
    {
        return view('Lims/district/show_district');
    }

    // Fetch all Districts ajax request
    public function fetchAllDistrict()
    {
        $show_district_data = District::all();

        $output = '';
        if ($show_district_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>District Name</th>
                    <th>District Code</th>
                    <th>Division Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_district_data as $key => $data) {
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-info';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->district_name . ' </td>
                <td>' . $data->district_code . ' </td>
                <td>' . $data->division_name . ' </td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_district" data-bs-toggle="modal" data-bs-target="#editDistrictModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_district"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save District ajax request
    public function saveDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_name' => ['required', 'string', 'max:255'],
            'district_code' => ['required', 'string', 'max:255'],
            'division_name' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $district = new District();

            $district->district_name = $request->district_name;
            $district->district_code = $request->district_code;
            $district->division_name = $request->division_name;
            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $district->status = $request->status;

            $query = $district->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "District Details Saved successfully!",
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

    // handle edit an District ajax request
    public function editDistrict(Request $request)
    {
        $id = $request->id;
        $edit_district_data = District::find($id);

        return response()->json($edit_district_data);
    }

    // update District ajax request
    public function updateDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_district_name' => ['required', 'string', 'max:255'],
            'e_district_code' => ['required', 'string', 'max:255'],
            'e_division_name' => ['required', 'string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_district_id;
            $district_old_data = District::find($id);

            $district_old_data->district_name = $request->e_district_name;
            $district_old_data->district_code = $request->e_district_code;
            $district_old_data->division_name = $request->e_division_name;
            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $district_old_data->status = $request->e_status;

            $query = $district_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "District Details Updated successfully!",
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

    // Delete District ajax request
    public function deleteDistrict(Request $request)
    {
        $id = $request->id;

        if (District::destroy($id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'District deleted successfully!',
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
