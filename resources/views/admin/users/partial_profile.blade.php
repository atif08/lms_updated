<div class="col-xl-12">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                <span class="d-none d-sm-block">Assignments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                <span class="d-none d-sm-block">Extension Requests</span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content p-3 text-muted">
        <div class="tab-pane active" id="home1" role="tabpanel">
            <div class="card">
                <div class="card-body" id="assignments">

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Topic</th>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Task</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user_assignments as $assignment)
                                <tr class="{{ $assignment->pivot->due_date > now() ? 'table-success' : 'table-danger' }}">
                                    <td>{{$assignment->course->name}}</td>
                                    <td>{{$assignment->topic->name}}</td>
                                    <td>{{$assignment->name}}</td>
                                    <td>{{\Carbon\Carbon::parse($assignment->pivot->due_date)->format(config('constants.date_format'))}}</td>
                                    <td>
                                        <a target="__blank" href="{{ $assignment->media[0]->original_url }}">
                                            <strong>View Task</strong>
                                        </a>
                                    </td>
                                    <td>
                                        <a target="__blank" class="get-submissions-btn"
                                           data-url="{{route('assignments.submissions',['assignment'=>$assignment->id,'user'=>$user->id])}}">
                                            <strong>Submissions</strong>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No extend requests found.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="profile1" role="tabpanel">
            <div class="card">
                <div class="card-body">
                    @include('admin.users.partial_assigned_assignments')
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).on('click', '.reject-request', function (e) {
        e.preventDefault();

        let button = $(this);
        let requestId = button.data('request-id');
        let url = button.data('url');

        if (!confirm('Are you sure you want to reject this request?')) {
            return;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            beforeSend: function () {
                button.prop('disabled', true).text('Rejecting...');
            },
            success: function (response) {
                alert(response.message || 'Request rejected successfully.');
                // Optionally remove row or refresh list
                // button.closest('tr').fadeOut();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || 'Something went wrong.');
            },
            complete: function () {
                button.prop('disabled', false).text('Reject');
            }
        });
    });
</script>
