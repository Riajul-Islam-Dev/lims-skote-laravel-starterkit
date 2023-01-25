<div class="container">
    <div class="modal fade" id="addIdeaBoxModal" tabindex="-1" aria-labelledby="addIdeaBoxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addIdeaBoxModalLabel">Add new Idea Box:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Idea Box form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveIdeaBox') }}" method="POST" id="create_idea_box_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="title" label="Title" star="*" />
                                <x-lims.forms.input.text name="title" id="title" placeholder="Title" />
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="description" label="Description" star="*" />
                                <x-lims.forms.input.textarea name="description" id="description"
                                    placeholder="Description" />
                                <span class="text-danger error-text description_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="district" label="District" star="*" />
                                <x-lims.forms.input.select name="district" id="district">
                                    <option value="option_select" disabled selected>District</option>
                                    @foreach ($show_district_data as $show_district_data_individual)
                                        <option value="{{ $show_district_data_individual->district_code }}">
                                            {{ $show_district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="document" label="Upload Document" star="*" />
                                <x-lims.forms.input.file name="document" id="document" placeholder="Upload Document" />
                                <span class="text-danger error-text document_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="status" label="Status" star="*" />
                                <x-lims.forms.input.toggle name="status" id="status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon "></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="add_idea_box_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="add_idea_box_btn_span">
                                Create Idea</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
