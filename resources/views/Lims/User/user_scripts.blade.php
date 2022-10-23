<script>
    $(document).ready(function() {
        fetchAllUsers();

        function fetchAllUsers() {
            $.ajax({
                url: '{{ route('fetchAllUser') }}',
                method: 'get',
                success: function(response) {
                    $("#show_all_employees").html(response);
                    var table = $('#datatable-buttons').DataTable({
                        // lengthChange: false,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All'],
                        ],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
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

        $("#create_user_form").on("submit", function(e) {
            e.preventDefault();
            var form = this;
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
                        $("#addUserModal").modal("toggle");
                        Swal.fire(
                            'Added!',
                            'User Added Successfully!',
                            'success'
                        )
                        fetchAllUsers();
                        toastr.success(data.Message);
                    }
                },
            });
        });

        $(".delete_user").click(function(event) {
            event.preventDefault();
            if (confirm("Delete Data?")) {
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    url: "{{ url('delete_user') }}" + "/" + id,
                    method: "POST",
                    data: {
                        _token: token,
                        id: id,
                    },
                    success: function(response) {
                        if (response.deleteStatus == 1) {
                            $("#datatable-buttons").load(
                                location.href + " #datatable-buttons"
                            );
                            alert(response.Message);
                        } else if (data.deleteStatus == 0) {
                            alert(response.Message);
                        }
                    },
                });
            }
        });
    });
</script>
