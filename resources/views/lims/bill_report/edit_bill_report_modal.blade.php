<div class="container">
    <div class="modal fade" id="editIdeaBoxModal" tabindex="-1" aria-labelledby="editIdeaBoxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIdeaBoxModalLabel">Edit new Idea:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the Idea Box form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateIdeaBox') }}" method="POST" id="edit_idea_box_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_idea_box_id" name="e_idea_box_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_title" label="Title" star="*" />
                                <x-lims.forms.input.text name="e_title" id="e_title" placeholder="Title" />
                                <span class="text-danger error-text e_title_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_description" label="Description" star="*" />
                                <x-lims.forms.input.textarea name="e_description" id="e_description"
                                    placeholder="Description" />
                                <span class="text-danger error-text e_description_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district" label="District" star="*" />
                                <x-lims.forms.input.select name="e_district" id="e_district">
                                    <option value="option_select" disabled selected>District</option>
                                    @foreach ($show_district_data as $show_district_data_individual)
                                        <option value="{{ $show_district_data_individual->district_code }}">
                                            {{ $show_district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_document" label="Upload Document" star="*" />
                                <x-lims.forms.input.file name="e_document" id="e_document"
                                    placeholder="Upload Document" />
                                <span class="text-danger error-text e_document_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_status" label="Status" star="*" />
                                <x-lims.forms.input.toggle name="e_status" id="e_status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon"></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="edit_idea_box_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="edit_idea_box_btn_span"> Update Idea</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
