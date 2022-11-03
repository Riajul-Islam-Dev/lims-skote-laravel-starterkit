<div class="container">
    <div class="modal fade" id="addCourtModal" tabindex="-1" aria-labelledby="addCourtModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourtModalLabel">Add new Court:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Court form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveCourt') }}" method="POST" id="create_court_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="court_name" label="Court Name" star="*" />
                                <x-lims.forms.input.text name="court_name" id="court_name" placeholder="Court Name" />
                                <span class="text-danger error-text court_name_error"></span>
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
                            id="add_court_btn"><i class="bx bx-check-double label-icon"></i> <span
                                id="add_court_btn_span">Create Court</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
