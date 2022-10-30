<div class="container">
    <div class="modal fade" id="addCriminalCaseModal" tabindex="-1" aria-labelledby="addCriminalCaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCriminalCaseModalLabel">Add new Criminal Case:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Criminal Case form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveCriminalCase') }}" method="POST" id="create_criminal_case_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="filed_case_name" label="Filed Case Name"
                                    star="*" />
                                <x-lims.forms.input.text name="filed_case_name" id="filed_case_name"
                                    placeholder="Filed Case Name" />
                                <span class="text-danger error-text filed_case_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_category" label="Case Category" star="*" />
                                <x-lims.forms.input.text name="case_category" id="case_category"
                                    placeholder="Case Category" />
                                <span class="text-danger error-text case_category_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="court_name" label="Court Name" star="*" />
                                <x-lims.forms.input.text name="court_name" id="court_name" placeholder="Court Name" />
                                <span class="text-danger error-text court_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="division" label="Division" star="*" />
                                <x-lims.forms.input.text name="division" id="division" placeholder="Division" />
                                <span class="text-danger error-text division_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="district" label="District" star="*" />
                                <x-lims.forms.input.text name="district" id="district" placeholder="District" />
                                <span class="text-danger error-text district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="region" label="Region" star="*" />
                                <x-lims.forms.input.text name="region" id="region" placeholder="Region" />
                                <span class="text-danger error-text region_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="defendant_name" label="Defendant Name" star="*" />
                                <x-lims.forms.input.text name="defendant_name" id="defendant_name"
                                    placeholder="Defendant Name" />
                                <span class="text-danger error-text defendant_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="plaintiff_name" label="Plaintiff Name" star="*" />
                                <x-lims.forms.input.text name="plaintiff_name" id="plaintiff_name"
                                    placeholder="Plaintiff Name" />
                                <span class="text-danger error-text plaintiff_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_filling_date" label="Case Filling Date"
                                    star="*" />
                                <x-lims.forms.input.date name="case_filling_date" id="case_filling_date"
                                    placeholder="Case Filling Date" />
                                <span class="text-danger error-text case_filling_date_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="assigned_lawyer_name" label="Assigned Lawyer Name"
                                    star="*" />
                                <x-lims.forms.input.text name="assigned_lawyer_name" id="assigned_lawyer_name"
                                    placeholder="Assigned Lawyer Name" />
                                <span class="text-danger error-text assigned_lawyer_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_created_by" label="Case Created By"
                                    star="*" />
                                <x-lims.forms.input.text name="case_created_by" id="case_created_by"
                                    placeholder="Case Created By" />
                                <span class="text-danger error-text case_created_by_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="admin_approval" label="Admin Approval"
                                    star="*" />
                                <x-lims.forms.input.toggle name="admin_approval" id="admin_approval" />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="document_status" label="Document Status"
                                    star="*" />
                                <x-lims.forms.input.toggle name="document_status" id="document_status" />
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
                            id="add_criminal_case_btn"><i class="bx bx-check-double label-icon"></i> <span
                                id="add_criminal_case_btn_span">Create Criminal Case</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
