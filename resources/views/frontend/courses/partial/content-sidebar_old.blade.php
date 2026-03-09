<div class="col-lg-4 col-md-12 remove-padding sidebar-container">
    <div class="sidebar">
        <!-- Course Content -->
        <div class="accordion" id="accordionExample">
            <div class="card content-sec">
                <div class="card-header" aria-expanded="false" aria-controls="collapseOne">
                    <h5 class="mb-0">Course Content</h5>
                </div>
            </div>
            @foreach($topicables as $key => $topicable)
                <div class="card content-sec">
                    @if($topicable->topicable->type == \Domain\Courses\Enums\LessonTypeEnum::ExternalLink())
                        <div class="card-header d-flex justify-content-between align-items-center"
                             onclick="loadContent(
                                 '{{$topicable->topicable->external_link}}',
                                 '{{\Domain\Courses\Enums\LessonTypeEnum::ExternalLink()->value}}',
                                 '{{$topicable->topicable->description}}')">
                            <h5 class="mb-0">{{$topicable->topicable->name}}</h5>
                        </div>
                    @elseif($topicable->topicable->type == \Domain\Courses\Enums\LessonTypeEnum::Iframe())
                        <div class="card-header d-flex justify-content-between align-items-center"
                             onclick="loadContent('{{$topicable->topicable->iframe}}',
                             '{{\Domain\Courses\Enums\LessonTypeEnum::Iframe()->value}}',
                             '{{$topicable->topicable->description}}'
                             )">
                            <h5 class="mb-0">{{$topicable->topicable->name}}</h5>
                        </div>
                    @elseif($topicable->topicable instanceof \Domain\Quizzes\Models\Quiz)
                        <div class="card-header d-flex justify-content-between align-items-center"
                             onclick="loadContent('{{route('students.quiz.show',['topic'=>$topicable->topic_id,'quiz'=>$topicable->topicable->id])}}', 'quiz')">

                            <h5 class="mb-0">{{$topicable->topicable->name}}</h5>
                        </div>
                    @else
{{--                        lesson content handel here--}}
                        <div class="card-header d-flex justify-content-between align-items-center"
                             id="headingOne"
                             data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false"
                             aria-controls="collapse-{{$key}}">
                            <h5 class="mb-0">{{$topicable->topicable->name}}</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="collapse-{{$key}}" class="collapse" aria-labelledby="headingOne"
                             data-parent="#accordionExample">
                            <div class="card-body p-0">
                                <ul class="list-group">
                                    @if($topicable->topicable instanceof \Domain\Courses\Models\Lesson)
                                        @php $lesson = $topicable->topicable;@endphp
                                        @foreach($lesson->media as $less_key => $media)
                                            @php
                                                $type = get_media_type($media);
                                            @endphp
                                            <li class="list-group-item">
                                                <input @if(in_array($media->id, $course->user_course_progress->pluck('progressable_id')->toArray())) checked="checked" @endif  class="mark-lesson-complete" data-progressable-id="{{$media->id}}" type="checkbox">
                                                <span class="m-1"  onclick="loadContent('{{$media->original_url}}', '{{$type}}','{{$topicable->topicable->description}}')"> <i class="fas fa-file-{{$type}}"></i>{{$media->name}}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@push('scripts')
    <script>

        // Function to Handle Content Loading
        function loadContent(url, type,description) {
            const contentArea = document.getElementById("content-area");
            contentArea.innerHTML = ''; // Clear existing content
            $('#lesson-content').html('');
            $('#lesson-content').html(description);

            if (type === "pdf") {
                // contentArea.innerHTML += `<embed src="${url}" type="application/pdf" width="100%" height="600px">`;
                renderPDF(url);

            } else if (type === "powerpoint") {
                contentArea.innerHTML +=
                    `<iframe src="https://docs.google.com/viewer?url=${url}&embedded=true" width="100%" height="600px" frameborder="0"></iframe>`;

            } else if (type === "video") {
                contentArea.innerHTML +=
                    `<video controls width="100%" height="600px"><source src="${url}" type="video/webm">Your browser does not support the video tag.</video>`;

            } else if (type === 'EXTERNAL_LINK') {
                contentArea.innerHTML +=
                    `<iframe src="${url}" width="100%" height="600" allow="autoplay"></iframe>`;

            } else if (type === "docx" || type === "ppt" || type === "pptx") {
                contentArea.innerHTML +=
                    `<iframe src="https://docs.google.com/viewer?url=${url}&embedded=true" width="100%" height="600px" frameborder="0"></iframe>`;

            } else if (type === "image") {
                contentArea.innerHTML += `<img src="${url}" width="100%" height="600px" frameborder="0"></img>`;

            } else if (type === "IFRAME") {
                contentArea.innerHTML += url;

            } else if (type === "quiz") {
                contentArea.innerHTML += `<div class="container mt-5 custom-container-h">
            <div class="quiz-card">
                <img src="{{\Illuminate\Support\Facades\URL::asset('assets/images/quiz.png')}}" alt="Quiz Image" class="img-fluid">
                <h5>QUIZ: This is a quiz test</h5>
                <p>Please go to quiz page for more information</p>
                <button type="button" class="btn btn-primary" onclick="window.open('${url}', '_blank')">Start Quiz</button>
            </div>
        </div>`;
            } else {
                contentArea.innerHTML += `<div class="content-description">Content for ${filename}.</div>`;
            }
        }

        $(document).on('click', '.mark-lesson-complete', function (e) {
            const data = {"progressable_id":$(this).data('progressable-id')};

            makePostCall('{{route('courses.post.mark-complete',$course->id)}}',data, function (response) {
                var topicId = $(this).data('topic-id');
                $('.custom-modal-assignment').html(response);
            })

        });
    </script>
@endpush
