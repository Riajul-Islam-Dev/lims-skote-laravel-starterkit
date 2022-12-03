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
        fetchAllRoles();

        // Fetch all Role ajax request
        function fetchAllRoles() {
            $.ajax({
                url: '{{ route('fetchAllRole') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_roles").html(response);
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

        // Create Role ajax request
        $("#create_role_form").on("submit", function(e) {
            e.preventDefault();
            var form = this;
            $("#add_role_btn_span").text('Saving...');
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
                        $("#addRoleModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Role Added Successfully!',
                            'success'
                        )
                        fetchAllRoles();
                        toastr.success(data.Message);
                    }
                    $("#add_role_btn_span").text('Create Role');

                },
            });
        });

        // Edit Role ajax request
        $(document).on('click', '.edit_role', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editRole') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response)
                    $("#e_role_id").val(id);
                    $("#e_role_name").val(response.role_name);
                    $("#e_role_section").val(response.role_section);
                    if (response.status == 1) {
                        $("#e_status").attr("checked", true);
                    } else if (response.status == 0) {
                        $("#e_status").removeAttr("checked");
                    }
                }
            });
        });

        // Update Role ajax request
        $(document).on('submit', '#edit_role_form', function(e) {
            e.preventDefault();
            var form = this;
            $("#edit_role_btn_span").text('Updating...');
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
                        $("#editRoleModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Role Edited Successfully!',
                            'success'
                        )
                        fetchAllRoles();
                        toastr.success(data.Message);
                    }
                    $("#edit_role_btn_span").text('Update Role');
                },
            });
        });

        // Delete Role ajax request
        $(document).on('click', '.delete_role', function(e) {
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
                        url: '{{ url('delete_role') }}',
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
                                fetchAllRoles();
                                toastr.error(response.Message);
                            } else if (response.code == 1) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Role has been deleted.',
                                    'success'
                                )
                                fetchAllRoles();
                                toastr.success(response.Message);
                            }
                        }
                    });
                }
            })
        });

        // Show Role ajax request
        $(document).on('click', '.show_role', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('showRole') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    $(".role_id").text(response.id);
                    $(".role_name").text(response.role_name);
                    $(".role_section").text(response.role_section);
                    $(".role_status").text(response.status);
                }
            });
        });
    });
</script>