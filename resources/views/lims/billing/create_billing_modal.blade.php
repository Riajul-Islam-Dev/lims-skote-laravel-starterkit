<div class="container">
    <div class="modal fade" id="addBillingModal" tabindex="-1" aria-labelledby="addBillingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBillingModalLabel">Add new Billing:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Billing form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveBilling') }}" method="POST" id="create_billing_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="invoice_id" label="Invoice ID" star="*" />
                                <x-lims.forms.input.text name="invoice_id" id="invoice_id" placeholder="Invoice ID" />
                                <span class="text-danger error-text invoice_id_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_id" label="Case ID" star="*" />
                                <x-lims.forms.input.text name="case_id" id="case_id" placeholder="Case ID" />
                                <span class="text-danger error-text case_id_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_type" label="Case Type" star="*" />
                                <x-lims.forms.input.select name="case_type" id="case_type" class="add_select">
                                    <option value="case_type" disabled selected>Select Case Type</option>
                                    <option value="1">Civil</option>
                                    <option value="2">Criminal</option>
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text case_type_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="lawyer_id" label="Lawyer Name" star="*" />
                                <x-lims.forms.input.select name="lawyer_id" id="lawyer_id" class="add_select">
                                    <option value="option_select" disabled selected>Select Lawyer</option>
                                    @foreach ($lawyer_data as $lawyer_data_individual)
                                    @foreach ($user_data as $user_data_individual)
                                    @if ($user_data_individual->id == $lawyer_data_individual->user_id)
                                    <option value="{{ $user_data_individual->id }}">
                                        {{ $user_data_individual->name }}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text lawyer_id_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="bill_amount" label="Bill Amount" star="*" />
                                <x-lims.forms.input.text name="bill_amount" id="bill_amount"
                                    placeholder="Bill Amount" />
                                <span class="text-danger error-text bill_amount_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="bill_date" label="Bill Date" star="*" />
                                <x-lims.forms.input.datepicker name="bill_date" id="bill_date" placeholder="Bill Date"
                                    datepicker_id="bill_date_datepicker" />
                                <span class="text-danger error-text bill_date_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="district" label="District" star="*" />
                                <x-lims.forms.input.select name="district" id="district" class="add_select">
                                    <option value="option_select" disabled selected>Select District</option>
                                    @foreach ($district_data as $district_data_individual)
                                    <option value="{{ $district_data_individual->district_code }}">
                                        {{ $district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text district_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="bank_name" label="Bank Name" star="*" />
                                <x-lims.forms.input.select name="bank_name" id="bank_name" class="add_select">
                                    <option value="option_select" disabled selected>Select Bank</option>
                                    @foreach ($bank_data as $bank_data_individual)
                                    <option value="{{ $bank_data_individual->bank_code }}">
                                        {{ $bank_data_individual->bank_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text bank_name_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="cheque_number" label="Cheque Number" star="*" />
                                <x-lims.forms.input.text name="cheque_number" id="cheque_number"
                                    placeholder="Cheque Number" />
                                <span class="text-danger error-text cheque_number_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="status" label="Bill Status" star="*" />
                                <x-lims.forms.input.toggle name="status" id="status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon "></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="add_billing_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="add_billing_btn_span">
                                Create Billing</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>