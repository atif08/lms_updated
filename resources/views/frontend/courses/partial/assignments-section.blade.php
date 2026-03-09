<div class="accordion">
    @foreach($course_assignments as $key =>  $assignment)

        @if($assignment && $assignment->hasMedia('ASSIGNMENT'))
            <!-- Example assignment 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="assignmentHeading-{{$key}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#assignment-{{$key}}" aria-expanded="false"
                            aria-controls="assignment-{{$key}}">
                        <a href="#" onclick="scrollToTopAndLoadContent('{{ $assignment->media[0]->original_url }}', '{{ get_media_type($assignment->media[0]) }}')">
                            <strong><u>View Task</u> : </strong> </a>
                        {{$assignment->name}}
                        &nbsp;<strong><u> Due Date</u> : </strong>

                        {{\Carbon\Carbon::parse($assignment->pivot->due_date)->format(config('constants.date_format'))}}
                        &nbsp;<a href="{{ $assignment->media[0]->original_url }}"
                                 download><strong><u>Download</u></strong></a>
                    </button>
                </h2>

                <div id="assignment-{{$key}}" class="accordion-collapse collapse" data-bs-parent=".accordion"
                     aria-labelledby="assignmentHeading-{{$key}}">
                    <div class="accordion-body">
                        <!-- Assignment Details in a Table Format -->
                        <div class="table-responsive-custom">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Submitted File</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Submit Date</th>
                                    <th>Score</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignment->submitted_assignments as $submitted )
                                    <tr>
                                        <td>{{$assignment->name}}</td>
                                        <td>
                                            <a href="#" onclick="scrollToTopAndLoadContent('{{ $submitted->media[0]->original_url }}', '{{ get_media_type($submitted->media[0]) }}')">
                                                <strong>View Task</strong>
                                            </a>
                                        </td>
                                        <td>
                                            @if(strlen($submitted->comments) > 20)
                                                {{ substr($submitted->comments, 0, 20) }}...
                                                 <button type="button" class="btn btn-primary p-0" data-bs-toggle="modal" data-bs-target="#commentModal-{{$submitted->id}}">
                                                    Read More
                                                </button>
                                                <a href="" data-bs-toggle="modal"
                                                   data-bs-target="#commentModal-{{$submitted->id}}"><strong><u>Read
                                                            More</u></strong></a>
                                                <!-- Modal for Full Comment -->
                                                <div class="modal fade" id="commentModal-{{$submitted->id}}"
                                                     tabindex="-1"
                                                     aria-labelledby="commentModalLabel-{{$submitted->id}}"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="commentModalLabel-{{$submitted->id}}">
                                                                    Comments</h5>
                                                            </div>
                                                            <div class="modal-body modal-body-custom-height">
                                                                {{$submitted->comments}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                {{$submitted->comments}}
                                            @endif
                                        </td>
                                        <td>{{$submitted->status}}</td>
                                        <td>{{\Carbon\Carbon::parse($submitted->created_at)->format(config('constants.date_format'))}}</td>
                                        <td>{{$submitted->score}}/100</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @php
                            $today = now();
                            $dueDate = \Carbon\Carbon::parse($assignment->pivot->due_date);
                            // Check if due date has passed
                            $isDuePassed = $dueDate->isPast();
                        @endphp

                        @if($isDuePassed)
                            {{-- Due date passed — student can request an extension --}}
                            <button
                                class="btn btn-warning request-extend-btn"
                                data-id="{{ $assignment->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#extendRequestModal">
                                Request for Extend Date
                            </button>
                        @else
                            {{-- Due date still valid — student can upload work --}}
                            <button
                                class="btn btn-primary upload-assignment-btn"
                                data-url="{{ route('assignment.get.form', ['type' => 'assignment', 'id' => $assignment->id]) }}"
                                data-bs-toggle="modal"
                                data-bs-target="#uploadAssignmentModal">
                                Submit Assignment
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="extendRequestModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="extend-request-form">
            @csrf
            <input type="hidden" name="assignment_id" id="extend-assignment-id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request for Extension</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to send request for an extension.</p>
                    <div id="extend-errors" class="text-danger mt-2"></div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Request Extension</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('click', '.request-extend-btn', function() {
            let assignmentId = $(this).data('id');
            $('#extend-assignment-id').val(assignmentId);
        });

        $(document).on('submit','#extend-request-form', function(e) {
            e.preventDefault();
            let form = $(this);

            $.ajax({
                url: "{{ route('assignment.date-extend.store') }}",
                type: "POST",
                data: form.serialize(),
                success: function(response) {
                    $('#extend-errors').html('');
                    $('#extendRequestModal').modal('hide');
                    alert(response.message);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.message;
                        $('#extend-errors').html(errors);
                    }
                    if (xhr.status === 403) {
                        let errors = xhr.responseJSON.message;
                        $('#extend-errors').html(errors);
                        window.location.reload();
                    }
                }
            });
        });

    </script>
@endpush
