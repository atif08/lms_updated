<h4 class="card-title">Assigned Task</h4>
<p class="card-title-desc">List of all task.</p>
<div class="table-responsive">

    <table class="table mb-0">
        <thead>
        <tr>
            <th>Course</th>
            <th>Topic</th>
            <th>Assignment Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @forelse($extend_requests as $request)
            <tr class="
                                    {{
                                        $request->status == 'PENDING' ? 'table-warning' :
                                        ($request->status == 'APPROVED' ? 'table-success' :
                                        ($request->status == 'REJECTED' ? 'table-danger' : 'table-info'))
                                    }}">
                <td>{{ $request->assignment->course->name }}</td>
                <td>{{ $request->assignment->topic->name }}</td>
                <td>{{ $request->assignment->name }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <a class="btn btn-success btn-sm waves-effect waves-light"
                       data-request-id="{{ $request->id }}"
                       data-assignmnet-id="{{ $request->assignment_id }}"
                       data-user-id="{{ $request->user_id }}"
                       data-bs-toggle="modal"
                       data-bs-target="#extendApproveModal">
                        Approve
                    </a>

                    <a class="btn btn-danger btn-sm waves-effect waves-light reject-request"
                       data-url="{{ route('extend-date.reject', $request->id) }}">
                        Reject
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
