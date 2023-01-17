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
                <form action="{{ route('saveBilling') }}" method="POST" id="create_user_form"
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
                                <x-lims.forms.input.label for="cae_id" label="Case ID" star="*" />
                                <x-lims.forms.input.text name="cae_id" id="cae_id" placeholder="Case ID" />
                                <span class="text-danger error-text cae_id_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="case_type" label="Case Type" star="*" />
                                <div>
                                    <select class="form-control select2" style="width:100% !important">
                                        <option>Select</option>
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                        </optgroup>
                                    </select>
                                </div>
                                {{--
                                <x-lims.forms.input.text name="case_type" id="case_type" placeholder="Case Type" /> --}}
                                <span class="text-danger error-text case_type_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="lawyer_id" label="Lawyer Name" star="*" />
                                <x-lims.forms.input.text name="lawyer_id" id="lawyer_id" placeholder="Lawyer Name" />
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
                                <x-lims.forms.input.text name="bill_date" id="bill_date" placeholder="Bill Date" />
                                <span class="text-danger error-text bill_date_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="generated_by" label="Generated By" star="*" />
                                <x-lims.forms.input.text name="generated_by" id="generated_by"
                                    placeholder="Generated By" />
                                <span class="text-danger error-text generated_by_error"></span>
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
                                <x-lims.forms.input.label for="bank_name" label="Bank Name" star="*" />
                                <x-lims.forms.input.text name="bank_name" id="bank_name" placeholder="Bank Name" />
                                <span class="text-danger error-text bank_name_error"></span>
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
                            id="add_user_btn"><i class="bx bx-check-double label-icon"></i><span id="add_user_btn_span">
                                Create User</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>