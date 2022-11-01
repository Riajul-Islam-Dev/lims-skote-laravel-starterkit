    <!-- Date picker Js -->
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>

    <!-- Sweet alert js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- toastr js -->
    <script src="{{ URL::asset('assets/libs/toastr/toastr.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            fetchAllCivilCase();

            // Fetch all Civil Cases ajax request
            function fetchAllCivilCase() {
                $.ajax({
                    url: '{{ route('fetchAllCivilCase') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_civil_cases").html(response);
                        var table = $('#datatable-buttons').DataTable({
                            // lengthChange: false,
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                            ],
                            buttons: ['copy', 'excel', 'pdf', 'colvis'],
                            order: [
                                [0, 'asc']
                            ],
                        });
                        table.buttons().container().appendTo(
                            '#datatable-buttons_wrapper .col-md-6:eq(0)');
                        $(".dataTables_length select").addClass('form-select form-select-sm');
                    }
                });
            }

            toastr.options.preventDuplicates = true;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            // Create Civil Case ajax request
            $("#create_civil_case_form").on("submit", function(e) {
                e.preventDefault();
                var form = this;
                $("#add_civil_case_btn_span").text('Saving...');
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        $(form).find("span.error-text").text("");
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find("span." + prefix + "_error").text(val[0]);
                            });
                            toastr.error(data.Message);
                        } else if (data.code == 1) {
                            $(form)[0].reset();
                            $("#addCivilCaseModal").modal("hide");
                            Swal.fire(
                                'Added!',
                                'Civil Case Added Successfully!',
                                'success'
                            )
                            fetchAllCivilCase();
                            toastr.success(data.Message);
                        }
                        $("#add_civil_case_btn_span").text('Create Civil Case');

                    },
                });
            });

            // Edit Civil Case ajax request
            $(document).on('click', '.edit_civil_case', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('editCivilCase') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#e_civil_case_id").val(id);
                        $("#e_filed_case_name").val(response.filed_case_name);
                        $("#e_case_category").val(response.case_category);
                        $("#e_court_name").val(response.court_name);
                        $("#e_division").val(response.division);
                        $("#e_district").val(response.district);
                        $("#e_region").val(response.region);
                        $("#e_plaintiff_name").val(response.plaintiff_name);
                        $("#e_defendant_name").val(response.defendant_name);
                        $("#e_case_filling_date").val(response.case_filling_date);
                        $("#e_assigned_lawyer_name").val(response.assigned_lawyer_name);
                        $("#e_case_created_by").val(response.case_created_by);
                        if (response.admin_approval == 1) {
                            $("#e_admin_approval").attr("checked", true);
                        } else if (response.admin_approval == 0) {
                            $("#e_admin_approval").removeAttr("checked");
                        }
                        if (response.document_status == 1) {
                            $("#e_document_status").attr("checked", true);
                        } else if (response.document_status == 0) {
                            $("#e_document_status").removeAttr("checked");
                        }
                        if (response.status == 1) {
                            $("#e_status").attr("checked", true);
                        } else if (response.status == 0) {
                            $("#e_status").removeAttr("checked");
                        }
                    }
                });
            });

            // Update Civil Case ajax request
            $(document).on('submit', '#edit_civil_case_form', function(e) {
                e.preventDefault();
                var form = this;
                $("#edit_civil_case_btn_span").text('Updating...');
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        $(form).find("span.error-text").text("");
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            $.each(data.error, function(prefix, val) {
                                $(form).find("span." + prefix + "_error").text(val[0]);
                            });
                            toastr.error(data.Message);
                        } else if (data.code == 1) {
                            // console.log(data.Message)
                            $(form)[0].reset();
                            $("#editCivilCaseModal").modal("hide");
                            Swal.fire(
                                'Added!',
                                'Civil Case Edited Successfully!',
                                'success'
                            )
                            fetchAllCivilCase();
                            toastr.success(data.Message);
                        }
                        $("#edit_civil_case_btn_span").text('Update Civil Case');
                    },
                });
            });

            // Delete Civil Case ajax request
            $(document).on('click', '.delete_civil_case', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let csrf = '{{ csrf_token() }}';
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#34C38F',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('delete_civil_case') }}',
                            method: 'delete',
                            data: {
                                id: id,
                                _token: csrf
                            },
                            success: function(response) {
                                if (response.code == 0) {
                                    console.log(response);
                                    Swal.fire(
                                        'Caution!',
                                        'Something went wrong!',
                                        'error'
                                    )
                                    fetchAllCivilCase();
                                    toastr.error(response.Message);
                                } else if (response.code == 1) {
                                    console.log(response);
                                    Swal.fire(
                                        'Deleted!',
                                        'Civil Case has been deleted.',
                                        'success'
                                    )
                                    fetchAllCivilCase();
                                    toastr.success(response.Message);
                                }
                            }
                        });
                    }
                })
            });
        });
    </script>
