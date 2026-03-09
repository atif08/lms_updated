<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                {{--                <h4 class="card-title">Contextual classes</h4>--}}
                {{--                <p class="card-title-desc">Use contextual classes to color table rows or individual cells.</p>--}}

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr class="table-warning">
                            <th scope="row">Name:</th>
                            <td>{{$quiz_attempt->participant->name}} ({{$quiz_attempt->participant->email}})</td>
                        </tr>
                        <tr class="table-danger">
                            <th scope="row">Score:</th>
                            <td>{{$quiz_attempt->correct_answers}} out of {{$quiz_attempt->total_questions}}
                                ({{get_points_percentage($quiz_attempt->total_points, $quiz_attempt->earned_points)}}%)
                            </td>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    {{--        <div class="col-lg-6">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    <div class="table-responsive">--}}
    {{--                        <table class="table table-bordered border mb-0">--}}

    {{--                            <thead>--}}
    {{--                            <tr>--}}
    {{--                                <th></th>--}}
    {{--                                <th>Questions</th>--}}
    {{--                                <th>Points</th>--}}
    {{--                            </tr>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            <tr>--}}
    {{--                                <td>--}}
    {{--                                    <div style="width: 20px;height: 20px" class="bg-success rounded my-2"></div>--}}
    {{--                                </td>--}}
    {{--                                <td>Mark</td>--}}
    {{--                                <td>Otto</td>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <td>--}}
    {{--                                    <div style="width: 20px;height: 20px" class="bg-danger rounded my-2"></div>--}}
    {{--                                </td>--}}
    {{--                                <td>Jacob</td>--}}
    {{--                                <td>Thornton</td>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <td>--}}
    {{--                                    <div style="width: 20px;height: 20px" class="bg-warning rounded my-2"></div>--}}
    {{--                                </td>--}}
    {{--                                <td>Larry</td>--}}
    {{--                                <td>the Bird</td>--}}
    {{--                            </tr>--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

    @foreach($quiz_attempt->quiz->quiz_sections as $section)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$section->title}}</h4>
                    <p class="card-title-desc">{!! $section->description !!}</p>
                    @foreach($section->questions as $question)
                        @php
                            $is_correct = $question->isCorrect($quiz_attempt_answers->where('quiz_question_id',$question->id)->pluck('answer_text')->toArray())
                        @endphp
                        @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::ONE_CORRECT() || $question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MULTIPLE_CORRECT())
                            @php
                                $is_correct = $question->isCorrect($quiz_attempt_answers->where('quiz_question_id',$question->id)->pluck('question_option_id')->toArray())
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="{{$is_correct ? 'table-success' : 'table-danger' }}">
                                        <td colspan="100">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <i class="fa fa-lg {{$is_correct ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                                    &nbsp;
                                                    {{strip_tags($question->name)}}
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <span> Points <strong>{{$is_correct ? $question->points : 0}} / {{$question->points}}</strong></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2 text-center"><strong>Correct answer</strong></td>
                                        <td class="col-md-2 text-center"><strong>Answer</strong></td>
                                        <td class="col-md-8"></td>
                                    </tr>
                                    @foreach($question->options as $option)
                                        <tr>
                                            <td class="text-center">
                                                @if($option->is_correct)
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($quiz_attempt_answers->where('question_option_id',$option->id)->first()?->question_option_id == $option->id)
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            </td>
                                            <td>{{$option->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FILL_BLANK() || $question->type ==  \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="{{$is_correct ? 'table-success' : 'table-danger' }}">
                                        <td colspan="100">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <i class="fa fa-lg {{$is_correct ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                                    &nbsp;
                                                    {!! $question->name !!}
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <span> Points <strong>{{$is_correct ? $question->points : 0}} / {{$question->points}}</strong></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2 text-center"><strong>Correct</strong></td>
                                        <td class="col-md-2 text-center"><strong>Answer</strong></td>
                                        <td class="col-md-2 text-center"><strong>Correct Answer</strong></td>
                                        <td class="col-md-2 text-center"><strong>User's Response</strong></td>
                                        <td class="col-md-8"></td>
                                    </tr>
                                    @foreach($question->options as $key => $option)
                                        <tr>
                                            <td class="text-center">
                                                @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                                                    @if($quiz_attempt_answers->where('quiz_question_id',$question->id)->values()[$key]?->answer_text == $option->answer)
                                                        <i class="fa fa-check"></i>
                                                    @else
                                                        <i class="fa fa-times"></i>
                                                    @endif
                                                @else
                                                    @if($quiz_attempt_answers->where('question_option_id',$option->id)->first()?->answer_text == $option->name)
                                                        <i class="fa fa-check"></i>
                                                    @else
                                                        <i class="fa fa-times"></i>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                                                    {{$option->name}}
                                                @else
                                                    Blank {{$key+1}}
                                                @endif

                                            </td>
                                            <td>
                                                @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                                                    {{$option->answer}}
                                                @else
                                                    {{$option->name}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($quiz_attempt_answers->where('quiz_question_id',$question->id)[$key]?->answer_text) && $question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                                                    {{$quiz_attempt_answers->where('quiz_question_id',$question->id)[$key]?->answer_text}}
                                                @else
                                                    {{$quiz_attempt_answers->where('question_option_id',$option->id)->first()?->answer_text}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FREE_TEXT())
                            @php
                                $option = collect($quiz_attempt->answers)->where('quiz_question_id',$question->id)->first();
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="table-warning">
                                        <td colspan="100">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <i class="fas fa-file-alt"></i> &nbsp;
                                                    {{ str_replace('&nbsp;', '', strip_tags($question->name)) }}
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <span> Points <strong>{{$option?->question_option_id ? $option->points : 0}}/{{$question->points}}</strong></span>
                                                    @if(request()->is('admin/*') && !$option?->question_option_id)
                                                        <a href="#"
                                                           data-question-id="{{$question->id}}"
                                                           data-question-option-id="{{$question->options[0]->id}}"
                                                           data-points="{{$question->points}}"
                                                           class="edit-question-points-modal"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#editQuestionPointsModal">
                                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="col-md-12">{!! $option?->answer_text !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal for editing question points -->
<div id="editQuestionPointsModal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="editQuestionPointsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="editQuestionPointsModalLabel">{{__('Set Points')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('quiz-attempts.update',$quiz_attempt->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body edit-assignment-body">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label" for="points">Points</label>
                            <input class="form-control" name="question_id" type="hidden" id="question-id">
                            <input class="form-control" name="question_option_id" type="hidden" id="question-option-id">
                            <input class="form-control" name="points" type="number" id="points">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                    <input type="submit" class="btn btn-success edit-points-modal" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
