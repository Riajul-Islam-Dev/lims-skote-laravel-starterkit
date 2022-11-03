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
            fetchAllDivision();

            // Fetch all Divisions ajax request
            function fetchAllDivision() {
                $.ajax({
                    url: '{{ route('fetchAllDivision') }}',
                    method: 'get',
                    success: function(response) {
                        $("#show_all_divisions").html(response);
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

            // Create Division ajax request
            $("#create_division_form").on("submit", function(e) {
                e.preventDefault();
                var form = this;
                $("#add_division_btn_span").text('Saving...');
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
                            $("#addDivisionModal").modal("hide");
                            Swal.fire(
                                'Added!',
                                'Division Added Successfully!',
                                'success'
                            )
                            fetchAllDivision();
                            toastr.success(data.Message);
                        }
                        $("#add_division_btn_span").text('Create Division');

                    },
                });
            });

            // Edit Division ajax request
            $(document).on('click', '.edit_division', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('editDivision') }}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#e_division_id").val(id);
                        $("#e_division_name").val(response.division_name);
                        $("#e_division_code").val(response.division_code);
                        if (response.status == 1) {
                            $("#e_status").attr("checked", true);
                        } else if (response.status == 0) {
                            $("#e_status").removeAttr("checked");
                        }
                    }
                });
            });

            // Update Division ajax request
            $(document).on('submit', '#edit_division_form', function(e) {
                e.preventDefault();
                var form = this;
                $("#edit_division_btn_span").text('Updating...');
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
                            $("#editDivisionModal").modal("hide");
                            Swal.fire(
                                'Added!',
                                'Division Edited Successfully!',
                                'success'
                            )
                            fetchAllDivision();
                            toastr.success(data.Message);
                        }
                        $("#edit_division_btn_span").text('Update Division');
                    },
                });
            });

            // Delete Division ajax request
            $(document).on('click', '.delete_division', function(e) {
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
                            url: '{{ url('delete_division') }}',
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
                                    fetchAllDivision();
                                    toastr.error(response.Message);
                                } else if (response.code == 1) {
                                    console.log(response);
                                    Swal.fire(
                                        'Deleted!',
                                        'Division has been deleted.',
                                        'success'
                                    )
                                    fetchAllDivision();
                                    toastr.success(response.Message);
                                }
                            }
                        });
                    }
                })
            });
        });
    </script>
