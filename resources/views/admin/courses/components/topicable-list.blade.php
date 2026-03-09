@if($topic->topicables)

    @foreach($topic->topicables as $topicable)
        @php
            $item = $topicable->topicable;
        @endphp
        <li id="row-{{$topicable->id}}"
            style="@if($topicable->topicable_type==\Domain\Quizzes\Models\Quiz::class) background: aliceblue; @endif "
            data-lesson-id="{{$topicable->id}}">
            <div class="row">
                <div class="col-10 text-capitalize">
                    {{$item->name}} @if($item->type=='Quiz')- <span>Quiz</span>
                    @endif
                </div>
                <div class="col-2">
                    <a data-url="{{route('topics.topicable.detach', $topicable->id)}}" class="btn btn-danger btn-rounded delete-item btn-sm"><i class="fas fa-trash-alt"></i></a>
                   @if($topicable->topicable_type==\Domain\Courses\Models\Lesson::class)
                    <button
                        class="btn btn-secondary btn-rounded btn-sm edit-lesson-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#addLessonModal"
                        data-url="{{ route('courses.topics.lessons.edit', ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $item->id])}}">
                        <i class="fas fa-edit"></i></button>
                    @endif
                    {{--<a data-bs-toggle="modal" data-bs-target="#addLessonModal"
                       class="dropdown-item edit-lesson-btn"
                       data-url="{{route('lessons.edit',$item->id)}}">Edit</a>--}}
                </div>
            </div>
        </li>
    @endforeach
@endif
