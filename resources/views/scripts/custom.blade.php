<script type="text/javascript">
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        delete_alert().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    success: function (r) {
                        redrawDataTable();
                        success_alert(r.message);
                    },
                    error: function (xhr, status, r) {
                        error_alert(r.message);
                    }
                });
            }
        });
    });
    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();
        delete_alert().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    success: function (r) {
                        redrawDataTable();
                        alertify.success(r.message);
                        $('#row-'+r.item.id).remove();
                    },
                    error: function (xhr, status, r) {
                        alertify.error(r.message);
                    }
                });
            }
        });
    });
    $(document).on('change', '.get-batch-students', function (e) {
        e.preventDefault();
        const course_id = $('#course_id').val();
        const url = '/admin/batches/' + $(this).val() + '/users?course_id='+course_id;

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // Use map to generate options for each user, then join them into a single string
                const options = response.map(r => `<option value="${r.id}">${r.name}</option>`).join('');

                // Add the generated options to the select element
                $('.select2-multiple').html(options);
            },
            error: function (xhr, status, error) {
                // alertify.error('Error: ' + error);
            }
        });
    });
</script>
