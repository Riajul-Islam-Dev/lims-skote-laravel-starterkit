<?php

namespace App\Http\Controllers\lims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lims\Meeting;
use App\Models\Lims\Division;
use App\Models\Lims\District;
use App\Models\Lims\Month;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Validator;
use stdClass;


class MeetingController extends Controller
{
    // Meeting data table page view
    public function indexMeeting()
    {
        $division_data = Division::all();
        $district_data = District::all();

        // $month = new stdClass();
        // $map  = array(array("id" => "0", "month_number" => "1", "month_name" => "January"), array("id" => "1", "month_number" => "2", "month_name" => "February"));

        // foreach ($map  as $k => $val) {
        //     $month->$k = $val;
        // }

        return view('Lims/meeting/show_meeting', compact('division_data', 'district_data'));
    }

    // Fetch all Meetings ajax request
    public function fetchAllMeeting()
    {
        $show_meeting_data = Meeting::all();

        $division_data = Division::all();
        $district_data = District::all();
        $month_data = Month::all();

        // $month = array(array("month_number" => "1", "month_name" => "January"), array("month_number" => "2", "month_name" => "February"));

        $output = '';
        if ($show_meeting_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Division</th>
                        <th>District</th>
                        <th>Start_date</th>
                        <th>End_date</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Meeting Held Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($show_meeting_data as $key => $data) {
                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-success';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }

                $show_division = "Data not found";
                foreach ($division_data as $division_data_individual) {
                    if ($data->division == $division_data_individual->division_code) {
                        $show_division = $division_data_individual->division_name;
                    }
                }

                $show_district = "Data not found";
                foreach ($district_data as $district_data_individual) {
                    if ($data->district == $district_data_individual->district_code) {
                        $show_district = $district_data_individual->district_name;
                    }
                }

                $show_month = "Data not found";
                foreach ($month_data as $month_data_individual) {
                    if ($data->month == $month_data_individual->month_code) {
                        $show_month = $month_data_individual->month_name;
                    }
                }

                $output .= '<tr>
                    <th scope="row">' . $data->id . ' </th>
                    <td>' . $show_division . ' </td>
                    <td>' . $show_district . '</td>
                    <td>' . $data->start_date . '</td>
                    <td>' . $data->end_date . '</td>
                    <td>' . $show_month . '</td>
                    <td>' . $data->year . '</td>
                    <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                    <td>
                    <a href="#" id="' . $data->id . '" class="btn btn-info waves-effect btn-label waves-light show_meeting" data-bs-toggle="modal" data-bs-target="#showMeetingModal"><i class="bx bx-user-circle label-icon"></i> View</a>
                    <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_meeting" data-bs-toggle="modal" data-bs-target="#editMeetingModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                    <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_meeting"><i class="bx bx-trash label-icon"></i> Delete</a>
                    </td>
                    </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Meeting ajax request
    public function saveMeeting(Request $request)
    {
        $meeting = new Meeting();
        $validator = Validator::make($request->all(), [
            'division' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:255', 'regex:/^[-0-9\+]+$/'],
            'end_date' => ['required', 'string', 'max:255', 'regex:/^[-0-9\+]+$/'],
            'month' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255', 'regex:/^[-0-9\+]+$/'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {
            $meeting = new Meeting();

            $meeting->division = $request->division;
            $meeting->district = $request->district;
            $meeting->start_date = $request->start_date;
            $meeting->end_date = $request->end_date;
            $meeting->month = $request->month;
            $meeting->year = $request->year;

            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $meeting->status = $request->status;

            $query = $meeting->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Meeting Details Saved successfully!",
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

    // handle edit Meeting ajax request
    public function editMeeting(Request $request)
    {
        $id = $request->id;
        $edit_meeting_data = Meeting::find($id);

        return response()->json($edit_meeting_data);
    }

    // handle update Meeting ajax request
    public function updateMeeting(Request $request)
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

    // Delete Meeting ajax request
    public function deleteMeeting(Request $request)
    {
        $id = $request->id;

        if (Meeting::destroy($id)) {
            return response()->json([
                'isSuccess' => true,
                'Message' => 'Meeting deleted successfully!',
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

    // Show Meeting ajax request
    public function showMeeting(Request $request)
    {
        $id = $request->id;
        $show_meeting_data = Meeting::find($id);

        // $role_data = Role::find($show_meeting_data->role_id);

        // $show_meeting_data->role_name = $role_data->role_name;

        return response()->json($show_meeting_data);
    }
}
