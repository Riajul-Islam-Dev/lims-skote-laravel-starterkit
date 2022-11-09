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
        $('select').on('change', function(e) {
            e.preventDefault();
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;

            $.ajax({
                url: '{{ route('getUserAvatar') }}',
                method: 'get',
                data: {
                    id: valueSelected,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $("#user_avatar_show").html('<img src="' + response.avatar +
                        '" width="100" class="img-fluid img-thumbnail">'
                    );
                }
            });
        });

        fetchAllPanelLawyers();

        // Fetch all Panel Lawyer ajax request
        function fetchAllPanelLawyers() {
            $.ajax({
                url: '{{ route('fetchAllPanelLawyer') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_panel_lawyers").html(response);
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

        // Create Panel Lawyer  ajax request
        $("#create_panel_lawyer_form").on("submit", function(e) {
            e.preventDefault();
            var form = this;
            $("#add_panel_lawyer_btn_span").text('Saving...');
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
                        $("#addPanelLawyerModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Panel Lawyer Added Successfully!',
                            'success'
                        )
                        fetchAllPanelLawyers();
                        toastr.success(data.Message);
                    }
                    $("#add_panel_lawyer_btn_span").text('Create Panel Lawyer');
                },
            });
        });

        // Edit Panel Lawyer ajax request
        $(document).on('click', '.edit_panel_lawyer', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editPanelLawyer') }}',
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

        // Delete Panel Lawyer ajax request
        $(document).on('click', '.delete_panel_lawyer', function(e) {
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
                        url: '{{ url('delete_panel_lawyer') }}',
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
                                fetchAllPanelLawyers();
                                toastr.error(response.Message);
                            } else if (response.code == 1) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Panel Lawyer has been deleted.',
                                    'success'
                                )
                                fetchAllPanelLawyers();
                                toastr.success(response.Message);
                            }
                        }
                    });
                }
            })
        });

        // Show Panel Lawyer ajax request
        $(document).on('click', '.show_panel_lawyer', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('showPanelLawyer') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    $(".pl_avatar").attr('src', response.avatar);
                    $(".pl_name").text(response.name);
                    $(".pl_email").text(response.email);
                    $(".pl_contact_number").text(response.contact_number);
                    $(".pl_dob").text(response.dob);
                    if (response.status == 1) {
                        $(".pl_status").text("Active");
                    } else {
                        $(".pl_status").text("Inactive");
                    }
                    $(".pl_address_of_residence").text(response.address_of_residence);
                    $(".pl_father_name").text(response.father_name);
                    $(".pl_mother_name").text(response.mother_name);
                    $(".pl_nationality").text(response.nationality);
                    $(".pl_religion").text(response.religion);
                    $(".pl_date_of_enrollment").text(response.date_of_enrollment);
                    $(".pl_name_of_the_bar").text(response.name_of_the_bar);
                    $(".pl_membership_number").text(response.membership_number);
                    $(".pl_address_of_chamber").text(response.address_of_chamber);
                    $(".pl_specialized_practicing_area").text(response
                        .specialized_practicing_area);
                    $(".pl_professional_experience").text(response.professional_experience);
                    $(".pl_case_conducted").text(response.case_conducted);
                    $(".pl_references").text(response.references);
                    $(".pl_remarks").text(response.remarks);
                }
            });
        });
    });
</script>
