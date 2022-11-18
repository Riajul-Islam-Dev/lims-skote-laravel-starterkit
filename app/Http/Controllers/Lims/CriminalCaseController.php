<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\CriminalCaseLog;
use App\Models\Lims\CriminalCase;
use Validator;
use Illuminate\Support\Facades\Auth;

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
                    <th>Complainant Name</th>
                    <th>Accused Name</th>
                    <th>Case Filling Date</th>
                    <th>Assigned Lawyer Name</th>
                    <th>Case Created By</th>
                    <th>Case Updated By</th>
                    <th>Admin Approval</th>
                    <th>Document Status</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_criminal_case_data as $key => $data) {
                if (CriminalCaseLog::where('case_id', $data->id)->exists()) {
                    $data_log = CriminalCaseLog::where('case_id', '=', $data->id)->orderBy('updated_at', 'desc')->first();

                    $data = $data_log;
                    $data->id = $data->case_id;
                } else {
                    $data->case_updated_by = "N/A";
                }
                if ($data->admin_approval == 1) {
                    $data->admin_approval = "Approved";
                    $admin_approval_badge_class = 'badge bg-info';
                } else {
                    $data->admin_approval = "Not Approved";
                    $admin_approval_badge_class = 'badge bg-danger';
                }
                if ($data->document_status == 1) {
                    $data->document_status = "Uploaded";
                    $document_status_badge_class = 'badge bg-info';
                } else {
                    $data->document_status = "Not Uploaded";
                    $document_status_badge_class = 'badge bg-danger';
                }
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-info';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }
                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->filed_case_name . ' </td>
                <td>' . $data->case_category . '</td>
                <td>' . $data->court_name . '</td>
                <td>' . $data->division . '</td>
                <td>' . $data->district . '</td>
                <td>' . $data->region . '</td>
                <td>' . $data->complainant_name . '</td>
                <td>' . $data->accused_name . '</td>
                <td>' . $data->case_filling_date . '</td>
                <td>' . $data->assigned_lawyer_name . '</td>
                <td>' . $data->case_created_by . '</td>
                <td>' . $data->case_updated_by . '</td>
                <td><div class="' . $admin_approval_badge_class . '">' . $data->admin_approval . '</div></td>
                <td><div class="' . $document_status_badge_class . '">' . $data->document_status . '</div></td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_criminal_case" data-bs-toggle="modal" data-bs-target="#editCriminalCaseModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_criminal_case"><i class="bx bx-trash label-icon"></i> Delete</a>
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
    public function saveCriminalCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filed_case_name' => ['required', 'string', 'max:255'],
            'case_category' => ['required', 'string', 'max:255'],
            'court_name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'complainant_name' => ['required', 'string', 'max:255'],
            'accused_name' => ['required', 'string', 'max:255'],
            'case_filling_date' => ['required', 'date', 'before:today'],
            'assigned_lawyer_name' => ['required', 'string', 'max:255'],
            // 'admin_approval' => ['required', 'string', 'max:255'],
            // 'document_status' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $criminal_case = new CriminalCase();

            $criminal_case->filed_case_name = $request->filed_case_name;
            $criminal_case->case_category = $request->case_category;
            $criminal_case->court_name = $request->court_name;
            $criminal_case->division = $request->division;
            $criminal_case->district = $request->district;
            $criminal_case->region = $request->region;
            $criminal_case->complainant_name = $request->complainant_name;
            $criminal_case->accused_name = $request->accused_name;
            $criminal_case->case_filling_date = date('Y-m-d', strtotime($request->case_filling_date));
            $criminal_case->assigned_lawyer_name = $request->assigned_lawyer_name;
            $criminal_case->case_created_by = Auth::user()->id;
            if ($request->admin_approval == "on") {
                $request->admin_approval = "1";
            } else {
                $request->admin_approval = "0";
            }
            $criminal_case->admin_approval = $request->admin_approval;
            if ($request->document_status == "on") {
                $request->document_status = "1";
            } else {
                $request->document_status = "0";
            }
            $criminal_case->document_status = $request->document_status;
            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $criminal_case->status = $request->status;

            $query = $criminal_case->save();

            if ($query) {
                $criminal_case_log = new CriminalCaseLog();
                $criminal_case_log->case_id = $criminal_case->id;
                $criminal_case_log->id = null;

                $criminal_case_log->filed_case_name = $criminal_case->filed_case_name;
                $criminal_case_log->case_category = $criminal_case->case_category;
                $criminal_case_log->court_name = $criminal_case->court_name;
                $criminal_case_log->division = $criminal_case->division;
                $criminal_case_log->district = $criminal_case->district;
                $criminal_case_log->region = $criminal_case->region;
                $criminal_case_log->complainant_name = $request->complainant_name;
                $criminal_case_log->accused_name = $request->accused_name;
                $criminal_case_log->case_filling_date = $criminal_case->case_filling_date;
                $criminal_case_log->assigned_lawyer_name = $criminal_case->assigned_lawyer_name;
                $criminal_case_log->case_created_by = $criminal_case->case_created_by;
                $criminal_case_log->case_updated_by = "N/A";
                $criminal_case_log->admin_approval = $criminal_case->admin_approval;
                $criminal_case_log->document_status = $criminal_case->document_status;
                $criminal_case_log->status = $criminal_case->status;

                $criminal_case_log->save();

                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Criminal Case Details Saved successfully!",
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

    // handle edit an Criminal Case ajax request
    public function editCriminalCase(Request $request)
    {
        $id = $request->id;

        if (CriminalCaseLog::where('case_id', $id)->exists()) {
            $edit_criminal_case_data = CriminalCaseLog::where('case_id', '=', $id)->orderBy('updated_at', 'desc')->first();
        } else {
            $edit_criminal_case_data = CriminalCase::find($id);
            $edit_criminal_case_data->case_updated_by = "N/A";
        }

        return response()->json($edit_criminal_case_data);
    }

    // update Criminal Case ajax request
    public function updateCriminalCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_filed_case_name' => ['required', 'string', 'max:255'],
            'e_case_category' => ['required', 'string', 'max:255'],
            'e_court_name' => ['required', 'string', 'max:255'],
            'e_division' => ['required', 'string', 'max:255'],
            'e_district' => ['required', 'string', 'max:255'],
            'e_region' => ['required', 'string', 'max:255'],
            'e_complainant_name' => ['required', 'string', 'max:255'],
            'e_accused_name' => ['required', 'string', 'max:255'],
            'e_case_filling_date' => ['required', 'date', 'before:today'],
            'e_assigned_lawyer_name' => ['required', 'string', 'max:255'],
            // 'e_admin_approval' => ['string', 'max:255'],
            // 'e_document_status' => ['string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $criminal_case_old_data = new CriminalCaseLog();

            $criminal_case_old_data->case_id = $request->e_criminal_case_id;
            $criminal_case_old_data->filed_case_name = $request->e_filed_case_name;
            $criminal_case_old_data->case_category = $request->e_case_category;
            $criminal_case_old_data->court_name = $request->e_court_name;
            $criminal_case_old_data->division = $request->e_division;
            $criminal_case_old_data->district = $request->e_district;
            $criminal_case_old_data->region = $request->e_region;
            $criminal_case_old_data->complainant_name = $request->e_complainant_name;
            $criminal_case_old_data->accused_name = $request->e_accused_name;
            $criminal_case_old_data->case_filling_date = date('Y-m-d', strtotime($request->e_case_filling_date));
            $criminal_case_old_data->assigned_lawyer_name = $request->e_assigned_lawyer_name;
            $criminal_case_old_data->case_created_by = $request->e_case_created_by;
            $criminal_case_old_data->case_updated_by = Auth::user()->id;
            if ($request->e_admin_approval == "on") {
                $request->e_admin_approval = "1";
            } else {
                $request->e_admin_approval = "0";
            }
            $criminal_case_old_data->admin_approval = $request->e_admin_approval;
            if ($request->e_document_status == "on") {
                $request->e_document_status = "1";
            } else {
                $request->e_document_status = "0";
            }
            $criminal_case_old_data->document_status = $request->e_document_status;
            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $criminal_case_old_data->status = $request->e_status;

            $query = $criminal_case_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Criminal Case Details Updated successfully!",
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

    // Delete Criminal Case ajax request
    public function deleteCriminalCase(Request $request)
    {
        $id = $request->id;

        if (CriminalCase::destroy($id)) {
            if (CriminalCaseLog::where('case_id', $id)->exists()) {
                $criminal_case_log_data = CriminalCaseLog::where('case_id', $id)->orderBy('updated_at', 'desc')->first();

                $criminal_case_log = new CriminalCaseLog();
                $criminal_case_log->id = null;

                $criminal_case_log->case_id = $criminal_case_log_data->case_id;
                $criminal_case_log->filed_case_name = $criminal_case_log_data->filed_case_name;
                $criminal_case_log->case_category = $criminal_case_log_data->case_category;
                $criminal_case_log->court_name = $criminal_case_log_data->court_name;
                $criminal_case_log->division = $criminal_case_log_data->division;
                $criminal_case_log->district = $criminal_case_log_data->district;
                $criminal_case_log->region = $criminal_case_log_data->region;
                $criminal_case_log->complainant_name = $criminal_case_log_data->complainant_name;
                $criminal_case_log->accused_name = $criminal_case_log_data->accused_name;
                $criminal_case_log->case_filling_date = $criminal_case_log_data->case_filling_date;
                $criminal_case_log->assigned_lawyer_name = $criminal_case_log_data->assigned_lawyer_name;
                $criminal_case_log->case_created_by = $criminal_case_log_data->case_created_by;
                $criminal_case_log->case_updated_by = Auth::user()->id;
                $criminal_case_log->admin_approval = $criminal_case_log_data->admin_approval;
                $criminal_case_log->document_status = $criminal_case_log_data->document_status;
                $criminal_case_log->status = -1;

                $criminal_case_log->save();
            }

            return response()->json([
                'isSuccess' => true,
                'Message' => 'Criminal Case deleted successfully!',
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
