<?php

namespace App\Http\Controllers\Lims;

use App\Http\Controllers\Controller;
use App\Models\lims\District;
use Illuminate\Http\Request;
use App\Models\Lims\IdeaBox;
use Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Validator;


class IdeaBoxController extends Controller
{
    // IdeaBox data table page view
    public function indexIdeaBox()
    {
        $show_district_data = District::all();
        return view('Lims/idea_box/show_idea_box', compact("show_district_data"));
    }

    // Fetch all IdeaBoxes ajax request
    public function fetchAllIdeaBox()
    {
        $show_idea_box_data = IdeaBox::all();
        $show_district_data = District::all();

        $output = '';
        if ($show_idea_box_data->count() > 0) {
            $output .= '<table id="datatable-buttons" class="table table-bordered table-hover dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>District</th>
                    <th>Document Uploaded</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($show_idea_box_data as $key => $data) {

                $district_name = 'Data not found';
                foreach ($show_district_data as $district_data) {
                    if ($district_data->district_code == $data->district) {
                        $district_name = $district_data->district_name;
                        $district_name_badge_class = 'badge bg-info';
                    }
                }

                if ($data->document_status == 1) {
                    $data->document_status = "Uploaded";
                    $document_status_badge_class = 'badge bg-success';
                } else {
                    $data->document_status = "No files found";
                    $document_status_badge_class = 'badge bg-danger';
                }

                if ($data->status == 1) {
                    $data->status = "Active";
                    $status_badge_class = 'badge bg-success';
                } else {
                    $data->status = "Inactive";
                    $status_badge_class = 'badge bg-danger';
                }

                $output .= '<tr>
                <th scope="row">' . $data->id . ' </th>
                <td>' . $data->title . ' </td>
                <td>' . $data->description . '</td>
                <td><div class="' . $district_name_badge_class . '">' . $district_name . '</div></td>
                <td><div class="' . $document_status_badge_class . '">' . $data->document_status . '</div></td>
                <td><div class="' . $status_badge_class . '">' . $data->status . '</div></td>
                <td>
                <a href="#" id="' . $data->id . '" class="btn btn-info waves-effect btn-label waves-light show_idea_box" data-bs-toggle="modal" data-bs-target="#showIdeaBoxModal"><i class="bx bx-user-circle label-icon"></i> View</a>
                <a href="#" id="' . $data->id . '" class="btn btn-warning waves-effect btn-label waves-light edit_idea_box" data-bs-toggle="modal" data-bs-target="#editIdeaBoxModal"><i class="bx bx-pencil label-icon"></i> Edit</a>
                <a href="#" id="' . $data->id . '" class="btn btn-danger waves-effect btn-label waves-light delete_idea_box"><i class="bx bx-trash label-icon"></i> Delete</a>
                </td>
                </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // Save Idea Box ajax request
    public function saveIdeaBox(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'document' => ['required', 'file', 'mimes:doc,pdf,docx,zip', 'max:5000'],
            // 'status' => ['required', 'string'],
        ]);

        if ($validator->passes()) {
            $idea_box = new IdeaBox();

            if (!empty($request->document)) {
                $document = $request->document;
                $documentName = time() . '.' . $document->getClientOriginalExtension();
                $documentPath = public_path('/idea_documents/');
                $document->move($documentPath, $documentName);
                $idea_box->document_status = 1;
            } else {
                $idea_box->document_status = 0;
            }

            $idea_box->title = $request->title;
            $idea_box->description = $request->description;
            $idea_box->district = $request->district;
            $idea_box->document = "/idea_documents/" . $documentName;

            if ($request->status == "on") {
                $request->status = "1";
            } else {
                $request->status = "0";
            }
            $idea_box->status = $request->status;

            $query = $idea_box->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Idea Saved successfully!",
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

    // handle edit an Idea Box ajax request
    public function editIdeaBox(Request $request)
    {
        $id = $request->id;
        $edit_idea_box_data = IdeaBox::find($id);

        return response()->json($edit_idea_box_data);
    }

    // update Idea Box ajax request
    public function updateIdeaBox(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'e_idea_box_id' => ['required', 'string', 'max:255'],
            'e_title' => ['required', 'string', 'max:255'],
            'e_description' => ['required', 'string', 'max:255'],
            'e_district' => ['required', 'string', 'max:255'],
            // 'e_document' => ['required', 'file', 'mimes:doc,pdf,docx,zip', 'max:5000'],
            // 'e_status' => ['string', 'max:255'],
        ]);

        if ($validator->passes()) {

            $id = $request->e_idea_box_id;
            $idea_box_old_data = IdeaBox::find($id);

            if (!empty($request->e_document)) {
                $document_path = public_path() . $idea_box_old_data->document;  // Value is not URL but directory file path
                if (File::exists($document_path)) {
                    File::delete($document_path);
                }
                $document = $request->e_document;
                $documentName = time() . '.' . $document->getClientOriginalExtension();
                $documentPath = public_path('/idea_documents/');
                $document->move($documentPath, $documentName);
                $idea_box_old_data->document = "/idea_documents/" . $documentName;
            }

            $idea_box_old_data->title = $request->e_title;
            $idea_box_old_data->description = $request->e_description;
            $idea_box_old_data->district = $request->e_district;

            if ($request->e_status == "on") {
                $request->e_status = "1";
            } else {
                $request->e_status = "0";
            }
            $idea_box_old_data->status = $request->e_status;

            $query = $idea_box_old_data->save();

            if ($query) {
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Idea Details Updated successfully!",
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

    // Delete Idea Box ajax request
    public function deleteIdeaBox(Request $request)
    {
        $id = $request->id;
        $delete_idea_box_data = IdeaBox::find($id);

        $document_path = public_path() . $delete_idea_box_data->document;  // Value is not URL but directory file path
        if (File::exists($document_path)) {
            if (File::delete($document_path)) {
                IdeaBox::destroy($id);
                return response()->json([
                    'isSuccess' => true,
                    'Message' => 'Idea deleted successfully!',
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
                'Message' => 'No File found!',
                'code' => 0
            ], 200); // Status code here
        }
    }

    // Show IdeaBox ajax request
    public function showIdeaBox(Request $request)
    {
        $id = $request->id;
        $show_idea_box_data = IdeaBox::find($id);

        $show_idea_box_data->document = URL::asset($show_idea_box_data->document);

        $district_data = District::all();

        foreach($district_data as $district_data_individual){
            if($district_data_individual->district_code == $show_idea_box_data->district){
                $show_idea_box_data->district =  $district_data_individual->district_name;
            }
        }

        if ($show_idea_box_data->status == 1) {
            $show_idea_box_data->status = "Active";
        } else {
            $show_idea_box_data->status = "Inactive";
        }

        return response()->json($show_idea_box_data);
    }
}
