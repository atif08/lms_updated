{!! form($form) !!}

<script>
    $(document).on('submit', '#submit-assignment', function (e) {

        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            beforeSend: function () {
                $('.assignment-submit-button').prop('disabled', true);
            },
            success: function (response) {
                alert('Assignment submitted successfully!');
                location.reload();
            },
            error: function (xhr) {
                let errorMessage = '';

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                $(`.text-danger`).text(errorMessage);
            },
            complete: function () {
                $('.assignment-submit-button').prop('disabled', false);
            }
        });
    });
</script>
