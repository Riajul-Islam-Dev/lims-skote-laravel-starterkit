<div class="container">
    <div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDistrictModalLabel">Add new District:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new District form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveDistrict') }}" method="POST" id="create_district_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="district_name" label="District Name" star="*" />
                                <x-lims.forms.input.text name="district_name" id="district_name"
                                    placeholder="District Name" />
                                <span class="text-danger error-text district_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="district_code" label="District Code" star="*" />
                                <x-lims.forms.input.text name="district_code" id="district_code"
                                    placeholder="District Code" />
                                <span class="text-danger error-text district_code_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="division_name" label="Division Name" star="*" />
                                <x-lims.forms.input.text name="division_name" id="division_name"
                                    placeholder="Division Name" />
                                <span class="text-danger error-text division_name_error"></span>
                            </div>
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
                            id="add_district_btn"><i class="bx bx-check-double label-icon"></i> <span
                                id="add_district_btn_span">Create District</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
