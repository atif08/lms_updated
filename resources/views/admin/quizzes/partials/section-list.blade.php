@if(count($quiz->quiz_sections) > 0 )
    @foreach($quiz->quiz_sections as $key=> $section)
        <div class="accordion" id="row-{{$section->id}}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#quiz-section-{{$key}}" aria-expanded="false"
                            aria-controls="quiz-section-{{$key}}">
                        {{ $section->title }}
                    </button>
                    <div class="dropdown ms-2">
                        <button class="btn btn-outline-secondary dropdown-toggle"
                                type="button" id="section{{$key}}Dropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            ...
                        </button>
                        <ul class="dropdown-menu"
                            aria-labelledby="section{{$key}}Dropdown">
                            <li>
                                <a class="dropdown-item add-section-btn"
                                   data-bs-toggle="modal"
                                   data-bs-target="#addQuizSectionModal"
                                   data-url="{{route('quiz-sections.edit',$section->id)}}"
                                   href="javascript:void(10);">{{ __('Edit') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger delete-item"
                                   data-url="{{route('quiz-sections.destroy',$section->id)}}">{{ __('Delete') }}</a>
                            </li>
                        </ul>
                    </div>

                </h2>
                <div id="quiz-section-{{$key}}" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        @include('admin.quizzes.partials.question-list')
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- End Sections and Questions -->

<!-- Buttons at the bottom -->
