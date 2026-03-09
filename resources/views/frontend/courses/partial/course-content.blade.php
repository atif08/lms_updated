<div class="card content-sec">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="subs-title">Course Content</h5>
            </div>
            <div class="col-sm-6 text-sm-end">
                <h6>92 Lectures 10:56:11</h6>
            </div>
        </div>
        @foreach($course->topics as $key => $topic)
            <div class="course-card">
{{--                topic item--}}
                <h6 class="cou-title">
                    <a class="collapsed text-capitalize" data-bs-toggle="collapse" href="#topic-{{$key}}" aria-expanded="false">
                        {{$topic->name}} <span class="icon">&#43;</span>
                    </a>
                </h6>
{{--                topic container--}}
                <div id="topic-{{$key}}" class="card-collapse collapse" style="margin-left: 20px;margin-right: 20px">
                    @foreach($topic->topicables as $less_key => $topicable)
                        @if($topicable->topicable instanceof \Domain\Courses\Models\Lesson)
                            @php $lesson = $topicable->topicable @endphp
                            <h6 class="cou-title" style="background-color: bisque;">
                                <a class="collapsed text-capitalize" data-bs-toggle="collapse"
                                   href="#lesson-{{$less_key}}"
                                   aria-expanded="false">
                                    {{$less_key+1}} {{$lesson->name}}
                                    <span class="icon">&#43;</span>
                                </a>
                            </h6>
                            <div id="lesson-{{$less_key}}" class="card-collapse collapse">
                                <ul>
                                    @foreach($lesson?->media as $media)
                                        @php
                                            if (str_starts_with($media->mime_type, 'image/')) {
                                                $type = 'image';
                                            } else if (str_starts_with($media->mime_type, 'application/pdf')) {
                                                $type = 'pdf';
                                            } else if (str_starts_with($media->mime_type, 'application/vnd.ms-powerpoint')) {
                                                $type = 'ppt';
                                            }else if (str_starts_with($media->mime_type, 'application/vnd.openxmlformats-officedocument.presentationml.presentation')) {
                                                $type = 'ppt';
                                            } else if (str_starts_with($media->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                                                $type = 'document';
                                            } else if (str_starts_with($media->mime_type, 'video/')) {
                                                $type = 'video';
                                            } else {
                                                $type = 'other';
                                            }
                                        @endphp
                                        <li>
                                            <p>
                                                <img src="{{ URL::asset('/frontend/img/icon/play.svg') }}" class="me-2">
                                                <a href="#" class="preview-link" data-pdf-url="{{$media->original_url}}"
                                                   data-media-type="{{$type}}" data-pdf-title="{{$media->name}}"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#lessonPreviewModal"> {{$media->name}}</a>
                                            </p>
                                            <div>
                                                <a href="#" class="preview-link" data-pdf-url="{{$media->original_url}}"
                                                   data-media-type="{{$type}}"
                                                   data-pdf-title="{{$media->name}}" data-bs-toggle="modal"
                                                   data-bs-target="#lessonPreviewModal">Preview</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <h6 class="cou-title" style="background-color: lavender;">
                                <a class="collapsed" target="__blank"
                                   href="{{url('students/quizzes/'.$topicable->topicable->id.'/takequiz')}}"
                                   aria-expanded="false">
                                    Quizz:: {{$less_key+1}} {{$topicable->topicable->name}}
                                </a>
                            </h6>
                        @endif

                    @endforeach
                        {{--                topic assignment start--}}
                        @if(count($topic?->media)>0)
                            <div class="topicAssignment p-4" style="padding-top: 0px !important;">
                                <ul>
                                    @foreach($topic?->media as $media)
                                        @php
                                            if (str_starts_with($media->mime_type, 'image/')) {
                                                $type = 'image';
                                            } else if (str_starts_with($media->mime_type, 'application/pdf')) {
                                                $type = 'pdf';
                                            } else if (str_starts_with($media->mime_type, 'application/vnd.ms-powerpoint')) {
                                                $type = 'ppt';
                                            } else if (str_starts_with($media->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
                                                $type = 'document';
                                            } else if (str_starts_with($media->mime_type, 'video/')) {
                                                $type = 'video';
                                            } else {
                                                $type = 'other';
                                            }
                                        @endphp
                                        <li>
                                            <p>
                                                <img src="{{ URL::asset('/frontend/img/icon/play.svg') }}" class="me-2">
                                                <a href="#" class="preview-link" data-pdf-url="{{$media->original_url}}"
                                                   data-media-type="{{$type}}" data-pdf-title="{{$media->name}}"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#lessonPreviewModal">Click here to view assignment</a>
                                            </p>
                                            <div>
                                                <a href="#" class="preview-link" data-pdf-url="{{$media->original_url}}"
                                                   data-media-type="{{$type}}"
                                                   data-pdf-title="{{$media->name}}" data-bs-toggle="modal"
                                                   data-bs-target="#lessonPreviewModal">Preview</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        @if(!empty($topic->user_assignment()->first()))
                                            @php
                                                $assignment=$topic->user_assignment;
                                            @endphp
                                            <button class="btn btn-info uploadedAssignmentViewBtn"
                                                    data-topic-name="{{ $topic->name }}"
                                                    data-siignment-description="{{$assignment->description }}"
                                                    data-siignment-image="{{@$assignment->media[0]->getUrl()}}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#uploadedAssignmentViewModal">
                                                View Assignment
                                            </button>
                                        @else
                                            <button class="btn btn-primary upload-assignment-btn"
                                                    data-url="{{ route('topics.get.assignment',$topic->id)}}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#uploadAssignmentModal">
                                                Upload Assignment
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{--                topic assignment end--}}
                </div>
            </div>
        @endforeach
    </div>
</div>
@component('components.frontend.modals.lesson-preview-modal')@endcomponent
@component('components.frontend.modals.upload-assignment-modal')@endcomponent
@component('components.frontend.modals.uploaded-assignment-view-modal')@endcomponent

