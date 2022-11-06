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
    public function showPanelLawyer()
    {
        $condition = ['role_id' => 3];
        $show_user_data = User::where($condition)->get();
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
                    <th>User Email</th>
                    <th>Date of Birth</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Contact Number</th>
                    <th>Nationality</th>
                    <th>Religion</th>
                    <th>District Name</th>
                    <th>Date of Enrollment</th>
                    <th>Name of the Bar</th>
                    <th>Membership Number</th>
                    <th>Address of Chamber</th>
                    <th>Address of Residence</th>
                    <th>Specialized Practicing Area</th>
                    <th>Professional Experience</th>
                    <th>Cae Conducted</th>
                    <th>References</th>
                    <th>Remarks</th>
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

                $user_details = '';
                foreach ($show_user_data as $user_data) {
                    if ($user_data->id == $data->user_id && $user_data->role_id == 3) {
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
                <td>' . $user_details->email . '</td>
                <td>' . $user_details->dob . '</td>
                <td>' . $data->father_name . '</td>
                <td>' . $data->mother_name . '</td>
                <td>' . $data->contact_number . '</td>
                <td>' . $data->nationality . '</td>
                <td>' . $data->religion . '</td>
                <td>' . $data->district_name . '</td>
                <td>' . $data->date_of_enrollment . '</td>
                <td>' . $data->name_of_the_bar . '</td>
                <td>' . $data->membership_number . '</td>
                <td>' . $data->address_of_chamber . '</td>
                <td>' . $data->address_of_residence . '</td>
                <td>' . $data->specialized_practicing_area . '</td>
                <td>' . $data->professional_experience . '</td>
                <td>' . $data->case_conducted . '</td>
                <td>' . $data->references . '</td>
                <td>' . $data->remarks . '</td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
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

    // handle edit an user ajax request
    public function editUser(Request $request)
    {
        $id = $request->id;
        $edit_user_data = User::find($id);

        return response()->json($edit_user_data);
    }

    // update user ajax request
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_name' => ['required', 'string', 'max:255'],
            'e_email' => ['required', 'string', 'email', 'max:255'],
            'e_user_password' => ['nullable', 'string', 'min:6'],
            'e_dob' => ['required', 'date', 'before:today'],
            'e_avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
            'e_role_id' => ['required', 'string', 'max:255'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_user_id;
            $user_old_data = User::find($id);

            if (!empty($request->e_avatar)) {
                $image_path = public_path() . $user_old_data->avatar;  // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $avatar = $request->e_avatar;
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/images/');
                $avatar->move($avatarPath, $avatarName);
                $user_old_data->avatar = "/images/" . $avatarName;
            }

            if (!empty($request->e_user_password)) {
                $user_old_data->password = Hash::make($request->e_user_password);
            }

            $user_old_data->name = $request->e_name;
            $user_old_data->email = $request->e_email;
            $user_old_data->dob = date('Y-m-d', strtotime($request->e_dob));
            $user_old_data->role_id = $request->e_role_id;

            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $user_old_data->status = $request->e_status;

            $query = $user_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "User Details Updated successfully!",
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

    // Delete user ajax request
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $delete_user_data = User::find($id);

        $image_path = public_path() . $delete_user_data->avatar;  // Value is not URL but directory file path
        if (File::exists($image_path)) {
            if (File::delete($image_path)) {
                User::destroy($id);
                return response()->json([
                    'isSuccess' => true,
                    'Message' => 'User deleted successfully!',
                    'code' => 1
                ], 200); // Status code here
            } else {
                return response()->json([
                    'isSuccess' => false,
                    'Message' => 'Something went wrong!',
                    'code' => 0
                ], 200); // Status code here
            }
        } else {
            return response()->json([
                'isSuccess' => false,
                'Message' => 'No Avatar found!',
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
}
