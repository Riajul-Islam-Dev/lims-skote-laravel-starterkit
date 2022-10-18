<script>
    $(document).ready(function() {
        $("#create_user_form").on("submit", function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('saveUser') }}",
                method: "POST",
                data: new FormData(this),
                dataType: "JSON",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(document).find("span.error-text").text("");
                },
                success: function(data) {
                    if (data.saveStatus == 1) {
                        $("#create_user_form")[0].reset();
                        $("#addUserModal").modal("toggle");
                        $("#user_data_table").load(
                            location.href + " #user_data_table"
                        );
                        alert(data.Message);
                    } else if (data.saveStatus == 0) {
                        $.each(data.error, function(prefix, val) {
                            $("span." + prefix + "_error").text(val[0]);
                        });
                        alert(data.Message);
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
                            $("#user_data_table").load(
                                location.href + " #user_data_table"
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
