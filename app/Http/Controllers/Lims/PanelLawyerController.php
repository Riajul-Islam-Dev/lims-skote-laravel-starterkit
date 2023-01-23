<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\PanelLawyer;
use App\Models\Lims\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Validator;

class PanelLawyerController extends Controller
{
    // Panel Lawyer data table page view
    public function indexPanelLawyer()
    {
        $show_user_data = User::where('role_id','=', '5')->get();
        return view('Lims/panel_lawyer/show_panel_lawyer', compact('show_user_data'));
    }

    // Fetch all Panel Lawyers ajax request
    public function fetchAllPanelLawyer()
    {
        $show_panel_lawyer_data = PanelLawyer::all();
        $show_user_data = User::all();

        $output = '';
        if ($show_panel_lawyer_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>User Name</th>
                    <th>District Name</th>
                    <th>Name of the Bar</th>
                    <th>Membership Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_panel_lawyer_data as $key => $data) {
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-success';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }

                $user_details = 'Data not found';
                foreach ($show_user_data as $user_data) {
                    if ($user_data->id == $data->user_id && $user_data->role_id == 5) {
                        $user_details = $user_data;
                    }
                }

                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>
                    <div>
                        <img class="rounded-circle avatar-xs" src="' . URL::asset($user_details->avatar) . '" alt="_not found">
                    </div>
                </td>
                <td>' . $user_details->name . ' </td>
                <td>' . $data->district_name . '</td>
                <td>' . $data->name_of_the_bar . '</td>
                <td>' . $data->membership_number . '</td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-info waves-effect btn-label waves-light show_panel_lawyer" data-bs-toggle="modal" data-bs-target="#showPanelLawyerModal"><i class="bx bx-user-circle label-icon"></i> View</a>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_panel_lawyer" data-bs-toggle="modal" data-bs-target="#editPanelLawyerModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_panel_lawyer"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Panel Lawyer ajax request
    public function savePanelLawyer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'string', 'max:255', 'unique:panel_lawyers'],
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'religion' => ['required', 'string', 'max:255'],
            'district_name' => ['required', 'string', 'max:255'],
            'date_of_enrollment' => ['required', 'date', 'before:today'],
            'name_of_the_bar' => ['required', 'string', 'max:255'],
            'membership_number' => ['required', 'string', 'max:255'],
            'address_of_chamber' => ['required', 'string', 'max:255'],
            'address_of_residence' => ['required', 'string', 'max:255'],
            'specialized_practicing_area' => ['required', 'string', 'max:255'],
            'professional_experience' => ['required', 'string', 'max:255'],
            'case_conducted' => ['required', 'string', 'max:255'],
            'references' => ['required', 'string', 'max:255'],
            'remarks' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {
            $panel_lawyer = new PanelLawyer();

            $panel_lawyer->user_id = $request->user_id;
            $panel_lawyer->father_name = $request->father_name;
            $panel_lawyer->mother_name = $request->mother_name;
            $panel_lawyer->contact_number = $request->contact_number;
            $panel_lawyer->nationality = $request->nationality;
            $panel_lawyer->religion = $request->religion;
            $panel_lawyer->district_name = $request->district_name;
            $panel_lawyer->date_of_enrollment = date('Y-m-d', strtotime($request->date_of_enrollment));
            $panel_lawyer->name_of_the_bar = $request->name_of_the_bar;
            $panel_lawyer->membership_number = $request->membership_number;
            $panel_lawyer->address_of_chamber = $request->address_of_chamber;
            $panel_lawyer->address_of_residence = $request->address_of_residence;
            $panel_lawyer->specialized_practicing_area = $request->specialized_practicing_area;
            $panel_lawyer->professional_experience = $request->professional_experience;
            $panel_lawyer->case_conducted = $request->case_conducted;
            $panel_lawyer->references = $request->references;
            $panel_lawyer->remarks = $request->remarks;

            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $panel_lawyer->status = $request->status;

            $query = $panel_lawyer->save();

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

    // handle Panel Lawyer edit ajax request
    public function editPanelLawyer(Request $request)
    {
        $id = $request->id;
        $edit_panel_lawyer_data = PanelLawyer::find($id);
        $user_data = User::find($edit_panel_lawyer_data->user_id);
        $edit_panel_lawyer_data->user_name = $user_data->name;
        $edit_panel_lawyer_data->avatar = $user_data->avatar;

        return response()->json($edit_panel_lawyer_data);
    }

    // update Panel Lawyer ajax request
    public function updatePanelLawyer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_panel_lawyer_id' => ['required', 'string', 'max:255'],
            'e_father_name' => ['required', 'string', 'max:255'],
            'e_mother_name' => ['required', 'string', 'max:255'],
            'e_contact_number' => ['required', 'string', 'max:255'],
            'e_nationality' => ['required', 'string', 'max:255'],
            'e_religion' => ['required', 'string', 'max:255'],
            'e_district_name' => ['required', 'string', 'max:255'],
            'e_date_of_enrollment' => ['required', 'date', 'before:today'],
            'e_name_of_the_bar' => ['required', 'string', 'max:255'],
            'e_membership_number' => ['required', 'string', 'max:255'],
            'e_address_of_chamber' => ['required', 'string', 'max:255'],
            'e_address_of_residence' => ['required', 'string', 'max:255'],
            'e_specialized_practicing_area' => ['required', 'string', 'max:255'],
            'e_professional_experience' => ['required', 'string', 'max:255'],
            'e_case_conducted' => ['required', 'string', 'max:255'],
            'e_references' => ['required', 'string', 'max:255'],
            'e_remarks' => ['required', 'string', 'max:255'],
            // 'e_status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_panel_lawyer_id;
            $panel_lawyer_old_data = PanelLawyer::find($id);

            $panel_lawyer_old_data->father_name = $request->e_father_name;
            $panel_lawyer_old_data->mother_name = $request->e_mother_name;
            $panel_lawyer_old_data->contact_number = $request->e_contact_number;
            $panel_lawyer_old_data->nationality = $request->e_nationality;
            $panel_lawyer_old_data->religion = $request->e_religion;
            $panel_lawyer_old_data->district_name = $request->e_district_name;
            $panel_lawyer_old_data->date_of_enrollment = date('Y-m-d', strtotime($request->e_date_of_enrollment));
            $panel_lawyer_old_data->name_of_the_bar = $request->e_name_of_the_bar;
            $panel_lawyer_old_data->membership_number = $request->e_membership_number;
            $panel_lawyer_old_data->address_of_chamber = $request->e_address_of_chamber;
            $panel_lawyer_old_data->address_of_residence = $request->e_address_of_residence;
            $panel_lawyer_old_data->specialized_practicing_area = $request->e_specialized_practicing_area;
            $panel_lawyer_old_data->professional_experience = $request->e_professional_experience;
            $panel_lawyer_old_data->case_conducted = $request->e_case_conducted;
            $panel_lawyer_old_data->references = $request->e_references;
            $panel_lawyer_old_data->remarks = $request->e_remarks;

            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $panel_lawyer_old_data->status = $request->e_status;

            $query = $panel_lawyer_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Panel Lawyer Details Updated successfully!",
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

    // Delete Panel Lawyer ajax request
    public function deletePanelLawyer(Request $request)
    {
        if (PanelLawyer::destroy($request->id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Panel Lawyer deleted successfully!',
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

    // Get User Avatar ajax request
    public function getUserAvatar(Request $request)
    {
        $id = $request->id;
        $user_data = User::find($id);

        return response()->json($user_data);
    }

    // show Panel Lawyer ajax request
    public function showPanelLawyer(Request $request)
    {
        $id = $request->id;
        $panel_lawyer_data = PanelLawyer::find($id);
        $user_data = User::find($panel_lawyer_data->user_id);

        $panel_lawyer_data->name = $user_data->name;
        $panel_lawyer_data->email = $user_data->email;
        $panel_lawyer_data->dob = $user_data->dob;
        $panel_lawyer_data->avatar = $user_data->avatar;

        return response()->json($panel_lawyer_data);
    }
}
