<div class="container">
    <div class="modal fade" id="addPanelLawyerModal" tabindex="-1" aria-labelledby="addPanelLawyerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPanelLawyerModalLabel">Add new Panel Lawyer:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Panel Lawyer form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('savePanelLawyer') }}" method="POST" id="create_panel_lawyer_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mt-2 mb-3">
                            <div class="col-6">
                                <x-lims.forms.input.label for="user_id" label="Select User" star="*" />
                                <x-lims.forms.input.select name="user_id" id="user_id">
                                    <option value="option_select" disabled selected>Select User Name</option>
                                    @foreach ($show_user_data as $show_user_data_individual)
                                        <option value="{{ $show_user_data_individual->id }}">
                                            {{ $show_user_data_individual->name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text user_id_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="avatar_show" label="User Avatar" star="" />
                                <div class="pt-3 pb-4 text-center bg-light h-75" id="user_avatar_show"></div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="father_name" label="Father Name" star="*" />
                                <x-lims.forms.input.text name="father_name" id="father_name"
                                    placeholder="Father Name" />
                                <span class="text-danger error-text father_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="mother_name" label="Mother Name" star="*" />
                                <x-lims.forms.input.text name="mother_name" id="mother_name"
                                    placeholder="Mother Name" />
                                <span class="text-danger error-text mother_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="contact_number" label="Contact Number" star="*" />
                                <x-lims.forms.input.text name="contact_number" id="contact_number"
                                    placeholder="Contact Number" />
                                <span class="text-danger error-text contact_number_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="nationality" label="Nationality" star="*" />
                                <x-lims.forms.input.text name="nationality" id="nationality"
                                    placeholder="Nationality" />
                                <span class="text-danger error-text nationality_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="religion" label="Religion" star="*" />
                                <x-lims.forms.input.text name="religion" id="religion" placeholder="Religion" />
                                <span class="text-danger error-text religion_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="district_name" label="District Name" star="*" />
                                <x-lims.forms.input.text name="district_name" id="district_name"
                                    placeholder="District Name" />
                                <span class="text-danger error-text district_name_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="date_of_enrollment" label="Date of Enrollment"
                                    star="*" />
                                <x-lims.forms.input.date name="date_of_enrollment" id="date_of_enrollment"
                                    placeholder="Date of Enrollment" />
                                <span class="text-danger error-text date_of_enrollment_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="name_of_the_bar" label="Name of the Bar"
                                    star="*" />
                                <x-lims.forms.input.text name="name_of_the_bar" id="name_of_the_bar"
                                    placeholder="Name of the Bar" />
                                <span class="text-danger error-text name_of_the_bar_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="membership_number" label="Membership Number"
                                    star="*" />
                                <x-lims.forms.input.text name="membership_number" id="membership_number"
                                    placeholder="Membership Number" />
                                <span class="text-danger error-text membership_number_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="address_of_chamber" label="Address of Chamber"
                                    star="*" />
                                <x-lims.forms.input.text name="address_of_chamber" id="address_of_chamber"
                                    placeholder="Address of Chamber" />
                                <span class="text-danger error-text address_of_chamber_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="address_of_residence" label="Address of Residence"
                                    star="*" />
                                <x-lims.forms.input.text name="address_of_residence" id="address_of_residence"
                                    placeholder="Address of Residence" />
                                <span class="text-danger error-text address_of_residence_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="specialized_practicing_area"
                                    label="Specialized Practicing Area" star="*" />
                                <x-lims.forms.input.text name="specialized_practicing_area"
                                    id="specialized_practicing_area" placeholder="Specialized Practicing Area" />
                                <span class="text-danger error-text specialized_practicing_area_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="professional_experience"
                                    label="Professional Experience" star="*" />
                                <x-lims.forms.input.text name="professional_experience" id="professional_experience"
                                    placeholder="Professional Experience" />
                                <span class="text-danger error-text professional_experience_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_conducted" label="Case Conducted"
                                    star="*" />
                                <x-lims.forms.input.text name="case_conducted" id="case_conducted"
                                    placeholder="Case Conducted" />
                                <span class="text-danger error-text case_conducted_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="references" label="References" star="*" />
                                <x-lims.forms.input.text name="references" id="references"
                                    placeholder="References" />
                                <span class="text-danger error-text references_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="remarks" label="Remarks" star="*" />
                                <x-lims.forms.input.textarea name="remarks" id="remarks" />
                                <span class="text-danger error-text remarks_error"></span>
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
                            id="add_panel_lawyer_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="add_panel_lawyer_btn_span">
                                Create Panel Lawyer</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
