@php use Domain\Assignment\Enums\AssignmentStatusEnum; @endphp
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-10">
            <h4 class="card-title">Submitted Assignments</h4>
            <p class="card-title-desc">List of all task.</p>
        </div>
        <div class="col-lg-2">
            <button type="button"
                    class="btn btn-secondary btn-sm waves-effect waves-light get-user-profile"
                    data-url="{{ route('users.get.partial-profile', $user->id) }}">
                Back
            </button>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table mb-0">
        <thead>
        <tr>
            <th>Course</th>
            <th>Topic</th>
            <th>Title</th>
            <th>Attempt</th>
            <th>Student Notes</th>
            <th>Score</th>
            <th>Submitted At</th>
            <th>Status</th>
            <th>Task</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($submissions as $submission)
            @php

                $rowClass = match ($submission->status) {
                    AssignmentStatusEnum::PENDING()  => 'table-warning',
                    AssignmentStatusEnum::APPROVED() => 'table-success',
                    default                          => 'table-danger',
                };
            @endphp
            <tr class="{{ $rowClass }}">
                <td>{{$submission->submissionable->topic->course?->name}}</td>
                <td>{{$submission->submissionable->topic?->name}}</td>
                <td>{{$submission->submissionable->name}}</td>
                <td>{{$submission->attempt_number}}</td>
                <td>{{$submission->description}}</td>
                <td>{{$submission->score}}</td>
{{--                <td>{{\Carbon\Carbon::parse($submission->submissionable->users[0]->pivot->due_date)->format(config('constants.date_format'))}}</td>--}}
                <td>{{\Carbon\Carbon::parse($submission->created_at)->format(config('constants.date_format'))}}</td>
                <td>{{$submission->status}}</td>
                <td>
                    <a target="__blank" href="{{ $submission->media[0]->original_url }}">
                        <strong>View Task</strong>
                    </a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm edit-assignment-btn" data-bs-toggle="modal" data-bs-target="#editAssignmentModal" data-url="{{ route('submitted-assignments.edit', $submission->id)}}"><i class="fas fa-edit"></i> </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>


</script>
