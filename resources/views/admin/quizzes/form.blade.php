@extends('layouts.master')

@section('title', __('Quiz Details'))

@section('style')

@endsection

@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Quiz Details') }}
        @endslot
    @endcomponent

    @if(isset($quiz) && !empty($quiz->id))
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4 class="card-title mb-0 flex-grow-1 text-capitalize">{{ $quiz->name }}</h4>
                        <a class="add-topic-btn btn btn-info"
                           href="{{ route('students.quiz.show', ['topic'=>1,'quiz' => $quiz->id]) }}?preview=1">
                            Preview
                        </a>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="quizTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="questions-tab" data-bs-toggle="tab" href="#questions"
                                   role="tab" aria-controls="questions" aria-selected="true">{{ __('Questions') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab"
                                   aria-controls="settings" aria-selected="false">{{ __('Settings') }}</a>
                            </li>
{{--                            <li class="nav-item" role="presentation">--}}
{{--                                <a class="nav-link" id="results-tab" data-bs-toggle="tab" href="#results" role="tab"--}}
{{--                                   aria-controls="results" aria-selected="false">{{ __('Results') }}</a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="quizTabsContent">
                            <div class="tab-pane fade show active" id="questions" role="tabpanel"
                                 aria-labelledby="questions-tab">
                                <div class="mt-4">
                                    @include('admin.quizzes.partials.section-list')
                                    <div class="mt-4">
                                        <a class="add-topic-btn btn btn-primary"
                                           data-bs-toggle="modal"
                                           data-bs-target="#showQuestionTypeModal"
                                           href="#">
                                            + Question
                                        </a>

                                        <button type="button"
                                                data-bs-toggle="modal" data-bs-target="#addQuizSectionModal"
                                                data-url="{{route('quiz-sections.create',['quiz'=>$quiz->id])}}"
                                                class="btn btn-secondary add-section-btn"> {{ __('+ Section') }}
                                        </button>
                                        <a class="add-topic-btn btn btn-info"
                                           href="{{route('students.quiz.show',['topic'=>1,'quiz'=>$quiz->id])}}">
                                            Preview

                                        </a>
                                        <button type="button" class="btn btn-success btn-save">{{ __('Save') }}</button>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="mt-4">
                                    <!-- Settings Form -->
                                    {!! form($createForm) !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="results" role="tabpanel" aria-labelledby="results-tab">
                                <div class="mt-4">
                                    <!-- Add your Results form or content here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div id="showQuestionTypeModal" class="modal fade" tabindex="-1" role="dialog"
             aria-labelledby="showQuestionTypeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="showQuestionTypeModalLabel">{{__('Add question')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                        </button>
                    </div>
                    <form method="get" action="{{route('quizzes.questions.create',['quiz'=>$quiz->id])}}">
                        <div class="modal-body edit-assignment-body">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label" for="points">Select Question Type</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="type" value="ONE_CORRECT"
                                               id="one-correct" checked>
                                        <label class="form-check-label" for="one-correct">
                                            Multiple (one correct)
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" value="MULTIPLE_CORRECT"
                                               name="type"
                                               id="multi-correct">
                                        <label class="form-check-label" for="multi-correct">Multiple (more than
                                            one)</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="type" value="FREE_TEXT"
                                               id="free-text">
                                        <label class="form-check-label" for="free-text">Free Text</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="type" value="FILL_BLANK"
                                               id="fill-blank">
                                        <label class="form-check-label" for="fill-blank">Fill in the blanks</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="type" value="MATCHING"
                                               id="matching">
                                        <label class="form-check-label" for="matching">Match The Column</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                            <input type="submit" class="btn btn-success edit-points-modal" value="Create">
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    @else
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                    </div>
                    <div class="card-body">
                        {!! form($createForm) !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('components.admin.modals.add_quiz_section_modal')

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.add-section-btn', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#addQuizSectionModal .add-quiz-section').html(response);
                initializeTinyMCE("textarea.elm1");

            })
        });
        $(document).on('click', '.add-question-btn', function (e) {
            const url = $(this).attr('data-url');
            e.preventDefault();
            makeGetCall(url, {}, function (response) {
                $('#addQuestionModal .add-question-section').html(response);
                initializeTinyMCE("textarea.elm1");

            })
        });
        $(document).on('click', '.btn-save', function (e) {
            alertify.success('Quiz save successfully !')
        });

        document.addEventListener('DOMContentLoaded', function () {
            var triggerTabList = [].slice.call(document.querySelectorAll('#quizTabs a'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });
    </script>
@endpush
