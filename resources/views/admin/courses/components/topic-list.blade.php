@if(isset($course->id))
    @foreach($course->topics as $topic)
        <li class="pb-0" id="row-{{$topic->id}}" data-topic-id={{$topic->id}}>
            <div class="accordion-header" id="heading-{{$topic->id}}">
                <div class="row topic-row mb-0">
                    <div class="col-10 card-title">
                        {{$topic->name}}
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <div class="btn-group" role="group">
                                                        <span id="btnGroupVerticalDrop1" style="cursor: pointer;"
                                                              class="btn-rounded dropdown-toggle"
                                                              data-bs-toggle="dropdown" aria-haspopup="true"
                                                              aria-expanded="false">
                                                            ...
                                                        </span>
                            <div class="dropdown-menu"
                                 aria-labelledby="btnGroupVerticalDrop1"
                                 style="margin: 0;min-width: 5rem;">
                                <a data-bs-toggle="modal" data-bs-target="#addTopicModal"
                                   class="dropdown-item edit-topic-btn"
                                   data-url="{{route('topics.edit',$topic->id)}}">Edit</a>
                                <a class="dropdown-item delete-item"
                                   data-url="{{route('topics.destroy',$topic->id)}}">Delete</a>
                            </div>
                        </div>
                        <button class="accordion-button collapsed p-0 bg-white w-50"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{$topic->id}}"
                                aria-expanded="false"
                                aria-controls="collapse-{{$topic->id}}"
                        >
                        </button>
                    </div>
                </div>
                <div id="collapse-{{$topic->id}}" class="accordion-collapse collapse"
                     aria-labelledby="heading-{{$topic->id}}"
                     data-bs-parent="#sortable-list">
                    <div class="accordion-body">
                        <ul class="child-sortable">

                           @include('admin.courses.components.topicable-list')


                            <a style="margin: 7px" data-bs-toggle="modal"
                               data-bs-target="#addLessonModal"
                               data-url="{{route('courses.topics.lessons.create',['course'=>$course->id,'topic'=>$topic->id])}}"
                               class="add-lesson-btn" href="#"><i class="fa fa-plus"></i>
                                Add Lesson</a>

                            <a style="margin: 7px" data-bs-toggle="modal"
                               data-bs-target="#addQuizModal"
                               data-url="{{route("quizzes.get").'?topic_id='.$topic->id}}"
                               class="add-quiz-btn" href="#"><i class="fa fa-plus"></i>
                                Add Quiz</a>
                        </ul>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    <a data-bs-toggle="modal" data-bs-target="#addTopicModal"
       data-url="{{route('courses.topics.create',['course'=>$course->id])}}"
       class="add-topic-btn btn btn-primary" href="#">
        <i class="fa fa-plus"></i> | Add Curriculum

    </a>
    {{--<br>
    <a class="add-topic-btn btn btn-primary mt-2" href="{{route('courses.index')}}">
        <i class="fa fa-plus"></i> | Save
    </a>--}}
@endif
