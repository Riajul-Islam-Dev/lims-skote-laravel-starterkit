<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\Court;
use Validator;

class CourtController extends Controller
{
    // Court data table page view
    public function showCourt()
    {
        return view('Lims/court/show_court');
    }

    // Fetch all Courts ajax request
    public function fetchAllCourt()
    {
        $show_court_data = Court::all();

        $output = '';
        if ($show_court_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Court Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_court_data as $key => $data) {
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-info';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->court_name . ' </td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_court" data-bs-toggle="modal" data-bs-target="#editCourtModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_court"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Court ajax request
    public function saveCourt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'court_name' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $court = new Court();

            $court->court_name = $request->court_name;
            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $court->status = $request->status;

            $query = $court->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Court Details Saved successfully!",
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

    // handle edit an Court ajax request
    public function editCourt(Request $request)
    {
        $id = $request->id;
        $edit_court_data = Court::find($id);

        return response()->json($edit_court_data);
    }

    // update Court ajax request
    public function updateCourt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_court_name' => ['required', 'string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_court_id;
            $court_old_data = Court::find($id);

            $court_old_data->court_name = $request->e_court_name;
            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $court_old_data->status = $request->e_status;

            $query = $court_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Court Details Updated successfully!",
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

    // Delete Court ajax request
    public function deleteCourt(Request $request)
    {
        $id = $request->id;

        if (Court::destroy($id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Court deleted successfully!',
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
