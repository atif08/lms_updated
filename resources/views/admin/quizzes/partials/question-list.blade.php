@if(count($section->questions ) > 0)

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Question</h4>
            <p class="card-title-desc">List of question</p>
            <div class="accordion" id="accordionExample">
                @foreach($section->questions as $questionKey=> $question)
                    <div class="accordion-item" id="row-{{$question->id}}">
                        <h2 class="accordion-header" id="headingOne-{{$questionKey}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne-{{$questionKey}}" aria-expanded="false"
                                    aria-controls="collapseOne">
                                {!! $question->name !!}
                            </button>
                                                        <div class="col-md-1">
                                                            <div class="dropdown ms-4">
                                                                <button class="btn btn-outline-secondary dropdown-toggle"
                                                                        type="button" id="section{{$key}}Dropdown"
                                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                                    ...
                                                                </button>
                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="section{{$key}}Dropdown">
                                                                    <li>
                                                                        <a class="dropdown-item"

                                                                           href="{{route('quizzes.questions.edit',['quiz'=>$quiz->id,'question'=>$question->id])}}">{{ __('Edit') }}</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger delete-item " style="cursor: pointer;"
                                                                           data-url="{{route('quizzes.questions.destroy',['quiz'=>$quiz->id,'question'=>$question->id])}}">{{ __('Delete') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                        </h2>
                        <div id="collapseOne-{{$questionKey}}" class="accordion-collapse collapse"
                             aria-labelledby="headingOne-{{$questionKey}}" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body">
                                @if(count($question->options ) > 0)
                                    @foreach($question->options as $optionKey=> $option)
                                        @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::ONE_CORRECT())
                                            <div class="form-check">
                                                <input disabled class="form-check-input"
                                                       @if($option->is_correct==1) checked
                                                       @endif type="radio">
                                                <label style="opacity: 1"
                                                       class="form-check-label">{{$option->name}}</label>
                                            </div>
                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MULTIPLE_CORRECT())
                                            <div class="form-check">
                                                <input disabled class="form-check-input"
                                                       @if($option->is_correct==1) checked
                                                       @endif type="checkbox">
                                                <label style="opacity: 1"
                                                       class="form-check-label">{{$option->name}}</label>
                                            </div>
                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FREE_TEXT())
                                            <textarea disabled="disabled" style="height:100px;width:100%;"></textarea>
                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FILL_BLANK())
                                            <div class="row">
                                                <div class="col-lg-6 border p-2">Blank_{{$optionKey+1}}</div>
                                                <div class="col-lg-6 border p-2">{{$option->name}}</div>
                                            </div>
                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())
                                            <div class="row">
                                                <div class="col-lg-6 border p-2">{{$option->name}}</div>
                                                <div class="col-lg-6 border p-2">{{$option->answer}}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
