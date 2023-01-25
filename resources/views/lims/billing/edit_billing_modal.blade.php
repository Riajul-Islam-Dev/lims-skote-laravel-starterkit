<div class="container">
    <div class="modal fade" id="editBillingModal" tabindex="-1" aria-labelledby="editBillingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBillingModalLabel">Edit new user:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the Billing form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateBilling') }}" method="POST" id="edit_user_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_bill_id" name="e_bill_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_invoice_id" label="Invoice ID" star="*" />
                                <x-lims.forms.input.text name="e_invoice_id" id="e_invoice_id"
                                    placeholder="Invoice ID" />
                                <span class="text-danger error-text e_invoice_id_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_id" label="Case ID" star="*" />
                                <x-lims.forms.input.text name="e_case_id" id="e_case_id" placeholder="Case ID" />
                                <span class="text-danger error-text e_case_id_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_case_type" label="Case Type" star="*" />
                                <x-lims.forms.input.select name="e_case_type" id="e_case_type" class="edit_select">
                                    <option value="" disabled>Select Case Type</option>
                                    <option value="1">Civil</option>
                                    <option value="2">Criminal</option>
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_case_type_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_lawyer_id" label="Lawyer Name" star="*" />
                                <x-lims.forms.input.select name="e_lawyer_id" id="e_lawyer_id" class="edit_select">
                                    <option value="" disabled>Select Lawyer</option>
                                    @foreach ($lawyer_data as $lawyer_data_individual)
                                        @foreach ($user_data as $user_data_individual)
                                            @if ($user_data_individual->id == $lawyer_data_individual->user_id)
                                                <option value="{{ $user_data_individual->id }}">
                                                    {{ $user_data_individual->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_lawyer_id_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_bill_amount" label="Bill Amount" star="*" />
                                <x-lims.forms.input.text name="e_bill_amount" id="e_bill_amount"
                                    placeholder="Bill Amount" />
                                <span class="text-danger error-text e_bill_amount_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_bill_date" label="Bill Date" star="*" />
                                <x-lims.forms.input.datepicker name="e_bill_date" id="e_bill_date"
                                    placeholder="Bill Date" datepicker_id="e_bill_date_datepicker" />
                                <span class="text-danger error-text e_bill_date_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district" label="District" star="*" />
                                <x-lims.forms.input.select name="e_district" id="e_district" class="edit_select">
                                    <option value="" disabled>Select District</option>
                                    @foreach ($district_data as $district_data_individual)
                                        <option value="{{ $district_data_individual->district_code }}">
                                            {{ $district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_bank_name" label="Bank Name" star="*" />
                                <x-lims.forms.input.select name="e_bank_name" id="e_bank_name" class="edit_select">
                                    <option value="" disabled>Select Bank</option>
                                    @foreach ($bank_data as $bank_data_individual)
                                        <option value="{{ $bank_data_individual->bank_code }}">
                                            {{ $bank_data_individual->bank_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_bank_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_cheque_number" label="Cheque Number"
                                    star="*" />
                                <x-lims.forms.input.text name="e_cheque_number" id="e_cheque_number"
                                    placeholder="Cheque Number" />
                                <span class="text-danger error-text e_cheque_number_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_bill_status" label="Bill Status" star="*" />
                                <x-lims.forms.input.toggle name="e_bill_status" id="e_bill_status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon"></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="edit_user_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="edit_user_btn_span"> Update Bill</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
