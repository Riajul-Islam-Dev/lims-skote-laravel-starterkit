<div class="row" id="bill_report_data_table">
    <div class="col-12" id="bill_report_data_table_col">
        <div class="card">
            <div class="card-body">

                <div id="show_all_bill_reports"></div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title text-white">Bill Report of Cases:</h4>
                            <p class="card-title-desc text-white">Filter by searching</p>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Search by Case</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Search by Lawyer</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="case_type" label="Case Type" star="*" />
                                            <x-lims.forms.input.select name="case_type" id="case_type"
                                                class="add_select">
                                                <option value="case_type" disabled selected>Select Case Type</option>
                                                <option value="1">Civil</option>
                                                <option value="2">Criminal</option>
                                            </x-lims.forms.input.select>
                                            <span class="text-danger error-text case_type_error"></span>
                                        </div>
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="case_id" label="Case ID" star="*" />
                                            <x-lims.forms.input.text name="case_id" id="case_id"
                                                placeholder="Case ID" />
                                            <span class="text-danger error-text case_id_error"></span>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="date1" label="Date" star="*" />
                                            <x-lims.forms.input.daterange id="date1" name_start="start_date1"
                                                name_end="end_date1" id_start="start_date1" id_end="end_date1" />
                                            <span class="text-danger error-text start_date1_error"></span>
                                            <span class="text-danger error-text end_date1_error"></span>
                                        </div>
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="month1" label="Month" star="*" />
                                            <x-lims.forms.input.month name="month1" id="month1" placeholder="Month" />
                                            <span class="text-danger error-text month1_error"></span>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="year1" label="Year" star="*" />
                                            <x-lims.forms.input.year name="year1" id="year1" placeholder="Year" />
                                            <span class="text-danger error-text year1_error"></span>
                                        </div>
                                        <div class="col-6">
                                            <button type="button"
                                                class="btn btn-warning my-3 waves-effect btn-label waves-light float-end"
                                                data-bs-toggle="modal" data-bs-target="#addBillingModal"><i
                                                    class="bx bx-search-alt label-icon"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                    <div>
                                        <br><br><br>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="lawyer_id" label="Lawyer Name" star="*" />
                                            <x-lims.forms.input.select name="lawyer_id" id="lawyer_id"
                                                class="add_select">
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
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="date2" label="Date" star="*" />
                                            <x-lims.forms.input.daterange id="date2" name_start="start_date2"
                                                name_end="end_date2" id_start="start_date2" id_end="end_date2" />
                                            <span class="text-danger error-text start_date2_error"></span>
                                            <span class="text-danger error-text end_date2_error"></span>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="month2" label="Month" star="*" />
                                            <x-lims.forms.input.month name="month2" id="month2" placeholder="Month" />
                                            <span class="text-danger error-text month2_error"></span>
                                        </div>
                                        <div class="col-6">
                                            <x-lims.forms.input.label for="year2" label="Year" star="*" />
                                            <x-lims.forms.input.year name="year2" id="year2" placeholder="Year" />
                                            <span class="text-danger error-text year2_error"></span>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-12">
                                            <button type="button"
                                                class="btn btn-warning my-3 waves-effect btn-label waves-light float-end"
                                                data-bs-toggle="modal" data-bs-target="#addBillingModal"><i
                                                    class="bx bx-search-alt label-icon"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                    <div>
                                        <br><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->