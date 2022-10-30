<div class="container">
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit new user:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the User form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateUser') }}" method="POST" id="edit_user_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_user_id" name="e_user_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_name" label="User Name" star="*" />
                                <x-lims.forms.input.text name="e_name" id="e_name" placeholder="User Name" />
                                <span class="text-danger error-text e_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_email" label="Email Address" star="*" />
                                <x-lims.forms.input.email name="e_email" id="e_email" placeholder="Email Address" />
                                <span class="text-danger error-text e_email_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_user_password" label="Password" star="*" />
                                <x-lims.forms.input.password name="e_user_password" id="e_user_password"
                                    placeholder="Password" />
                                <span class="text-danger error-text e_user_password_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_dob" label="Date of Birth" star="*" />
                                <x-lims.forms.input.date name="e_dob" id="e_dob" placeholder="Date of Birth" />
                                <span class="text-danger error-text e_dob_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_avatar" label="Upload Avatar" star="*" />
                                <x-lims.forms.input.file name="e_avatar" id="e_avatar" placeholder="Upload Avatar" />
                                <span class="text-danger error-text e_avatar_error"></span>
                                <div class="py-3 text-center bg-light" id="avatar_show"></div>
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
                            id="edit_user_btn"><i class="bx bx-check-double label-icon"></i><span id="edit_user_btn_span"> Update User</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
