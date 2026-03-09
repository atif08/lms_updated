{!! form($createForm) !!}
<script>
    $(document).on('submit', '#topicForm', function (e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        let formData = new FormData(this);

        form.find('.text-danger').text('');

        $.ajax({
            url: url,
            method: form.attr('method') || 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                $('#addTopicModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    console.log(errors);

                    // Clear previous errors
                    $('#form-errors').html('');

                    // Build <ul> with all error messages
                    let $ul = $('<ul></ul>');
                    $.each(errors, function(key, value) {
                        $ul.append('<li>' + value[0] + '</li>');
                    });

                    // Append the list to the error container
                    $('.text-danger').html($ul);
                }
            }

        });
    });


</script>
