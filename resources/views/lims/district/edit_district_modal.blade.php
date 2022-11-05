<div class="container">
    <div class="modal fade" id="editDistrictModal" tabindex="-1" aria-labelledby="editDistrictModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDistrictModalLabel">Edit new District:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the District form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>District
                <form action="{{ route('updateDistrict') }}" method="POST" id="edit_district_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_district_id" name="e_district_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district_name" label="District Name" star="*" />
                                <x-lims.forms.input.text name="e_district_name" id="e_district_name"
                                    placeholder="District Name" />
                                <span class="text-danger error-text e_district_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district_code" label="District Name" star="*" />
                                <x-lims.forms.input.text name="e_district_code" id="e_district_code"
                                    placeholder="District Name" />
                                <span class="text-danger error-text e_district_code_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_division_name" label="Division Name" star="*" />
                                <x-lims.forms.input.text name="e_division_name" id="e_division_name"
                                    placeholder="Division Name" />
                                <span class="text-danger error-text e_division_name_error"></span>
                            </div>
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
                            id="edit_district_btn"><i class="bx bx-check-double label-icon"></i> <span
                                id="edit_district_btn_span">Update District</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
