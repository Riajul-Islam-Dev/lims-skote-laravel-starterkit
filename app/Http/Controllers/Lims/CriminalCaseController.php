<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\CriminalCase;
use Validator;


class CriminalCaseController extends Controller
{
    // Criminal Case data table page view
    public function showCriminalCase()
    {
        return view('Lims/Criminal_Case/show_criminal_case');
    }

    // Fetch all criminal cases ajax request
    public function fetchAllCriminalCase()
    {
        $show_criminal_case_data = CriminalCase::all();

        $output = '';
        if ($show_criminal_case_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Filed Case Name</th>
                    <th>Case Category</th>
                    <th>Court Name</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Region</th>
                    <th>Defendant Name</th>
                    <th>Plaintiff Name</th>
                    <th>Case Filling Date</th>
                    <th>Assigned Lawyer Name</th>
                    <th>Case Created By</th>
                    <th>Admin Approval</th>
                    <th>Document Status</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_criminal_case_data as $key => $data) {
                if ($data->admin_approval == 1) {
                    $data->admin_approval = "Approved";
                } else {
                    $data->admin_approval = "Not Approved";
                }
                if ($data->document_status == 1) {
                    $data->document_status = "Uploaded";
                } else {
                    $data->document_status = "Not Uploaded";
                }
                if ($data->status == 1) {
                    $data->status = "Active";
                } else {
                    $data->status = "Inactive";
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->filed_case_name . ' </td>
                <td>' . $data->case_category . '</td>
                <td>' . $data->court_name . '</td>
                <td>' . $data->division . '</td>
                <td>' . $data->district . '</td>
                <td>' . $data->region . '</td>
                <td>' . $data->defendant_name . '</td>
                <td>' . $data->plaintiff_name . '</td>
                <td>' . $data->case_filling_date . '</td>
                <td>' . $data->assigned_lawyer_name . '</td>
                <td>' . $data->case_created_by . '</td>
                <td>' . $data->admin_approval . '</td>
                <td>' . $data->document_status . '</td>
                <td>' . $data->status . '</td>
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

    // Save Criminal Case ajax request
    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filed_case_name' => ['required', 'string', 'max:255'],
            'case_category' => ['required', 'string', 'max:255'],
            'court_name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'defendant_name' => ['required', 'string', 'max:255'],
            'plaintiff_name' => ['required', 'string', 'max:255'],
            'case_filling_date' => ['required', 'date', 'before:today'],
            'assigned_lawyer_name' => ['required', 'string', 'max:255'],
            'case_created_by' => ['required', 'string', 'max:255'],
            'admin_approval' => ['required', 'string', 'max:255'],
            'document_status' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $criminal_case = new CriminalCase();

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
}
