<div class="container">
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add new user:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new User form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <h6 id="message"></h6>
                <form method="post" id="create_user_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="name" label="User Name" star="*" />
                                <x-lims.forms.input.text name="name" id="name" placeholder="User Name" />
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="email" label="Email Address" star="*" />
                                <x-lims.forms.input.email name="email" id="email" placeholder="Email Address" />
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="user_password" label="Password" star="*" />
                                <x-lims.forms.input.password name="user_password" id="user_password"
                                    placeholder="Password" />
                                <span class="text-danger error-text user_password_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="dob" label="Date of Birth" star="*" />
                                <x-lims.forms.input.date name="dob" id="dob" placeholder="Date of Birth" />
                                <span class="text-danger error-text dob_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="avatar" label="Upload Avatar" star="*" />
                                <x-lims.forms.input.file name="avatar" id="avatar" placeholder="Upload Avatar" />
                                <span class="text-danger error-text avatar_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="status" label="Status" star="*" />
                                <x-lims.forms.input.toggle name="status" id="status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>