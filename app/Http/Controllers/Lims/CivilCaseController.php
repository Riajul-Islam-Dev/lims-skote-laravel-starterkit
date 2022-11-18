<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\CivilCaseLog;
use App\Models\Lims\CivilCase;
use Validator;
use Illuminate\Support\Facades\Auth;

class CivilCaseController extends Controller
{
    // Civil Case data table page view
    public function showCivilCase()
    {
        return view('Lims/Civil_Case/show_civil_case');
    }

    // Fetch all civil cases ajax request
    public function fetchAllCivilCase()
    {
        $show_civil_case_data = CivilCase::all();

        $output = '';
        if ($show_civil_case_data->count() > 0) {
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
                    <th>Plaintiff Name</th>
                    <th>Defendant Name</th>
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
            foreach ($show_civil_case_data as $key => $data) {
                if (CivilCaseLog::where('case_id', $data->id)->exists()) {
                    $data_log = CivilCaseLog::where('case_id', '=', $data->id)->orderBy('updated_at', 'desc')->first();

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
                <td>' . $data->plaintiff_name . '</td>
                <td>' . $data->defendant_name . '</td>
                <td>' . $data->case_filling_date . '</td>
                <td>' . $data->assigned_lawyer_name . '</td>
                <td>' . $data->case_created_by . '</td>
                <td>' . $data->case_updated_by . '</td>
                <td><div class="' . $admin_approval_badge_class . '">' . $data->admin_approval . '</div></td>
                <td><div class="' . $document_status_badge_class . '">' . $data->document_status . '</div></td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_civil_case" data-bs-toggle="modal" data-bs-target="#editCivilCaseModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_civil_case"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Civil Case ajax request
    public function saveCivilCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filed_case_name' => ['required', 'string', 'max:255'],
            'case_category' => ['required', 'string', 'max:255'],
            'court_name' => ['required', 'string', 'max:255'],
            'division' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'plaintiff_name' => ['required', 'string', 'max:255'],
            'defendant_name' => ['required', 'string', 'max:255'],
            'case_filling_date' => ['required', 'date', 'before:today'],
            'assigned_lawyer_name' => ['required', 'string', 'max:255'],
            // 'admin_approval' => ['required', 'string', 'max:255'],
            // 'document_status' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            $civil_case = new CivilCase();

            $civil_case->filed_case_name = $request->filed_case_name;
            $civil_case->case_category = $request->case_category;
            $civil_case->court_name = $request->court_name;
            $civil_case->division = $request->division;
            $civil_case->district = $request->district;
            $civil_case->region = $request->region;
            $civil_case->plaintiff_name = $request->plaintiff_name;
            $civil_case->defendant_name = $request->defendant_name;
            $civil_case->case_filling_date = date('Y-m-d', strtotime($request->case_filling_date));
            $civil_case->assigned_lawyer_name = $request->assigned_lawyer_name;
            $civil_case->case_created_by = Auth::user()->id;
            if ($request->admin_approval == "on") {
                $request->admin_approval = "1";
            } else {
                $request->admin_approval = "0";
            }
            $civil_case->admin_approval = $request->admin_approval;
            if ($request->document_status == "on") {
                $request->document_status = "1";
            } else {
                $request->document_status = "0";
            }
            $civil_case->document_status = $request->document_status;
            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $civil_case->status = $request->status;

            $query = $civil_case->save();

            if ($query) {
                $civil_case_log = new CivilCaseLog();
                $civil_case_log->case_id = $civil_case->id;
                $civil_case_log->id = null;

                $civil_case_log->filed_case_name = $civil_case->filed_case_name;
                $civil_case_log->case_category = $civil_case->case_category;
                $civil_case_log->court_name = $civil_case->court_name;
                $civil_case_log->division = $civil_case->division;
                $civil_case_log->district = $civil_case->district;
                $civil_case_log->region = $civil_case->region;
                $civil_case_log->plaintiff_name = $civil_case->plaintiff_name;
                $civil_case_log->defendant_name = $civil_case->defendant_name;
                $civil_case_log->case_filling_date = $civil_case->case_filling_date;
                $civil_case_log->assigned_lawyer_name = $civil_case->assigned_lawyer_name;
                $civil_case_log->case_created_by = $civil_case->case_created_by;
                $civil_case_log->case_updated_by = "N/A";
                $civil_case_log->admin_approval = $civil_case->admin_approval;
                $civil_case_log->document_status = $civil_case->document_status;
                $civil_case_log->status = $civil_case->status;

                $civil_case_log->save();

                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Civil Case Details Saved successfully!",
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

    // handle edit an Civil Case ajax request
    public function editCivilCase(Request $request)
    {
        $id = $request->id;

        if (CivilCaseLog::where('case_id', $id)->exists()) {
            $edit_civil_case_data = CivilCaseLog::where('case_id', '=', $id)->orderBy('updated_at', 'desc')->first();
        } else {
            $edit_civil_case_data = CivilCase::find($id);
            $edit_civil_case_data->case_updated_by = "N/A";
        }

        return response()->json($edit_civil_case_data);
    }

    // update Civil Case ajax request
    public function updateCivilCase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_filed_case_name' => ['required', 'string', 'max:255'],
            'e_case_category' => ['required', 'string', 'max:255'],
            'e_court_name' => ['required', 'string', 'max:255'],
            'e_division' => ['required', 'string', 'max:255'],
            'e_district' => ['required', 'string', 'max:255'],
            'e_region' => ['required', 'string', 'max:255'],
            'e_plaintiff_name' => ['required', 'string', 'max:255'],
            'e_defendant_name' => ['required', 'string', 'max:255'],
            'e_case_filling_date' => ['required', 'date', 'before:today'],
            'e_assigned_lawyer_name' => ['required', 'string', 'max:255'],
            // 'e_admin_approval' => ['string', 'max:255'],
            // 'e_document_status' => ['string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $civil_case_old_data = new CivilCaseLog();

            $civil_case_old_data->case_id = $request->e_civil_case_id;
            $civil_case_old_data->filed_case_name = $request->e_filed_case_name;
            $civil_case_old_data->case_category = $request->e_case_category;
            $civil_case_old_data->court_name = $request->e_court_name;
            $civil_case_old_data->division = $request->e_division;
            $civil_case_old_data->district = $request->e_district;
            $civil_case_old_data->region = $request->e_region;
            $civil_case_old_data->plaintiff_name = $request->e_plaintiff_name;
            $civil_case_old_data->defendant_name = $request->e_defendant_name;
            $civil_case_old_data->case_filling_date = date('Y-m-d', strtotime($request->e_case_filling_date));
            $civil_case_old_data->assigned_lawyer_name = $request->e_assigned_lawyer_name;
            $civil_case_old_data->case_created_by = $request->e_case_created_by;
            $civil_case_old_data->case_updated_by = Auth::user()->id;
            if ($request->e_admin_approval == "on") {
                $request->e_admin_approval = "1";
            } else {
                $request->e_admin_approval = "0";
            }
            $civil_case_old_data->admin_approval = $request->e_admin_approval;
            if ($request->e_document_status == "on") {
                $request->e_document_status = "1";
            } else {
                $request->e_document_status = "0";
            }
            $civil_case_old_data->document_status = $request->e_document_status;
            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $civil_case_old_data->status = $request->e_status;

            $query = $civil_case_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Civil Case Details Updated successfully!",
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

    // Delete Civil Case ajax request
    public function deleteCivilCase(Request $request)
    {
        $id = $request->id;

        if (CivilCase::destroy($id)) {
            if (CivilCaseLog::where('case_id', $id)->exists()) {
                $civil_case_log_data = CivilCaseLog::where('case_id', $id)->orderBy('updated_at', 'desc')->first();

                $civil_case_log = new CivilCaseLog();
                $civil_case_log->id = null;

                $civil_case_log->case_id = $civil_case_log_data->case_id;
                $civil_case_log->filed_case_name = $civil_case_log_data->filed_case_name;
                $civil_case_log->case_category = $civil_case_log_data->case_category;
                $civil_case_log->court_name = $civil_case_log_data->court_name;
                $civil_case_log->division = $civil_case_log_data->division;
                $civil_case_log->district = $civil_case_log_data->district;
                $civil_case_log->region = $civil_case_log_data->region;
                $civil_case_log->plaintiff_name = $civil_case_log_data->plaintiff_name;
                $civil_case_log->defendant_name = $civil_case_log_data->defendant_name;
                $civil_case_log->case_filling_date = $civil_case_log_data->case_filling_date;
                $civil_case_log->assigned_lawyer_name = $civil_case_log_data->assigned_lawyer_name;
                $civil_case_log->case_created_by = $civil_case_log_data->case_created_by;
                $civil_case_log->case_updated_by = Auth::user()->id;
                $civil_case_log->admin_approval = $civil_case_log_data->admin_approval;
                $civil_case_log->document_status = $civil_case_log_data->document_status;
                $civil_case_log->status = -1;

                $civil_case_log->save();
            }

            return response()->json([
                'isSuccess' => true,
                'Message' => 'Civil Case deleted successfully!',
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
