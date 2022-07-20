<script>

    $(document).on('click', '.subscribe-btn', function(e) {
        var $this = $(this);
        e.preventDefault();
        var email = $this.parents('form').find('input').val();
        if ($this.parents('form').parsley().validate()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('subscribe.store') }}",
                method: "post",
                data: {
                    email: email
                },
                error: function(response) {
                    var errors = '';
                    $.each(response.responseJSON.errors, function(i, item) {
                        errors = errors + item + "<br>";
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errors,
                        })
                    });
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $.notify(response.message, "success");
                    } else {
                        $.notify(response.message, "error");
                    }
                },
            });
        }
    })
</script>
