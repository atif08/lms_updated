<div class="col-lg-4 col-md-12 remove-padding sidebar-container">
    <div class="sidebar">
        <!-- Course Content -->
        <div class="accordion" id="accordionExample">
            <div class="card content-sec">
                <div class="card-header" aria-expanded="false" aria-controls="collapseOne">
                    <h5 class="mb-0">Course Content</h5>
                </div>
            </div>
            @foreach($topics as $key => $topic)
                <div class="card content-sec">
                    <div class="card-header d-flex justify-content-between align-items-center" id="headingOne-{{$key}}"
                         data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="false"
                         aria-controls="collapse-{{$key}}">
                        <h5 class="mb-0">{{$topic->name}}</h5>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div id="collapse-{{$key}}" class="collapse" aria-labelledby="headingOne-{{$key}}"
                         data-parent="#accordionExample">
                        <div class="card-body p-0">
                            <ul class="list-group">
                                @foreach($topic->topicables as $topicableKey => $topicable)
                                    @if($topicable->topicable instanceof \Domain\Courses\Models\Lesson && (count($topicable->topicable->users) == 0 || $topicable->topicable->users->contains(auth()->user())))
                                        <li class="list-group-item">
                                            <div class="card-header d-flex justify-content-between align-items-center"
                                                 id="headingTwo-{{$key}}-{{$topicableKey}}" data-toggle="collapse"
                                                 data-target="#collapseTwo-{{$key}}-{{$topicableKey}}" aria-expanded="false"
                                                 aria-controls="collapseTwo-{{$key}}-{{$topicableKey}}">
                                                <h5 class="mb-0">{{$topicable->topicable->name}}</h5>
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                            <div id="collapseTwo-{{$key}}-{{$topicableKey}}" class="collapse"
                                                 aria-labelledby="headingTwo-{{$key}}-{{$topicableKey}}"
                                                 data-parent="#collapse-{{$key}}">
                                                <div class="card-body p-0">
                                                    <ul class="list-group">
                                                        @if($topicable->topicable instanceof \Domain\Courses\Models\Lesson && $topicable->topicable->type == \Domain\Courses\Enums\LessonTypeEnum::Media())
                                                            @php $lesson = $topicable->topicable; @endphp
                                                            @foreach($lesson->media as $less_key => $media)
                                                                @php $type = get_media_type($media); @endphp
                                                                <li class="list-group-item"
                                                                    onclick="loadContent('{{$media->original_url}}', '{{$type}}','{{$topicable->topicable->description}}')">
                                                                    <input
                                                                        @if(in_array($media->id, $course->user_course_progress->pluck('progressable_id')->toArray())) checked="checked"
                                                                        @endif class="mark-lesson-complete"
                                                                        data-lesson-id="{{$lesson->id}}"
                                                                        data-topic-id="{{$lesson->topic_id}}"
                                                                        data-progressable-id="{{$media->id}}"
                                                                        data-progressable-type="{{get_class($media)}}"
                                                                        type="checkbox" style="transform: scale(1.5);">
                                                                    <span class="m-1">
                                                                        <i class="fas fa-file-{{$type}}"></i>{{$media->name}}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li class="list-group-item">
                                                                @if($topicable->topicable instanceof \Domain\Quizzes\Models\Quiz)
                                                                    <span class="m-1"
                                                                          onclick="loadContent('{{route('students.quiz.show',['topic'=>$topicable->topic_id,'quiz'=>$topicable->topicable->id])}}', 'quiz')">
                                                                        {{$topicable->topicable->name}}
                                                                    </span>
                                                                @else
                                                                    <input
                                                                        @if(in_array($topicable->topicable->id, $course->user_course_progress()->where('progressable_type',\Domain\Courses\Models\Lesson::class)->pluck('progressable_id')->toArray())) checked="checked"
                                                                        @endif class="mark-lesson-complete"
                                                                        data-lesson-id="{{$topicable->topicable->id}}"
                                                                        data-topic-id="{{$topicable->topicable->topic_id}}"
                                                                        data-progressable-id="{{$topicable->topicable->id}}"
                                                                        data-progressable-type="{{get_class($topicable->topicable)}}"
                                                                        type="checkbox" style="transform: scale(1.5);">
                                                                    <span class="m-1"
                                                                          onclick="loadContent('{{$topicable->topicable->external_link}}', '{{$topicable->topicable->type}}','{{$topicable->topicable->description}}')">
                                                                        {{$topicable->topicable->name}}
                                                                    </span>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
