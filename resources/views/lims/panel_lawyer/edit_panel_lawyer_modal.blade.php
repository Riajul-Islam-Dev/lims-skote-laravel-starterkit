<div class="container">
    <div class="modal fade" id="editPanelLawyerModal" tabindex="-1" aria-labelledby="editPanelLawyerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPanelLawyerModalLabel">Edit Panel Lawyer:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the PanelLawyer form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updatePanelLawyer') }}" method="POST" id="edit_panel_lawyer_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-2 mb-3">
                            <div class="col-6">
                                <input type="hidden" id="e_panel_lawyer_id" name="e_panel_lawyer_id">
                                <x-lims.forms.input.label for="e_panel_lawyer_name" label="Panel Lawyer Name"
                                    star="*" />
                                <x-lims.forms.input.text name="e_panel_lawyer_name" id="e_panel_lawyer_name"
                                    value="" disabled />
                                <span class="text-danger error-text e_panel_lawyer_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="panel_lawyer_avatar" label="Panel Lawyer Avatar"
                                    star="" />
                                <div class="pt-3 pb-4 text-center bg-light h-75" id="panel_lawyer_avatar"></div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_father_name" label="Father's Name" star="*" />
                                <x-lims.forms.input.text name="e_father_name" id="e_father_name"
                                    placeholder="Father Name" />
                                <span class="text-danger error-text e_father_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_mother_name" label="Mother's Name" star="*" />
                                <x-lims.forms.input.text name="e_mother_name" id="e_mother_name"
                                    placeholder="Mother Name" />
                                <span class="text-danger error-text e_mother_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_contact_number" label="Contact Number"
                                    star="*" />
                                <x-lims.forms.input.text name="e_contact_number" id="e_contact_number"
                                    placeholder="Contact Number" />
                                <span class="text-danger error-text e_contact_number_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_nationality" label="Nationality" star="*" />
                                <x-lims.forms.input.text name="e_nationality" id="e_nationality"
                                    placeholder="Nationality" />
                                <span class="text-danger error-text e_nationality_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_religion" label="Religion" star="*" />
                                <x-lims.forms.input.text name="e_religion" id="e_religion" placeholder="Religion" />
                                <span class="text-danger error-text e_religion_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district_name" label="District Name" star="*" />
                                <x-lims.forms.input.text name="e_district_name" id="e_district_name"
                                    placeholder="District Name" />
                                <span class="text-danger error-text e_district_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_date_of_enrollment" label="Date of Enrollment"
                                    star="*" />
                                <x-lims.forms.input.datepicker name="e_date_of_enrollment" id="e_date_of_enrollment"
                                    placeholder="Date of Enrollment" />
                                <span class="text-danger error-text e_date_of_enrollment_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_name_of_the_bar" label="Name of the Bar"
                                    star="*" />
                                <x-lims.forms.input.text name="e_name_of_the_bar" id="e_name_of_the_bar"
                                    placeholder="Name of the Bar" />
                                <span class="text-danger error-text e_name_of_the_bar_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_membership_number" label="Membership Number"
                                    star="*" />
                                <x-lims.forms.input.text name="e_membership_number" id="e_membership_number"
                                    placeholder="Membership Number" />
                                <span class="text-danger error-text e_membership_number_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_address_of_chamber" label="Address of Chamber"
                                    star="*" />
                                <x-lims.forms.input.text name="e_address_of_chamber" id="e_address_of_chamber"
                                    placeholder="Address of Chamber" />
                                <span class="text-danger error-text e_address_of_chamber_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_address_of_residence" label="Address of Residence"
                                    star="*" />
                                <x-lims.forms.input.text name="e_address_of_residence" id="e_address_of_residence"
                                    placeholder="Address of Residence" />
                                <span class="text-danger error-text e_address_of_residence_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_specialized_practicing_area"
                                    label="Specialized Practicing Area" star="*" />
                                <x-lims.forms.input.text name="e_specialized_practicing_area"
                                    id="e_specialized_practicing_area" placeholder="Specialized Practicing Area" />
                                <span class="text-danger error-text e_specialized_practicing_area_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_professional_experience"
                                    label="Professional Experience" star="*" />
                                <x-lims.forms.input.text name="e_professional_experience"
                                    id="e_professional_experience" placeholder="Professional Experience" />
                                <span class="text-danger error-text e_professional_experience_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_conducted" label="Case Conducted"
                                    star="*" />
                                <x-lims.forms.input.text name="e_case_conducted" id="e_case_conducted"
                                    placeholder="Case Conducted" />
                                <span class="text-danger error-text e_case_conducted_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_references" label="References" star="*" />
                                <x-lims.forms.input.text name="e_references" id="e_references"
                                    placeholder="References" />
                                <span class="text-danger error-text e_references_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_remarks" label="Remarks" star="*" />
                                <x-lims.forms.input.textarea name="e_remarks" id="e_remarks" />
                                <span class="text-danger error-text e_remarks_error"></span>
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
                            id="edit_panel_lawyer_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="edit_panel_lawyer_btn_span"> Update Panel Lawyer</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
