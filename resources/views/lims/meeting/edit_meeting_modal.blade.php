<div class="container">
    <div class="modal fade" id="editMeetingModal" tabindex="-1" aria-labelledby="editMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMeetingModalLabel">Edit new Meeting:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the Meeting form carefully to edit. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('updateMeeting') }}" method="POST" id="edit_meeting_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="e_meeting_id" name="e_meeting_id">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_division" label="Division" star="*" />
                                <x-lims.forms.input.select name="e_division" id="e_division">
                                    <option value="option_select" disabled selected>Division</option>
                                    @foreach ($division_data as $division_data_individual)
                                        <option value="{{ $division_data_individual->id }}">
                                            {{ $division_data_individual->division_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_division_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_district" label="District" star="*" />
                                <x-lims.forms.input.select name="e_district" id="e_district">
                                    <option value="option_select" disabled selected>District</option>
                                    @foreach ($district_data as $district_data_individual)
                                        <option value="{{ $district_data_individual->id }}">
                                            {{ $district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text e_district_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_date" label="Date" star="*" />
                                <x-lims.forms.input.daterange id="e_date" name_start="e_start_date"
                                    name_end="e_end_date" id_start="e_start_date" id_end="e_end_date" />
                                <span class="text-danger error-text e_start_date_error"></span>
                                <span class="text-danger error-text e_end_date_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_month" label="Month" star="*" />
                                <x-lims.forms.input.month name="e_month" id="e_month" placeholder="Month"
                                    datepicker_id="e_month_datepicker" />
                                <span class="text-danger error-text e_month_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_year" label="Year" star="*" />
                                <x-lims.forms.input.year name="e_year" id="e_year" placeholder="Year"
                                    datepicker_id="e_year_datepicker" />
                                <span class="text-danger error-text e_year_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="e_status" label="Meeting held" star="*" />
                                <x-lims.forms.input.toggle name="e_status" id="e_status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon"></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="edit_meeting_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="edit_meeting_btn_span"> Update Meeting</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
