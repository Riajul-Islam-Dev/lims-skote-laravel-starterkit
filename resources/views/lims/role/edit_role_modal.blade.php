<div class="container">
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit new Idea:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the Role form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateRole') }}" method="POST" id="edit_role_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_role_id" name="e_role_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_role_name" label="Role Name" star="*" />
                                <x-lims.forms.input.text name="e_role_name" id="e_role_name" placeholder="Role Name" />
                                <span class="text-danger error-text e_role_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_role_section" label="Role Section" star="*" />
                                <x-lims.forms.input.select name="e_role_section" id="e_role_section">
                                    <option value="option_select" disabled selected>Role Section</option>
                                    @foreach ($show_role_section_data as $show_role_section_data_individual)
                                    <option value="{{ $show_role_section_data_individual->id }}">
                                        {{ $show_role_section_data_individual->role_section_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_role_section_error"></span>
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
                            id="edit_role_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="edit_role_btn_span"> Update Idea</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>