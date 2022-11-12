<div class="container">
    <div class="modal fade" id="editCriminalCaseModal" tabindex="-1" aria-labelledby="editCriminalCaseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCriminalCaseModalLabel">Edit new Criminal Case:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the Criminal Case form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateCriminalCase') }}" method="POST" id="edit_criminal_case_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_criminal_case_id" name="e_criminal_case_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_filed_case_name" label="Filed Case Name"
                                    star="*" />
                                <x-lims.forms.input.text name="e_filed_case_name" id="e_filed_case_name"
                                    placeholder="Filed Case Name" />
                                <span class="text-danger error-text e_filed_case_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_category" label="Case Category" star="*" />
                                <x-lims.forms.input.text name="e_case_category" id="e_case_category"
                                    placeholder="Case Category" />
                                <span class="text-danger error-text e_case_category_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_court_name" label="Court Name" star="*" />
                                <x-lims.forms.input.text name="e_court_name" id="e_court_name"
                                    placeholder="Court Name" />
                                <span class="text-danger error-text e_court_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_division" label="Division" star="*" />
                                <x-lims.forms.input.text name="e_division" id="e_division" placeholder="Division" />
                                <span class="text-danger error-text e_division_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district" label="District" star="*" />
                                <x-lims.forms.input.text name="e_district" id="e_district" placeholder="District" />
                                <span class="text-danger error-text e_district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_region" label="Region" star="*" />
                                <x-lims.forms.input.text name="e_region" id="e_region" placeholder="Region" />
                                <span class="text-danger error-text e_region_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_complainant_name" label="Complainant Name"
                                    star="*" />
                                <x-lims.forms.input.text name="e_complainant_name" id="e_complainant_name"
                                    placeholder="Complainant Name" />
                                <span class="text-danger error-text e_complainant_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_accused_name" label="Accused Name" star="*" />
                                <x-lims.forms.input.text name="e_accused_name" id="e_accused_name"
                                    placeholder="Accused Name" />
                                <span class="text-danger error-text e_accused_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_filling_date" label="Case Filling Date"
                                    star="*" />
                                <x-lims.forms.input.datepicker name="e_case_filling_date" id="e_case_filling_date"
                                    placeholder="Case Filling Date" />
                                <span class="text-danger error-text e_case_filling_date_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_assigned_lawyer_name" label="Assigned Lawyer Name"
                                    star="*" />
                                <x-lims.forms.input.text name="e_assigned_lawyer_name" id="e_assigned_lawyer_name"
                                    placeholder="Assigned Lawyer Name" />
                                <span class="text-danger error-text e_assigned_lawyer_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_created_by" label="Case Created By"
                                    star="*" />
                                <x-lims.forms.input.text name="e_case_created_by" id="e_case_created_by"
                                    placeholder="Case Created By" />
                                <span class="text-danger error-text e_case_created_by_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_admin_approval" label="Admin Approval"
                                    star="*" />
                                <x-lims.forms.input.toggle name="e_admin_approval" id="e_admin_approval" />
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_document_status" label="Document Status"
                                    star="*" />
                                <x-lims.forms.input.toggle name="e_document_status" id="e_document_status" />
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
                            id="edit_criminal_case_btn"><i class="bx bx-check-double label-icon"></i> <span
                                id="edit_criminal_case_btn_span">Update Criminal
                                Case</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
