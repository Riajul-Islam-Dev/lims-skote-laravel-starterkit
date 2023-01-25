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
        fetchAllBillings();

        // Fetch all billing ajax request
        function fetchAllBillings() {
            $.ajax({
                url: '{{ route('fetchAllBilling') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_billings").html(response);
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

        // Create billing ajax request
        $("#create_billing_form").on("submit", function(e) {
            e.preventDefault();
            var form = this;
            $("#add_billing_btn_span").text('Saving...');
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
                        $("#addBillingModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Billing Added Successfully!',
                            'success'
                        )
                        fetchAllBillings();
                        toastr.success(data.Message);
                    }
                    $("#add_billing_btn_span").text('Create Bill');

                },
            });
        });

        // Edit Billing ajax request
        $(document).on('click', '.edit_billing', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editBilling') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response)
                    $("#e_bill_id").val(id);
                    $("#e_invoice_id").val(response.invoice_id);
                    $("#e_case_id").val(response.case_id);
                    $("#e_case_type").val(response.case_type).change();
                    $("#e_lawyer_id").val(response.lawyer_id).change();
                    $("#e_bill_amount").val(response.bill_amount);
                    $("#e_bill_date").val(response.bill_date);
                    $("#e_district").val(response.district).change();
                    $("#e_bank_name").val(response.bank_name).change();
                    $("#e_cheque_number").val(response.cheque_number);
                    if (response.bill_status == 1) {
                        $("#e_bill_status").attr("checked", true);
                    } else if (response.bill_status == 0) {
                        $("#e_bill_status").removeAttr("checked");
                    }
                }
            });
        });

        // Update Billing ajax request
        $(document).on('submit', '#edit_billing_form', function(e) {
            e.preventDefault();
            var form = this;
            $("#edit_billing_btn_span").text('Updating...');
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
                    console.log(data)
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find("span." + prefix + "_error").text(val[0]);
                        });
                        toastr.error(data.Message);
                    } else if (data.code == 1) {
                        // console.log(data.Message)
                        $(form)[0].reset();
                        $("#editBillingModal").modal("hide");
                        Swal.fire(
                            'Added!',
                            'Billing Edited Successfully!',
                            'success'
                        )
                        fetchAllbillings();
                        toastr.success(data.Message);
                    }
                    $("#edit_billing_btn_span").text('Update Billing');
                },
            });
        });

        // Delete Billing ajax request
        $(document).on('click', '.delete_billing', function(e) {
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
                        url: '{{ url('delete_billing') }}',
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
                                fetchAllBillings();
                                toastr.error(response.Message);
                            } else if (response.code == 1) {
                                console.log(response);
                                Swal.fire(
                                    'Deleted!',
                                    'Billing has been deleted.',
                                    'success'
                                )
                                fetchAllBillings();
                                toastr.success(response.Message);
                            }
                        }
                    });
                }
            })
        });

        $('.add_select').select2({
            dropdownParent: $('#addBillingModal')
        });

        $('.edit_select').select2({
            dropdownParent: $('#editBillingModal')
        });
    });
</script>