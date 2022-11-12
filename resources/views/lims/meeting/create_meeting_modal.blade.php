<div class="container">
    <div class="modal fade" id="addMeetingModal" tabindex="-1" aria-labelledby="addMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMeetingModalLabel">Add new Meeting:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h6 class="mt-2 ms-3">Please fill up the new Meeting form carefully. Fields marked with <span
                        style="color: red">*</span>
                    are required.</h6>
                <form action="{{ route('saveMeeting') }}" method="POST" id="create_meeting_form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="division" label="Division" star="*" />
                                <x-lims.forms.input.select name="division" id="division">
                                    <option value="option_select" disabled selected>Division</option>
                                    @foreach ($division_data as $division_data_individual)
                                        <option value="{{ $division_data_individual->id }}">
                                            {{ $division_data_individual->division_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text division_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="district" label="District" star="*" />
                                <x-lims.forms.input.select name="district" id="district">
                                    <option value="option_select" disabled selected>District</option>
                                    @foreach ($district_data as $district_data_individual)
                                        <option value="{{ $district_data_individual->id }}">
                                            {{ $district_data_individual->district_name }}</option>
                                    @endforeach
                                </x-lims.forms.input.select>
                                <span class="text-danger error-text district_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="date" label="Date" star="*" />
                                <x-lims.forms.input.daterange id="date" name_start="start_date" name_end="end_date"
                                    id_start="start_date" id_end="end_date" />
                                <span class="text-danger error-text start_date_error"></span>
                                <span class="text-danger error-text end_date_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="month" label="Month" star="*" />
                                <x-lims.forms.input.month name="month" id="month" placeholder="Month" />
                                <span class="text-danger error-text month_error"></span>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-6">
                                <x-lims.forms.input.label for="year" label="Year" star="*" />
                                <x-lims.forms.input.year name="year" id="year" placeholder="Year" />
                                <span class="text-danger error-text year_error"></span>
                            </div>
                            <div class="col-6">
                                <x-lims.forms.input.label for="status" label="Meeting held" star="*" />
                                <x-lims.forms.input.toggle name="status" id="status" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect btn-label waves-light"
                            data-bs-dismiss="modal"><i class="bx bx-block label-icon "></i> Close</button>
                        <button type="submit" class="btn btn-success waves-effect btn-label waves-light"
                            id="add_meeting_btn"><i class="bx bx-check-double label-icon"></i><span
                                id="add_meeting_btn_span">
                                Create Meeting</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
