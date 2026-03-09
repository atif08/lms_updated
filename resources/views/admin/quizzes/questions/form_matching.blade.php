@extends('layouts.master')
@section('title', __('Question'))
@section('content')
    @component('components.admin.page-title')
        @slot('li_1')
            {{ __('Settings') }}
        @endslot
        @slot('title')
            {{ __('Question') }}
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ __('Basic Info') }}</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ ($question->id)
                             ? route('quizzes.questions.update', ['quiz' => $quiz->id, 'question' => $question->id])
                             : route('quizzes.questions.store', ['quiz' => $quiz->id]) }}" accept-charset="UTF-8"
                          role="form" class="row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @csrf
                        @if($question->id)
                            @method('PUT')
                        @endif
                        <input type="hidden" name="type"
                               value="{{$question_type ?? $question->type }}">
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Section*</h4>
                                <select name="quiz_section_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($quiz_sections as $section)
                                        <option
                                            value="{{ $section->id }}" {{ (old('quiz_section_id', $question->quiz_section_id ?? '') == $section->id) ? 'selected' : '' }}>
                                            {{ $section->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('quiz_section_id')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Enter your question*</h4>
                                <textarea class="elm1 ck_editor" name="name" id="mce_33" aria-hidden="true">
                                    {{ old('name', $question->name ?? '') }}
                                </textarea>
                                @error('name')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Points*</h4>
                                <input class="form-control" name="points"
                                       value="{{ old('points', $question->points ?? '') }}" type="number" required/>
                                @error('points')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Create options and answer(s)*</h4>
                                <div id="answers_container">
                                    <input type="hidden" id="questionOptionsCount"
                                           value="{{ count(@$question->options()->get()) }}">
                                    @foreach($question->options as $index => $answer)
                                        <div class="answer" data-index="{{$index}}">
                                            <div class="row mb-1">
                                                <div class="col-md-5">
                                                    <input required type="text" class="form-control" name="answer[]" value="{{$answer->name}}">
                                                    <input required type="hidden" class="form-control" name="answer_status[]" value="1">
                                                </div>
                                                <div class="col-md-5">
                                                    <input required  type="text" name="option[]" value="{{$answer->answer}}" class="form-control" placeholder="Enter a possible answer" autocomplete="off">
                                                </div>
                                                <div class="col-md-2 selection-list d-flex justify-content-center align-items-center">
                                                    <i class="move-handle fa fa-arrows" aria-hidden="true"></i>
                                                    <i class="delete fa fa-trash" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('answer.0')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                                @error('answer_status.0')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 mb-2 mt-2">
                                <a href="#" class="add_field_button btn btn-white btn-cancel btn-sm">
                                    <i class="fa fa-plus"></i>&nbsp; Add more answers
                                </a>
                            </div>
                        </div>

                        <div class="form-group mt-2 mb-2">
                            <button class="btn btn-success btn-supplier-save" type="submit" id="sectionSave"><span
                                    class="fa fa-save"></span> Save
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let answerIndex = $('#questionOptionsCount').val();
            const answersContainer = document.getElementById('answers_container');
            const addFieldButton = document.querySelector('.add_field_button');

            function addAnswerField(index) {
                const fieldHtml = `
                                <div class="answer" data-index="${index}">
                                    <div class="row mb-1">
                                        <div class="col-md-5">
                                                <input required type="text" class="form-control" name="answer[]">
                                                <input required type="hidden" class="form-control" name="answer_status[]" value="1">
                                        </div>
                                        <div class="col-md-5">
                                            <input required  type="text" name="option[]" class="form-control" placeholder="Enter a possible answer" autocomplete="off">
                                        </div>
                                        <div class="col-md-2 selection-list d-flex justify-content-center align-items-center">
                                            <i class="move-handle fa fa-arrows" aria-hidden="true"></i>
                                            <i class="delete fa fa-trash" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                 `;
                answersContainer.insertAdjacentHTML('beforeend', fieldHtml);
            }

            addFieldButton.addEventListener('click', function (e) {
                e.preventDefault();
                addAnswerField(answerIndex);
                answerIndex++;
            });

            answersContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('delete')) {
                    e.target.closest('.answer').remove();
                }
            });
        });

    </script>
@endpush
