<div id="qaContent" class="custom-display">
    <div class="card border-0">
        <div class="card-body scrollable-section">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 pb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..."
                               aria-label="Search">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="subs-title mb-0">All
                    questions.</h5>
                <button class="btn btn-wish md-px-2" data-toggle="modal" data-target="#askQuestionModal">Add
                    Question
                </button>
                <div class="modal fade" id="askQuestionModal" tabindex="-1" role="dialog"
                     aria-labelledby="askQuestionModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header pb-2">
                                <h5 class="subs-title mb-0" id="askQuestionModalLabel">Ask a
                                    Question</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                                <span aria-hidden="true"><i class="fa fa-times"
                                                                            aria-hidden="true"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post"
                                      action="{{route('courses.post.question',$course->id)}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="questionDescription">
                                            <h5 class="subs-title mb-0 mt-2">Description</h5>

                                        </label>
                                        <textarea class="form-control" id="questionDescription"
                                                  name="name"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="pt-2">
                                        <button type="submit" class="btn btn-primary float-end">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-1 ">
                @foreach($course->questions as $question)
                    <div class="question-container highlighted">

                        <img src="{{get_image($question->user->media)}}" alt="img"
                             class="profile-photo">

                        <div class="instructor-detail me-3">
                            <h5 class="fs-5">{{$question->name}}</h5>
                            @foreach($question->answers as $answer)
                                <p class="fs-6">{{$answer->answer}}</p>
                            @endforeach
                            <div class="mt-3">
                                <p>
                                    <a>{{$question->user->name}}</a>
                                    @php
                                        $createdAt = \Carbon\Carbon::parse($question->created_at);
                                        echo $createdAt->diffForHumans();
                                    @endphp
                                </p>
                            </div>
                        </div>
                        @if(auth()->user()->user_type == \Domain\Users\Enums\UserTypeEnum::FACULTY_MEMBER())
                            <a href="#" class="btn btn-reply mb-4 btn-answer"
                               data-url="{{route('question.post.answer',$question->id)}}"
                               data-bs-toggle="modal"
                               data-bs-target="#courseAnswerModal">Answer</a>
                        @endif
                    </div>

                @endforeach


            </div>
        </div>
    </div>
</div>
