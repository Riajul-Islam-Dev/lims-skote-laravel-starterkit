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
        fetchAllMeetings();

        // Fetch all meeting ajax request
        function fetchAllMeetings() {
            $.ajax({
                url: '{{ route('fetchAllMeeting') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_meetings").html(response);
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

        // Create Meeting ajax request
        $("#create_meeting_form").on("submit", function(e) {
            e.preventDefault();
            var form = this;
            $("#add_meeting_btn_span").text('Saving...');
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
                    // console.log(data);
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find("span." + prefix + "_error").text(val[0]);
                        });
                        toastr.error(data.Message);
                    } else if (data.code == 1) {
                        $(form)[0].reset();
                        $("#addMeetingModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Meeting Added Successfully!',
                            'success'
                        )
                        fetchAllMeetings();
                        toastr.success(data.Message);
                    }
                    $("#add_meeting_btn_span").text('Create Meeting');
                },
            });
        });

        // Edit user ajax request
        $(document).on('click', '.edit_user', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editUser') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response)
                    $("#e_user_id").val(id);
                    $("#e_name").val(response.name);
                    $("#e_email").val(response.email);
                    $("#e_user_password").val("");
                    $("#e_dob").val(response.dob);
                    $("#avatar_show").html('<img src="' + response.avatar +
                        '" width="100" class="img-fluid img-thumbnail">'
                    );
                    $("#e_role_id").val(response.role_id);
                    if (response.status == 1) {
                        $("#e_status").attr("checked", true);
                    } else if (response.status == 0) {
                        $("#e_status").removeAttr("checked");
                    }
                }
            });
        });

        // Update user ajax request
        $(document).on('submit', '#edit_user_form', function(e) {
            e.preventDefault();
            var form = this;
            $("#edit_user_btn_span").text('Updating...');
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
                        $("#editUserModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'User Edited Successfully!',
                            'success'
                        )
                        fetchAllUsers();
                        toastr.success(data.Message);
                    }
                    $("#edit_user_btn_span").text('Update User');
                },
            });
        });

        // Delete Meeting ajax request
        $(document).on('click', '.delete_meeting', function(e) {
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
                        url: '{{ url('delete_meeting') }}',
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
                                fetchAllMeetings();
                                toastr.error(response.Message);
                            } else if (response.code == 1) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Meeting has been deleted.',
                                    'success'
                                )
                                fetchAllMeetings();
                                toastr.success(response.Message);
                            }
                        }
                    });
                }
            })
        });

        // Show Meeting ajax request
        $(document).on('click', '.show_meeting', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('showMeeting') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response)
                    $(".meeting_id").text(response.id);
                    $(".meeting_Division").text(response.division);
                    $(".meeting_District").text(response.district);
                    $(".meeting_start_date").text(response.start_date);
                    $(".meeting_end_date").text(response.end_date);
                    $(".meeting_month").text(response.month);
                    $(".meeting_year").text(response.year);
                    $(".meeting_status").text(response.status);
                }
            });
        });
    });
</script>
