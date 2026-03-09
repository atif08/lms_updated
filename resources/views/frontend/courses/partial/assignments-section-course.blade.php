<div class="accordion">
    @foreach($course_assignments as $key =>  $assignment)

        @if($assignment->hasMedia('ASSIGNMENT'))
            <!-- Example assignment 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="courseAssignmentHeading-{{$key}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#course-assignment-{{$key}}" aria-expanded="true"
                            aria-controls="course-assignment-{{$key}}">
                        <a href="#"
                           onclick="scrollToTopAndLoadContent('{{ $assignment->media[0]->original_url }}', '{{ get_media_type($assignment->media[0]) }}')">
                            <strong>Review task: </strong> </a>{{$assignment->name}}
                        &nbsp;<strong><u> Due Date</u> : </strong>
                        {{\Carbon\Carbon::parse($assignment->due_date)->format(config('constants.date_format'))}}
                        &nbsp;<a href="{{ $topic->media[0]->original_url }}" download><strong><u>Download</u></strong></a>

                    </button>
                </h2>
                <div id="course-assignment-{{$key}}" class="accordion-collapse collapse"
                     aria-labelledby="courseAssignmentHeading-{{$key}}">
                    <div class="accordion-body">
                        <!-- Assignment Details in a Table Format -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Course</th>
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
                                        <td>{{$submitted->comments}}</td>
                                        <td>{{$submitted->status}}</td>
                                        <td>{{$submitted->created_at}}</td>
                                        <td>{{$submitted->score}}/100</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @if(in_array('REJECTED',$assignment->submitted_assignments()->pluck('status')->toArray()) || $assignment->submitted_assignments()->count()==0)

                        <button class="btn btn-primary upload-assignment-btn"
                                data-url="{{ route('assignment.get.form').'?type=assignment&id='.$assignment->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#uploadAssignmentModal">
                            Upload Work
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
