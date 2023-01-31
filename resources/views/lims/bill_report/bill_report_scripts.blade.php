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
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // Search By Case ajax request
        $("#search_by_case_form").on("submit", function(e) {
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
                    }
                },
            });
        });
    });
</script>
