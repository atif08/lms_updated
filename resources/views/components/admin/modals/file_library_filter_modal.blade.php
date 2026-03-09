<div id="sheetItemModal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Share</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('file-libraries.share')}}" class="column-mapping" id="shareForm">
                    @csrf
                    <input type="hidden" name="selectedUserIds" id="selected-user-ids">
                    <input type="hidden" name="selectedFileIds" id="selected-file-ids">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"> <input type="checkbox" id="selectAll"> Select All</th>
                            <th scope="col">Name</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="selectedUsers[]" class="user-checkbox" value="{{ $user->id }}">
                            </td>
{{--                            <td>{{ $loop->iteration }}</td>--}}
                            <td>{{$user->name}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect waves-light"><i class="fas fa-window-close"></i>Clear</button>
                        {{--                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="shareSelectedUsers()">Share</button>--}}
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Share Files</button>
                    </div>
                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Checkbox click handlers
        $('#select-all').on('click', function() {
            $('.select-item').prop('checked', this.checked);
        });

        $('.select-item').on('change', function() {
            if ($('.select-item:checked').length === $('.select-item').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });

        // Individual checkbox click
        $('.user-checkbox').change(function() {
            if (!$(this).prop('checked')) {
                $('#selectAll').prop('checked', false);
            }
        });

        // Form submission handling
        $('#shareForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var selectedUserIds = [];
            var selectedFileIds = [];

            // Collect IDs of selected users
            $('.user-checkbox:checked').each(function() {
                selectedUserIds.push($(this).val());
            });

            // Collect IDs of selected files
            $('.select-item:checked').each(function() {
                selectedFileIds.push($(this).val());
            });

            // Check if any files are selected
            if (selectedFileIds.length === 0) {
                alert('Please select at least one file to share.');
                return false; // Cancel form submission
            }

            // Set hidden inputs for selected user IDs and file IDs
            $('#selected-user-ids').val(selectedUserIds.join(','));
            $('#selected-file-ids').val(selectedFileIds.join(','));

            // Submit the form
            this.submit();
        });
    });


</script>
