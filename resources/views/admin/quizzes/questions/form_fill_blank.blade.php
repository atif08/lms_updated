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
                             : route('quizzes.questions.store', ['quiz' => $quiz->id]) }}" accept-charset="UTF-8" role="form" class="row">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if($question->id)
                            @method('PUT')
                        @endif

                        <!-- Quiz Section Dropdown -->
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Section*</h4>
                                <input type="hidden" name="type" value="{{$question_type ?? $question->type  }}">
                                <select required name="quiz_section_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($quiz_sections as $section)
                                        <option value="{{ $section->id }}" {{ (old('quiz_section_id', $question->quiz_section_id ?? '') == $section->id) ? 'selected' : '' }}>
                                            {{ $section->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('quiz_section_id')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Question Input -->
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Enter your question*</h4>
                                <textarea class="elm1" name="name" id="mce_33" aria-hidden="true">
                                    {{ old('name', $question->name ?? '') }}
                                </textarea>
                                @error('name')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Points Input -->
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Points*</h4>
                                <input class="form-control" name="points" value="{{ old('points', $question->points ?? '') }}" type="number" required/>
                                @error('points')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Correct Answers Section -->
                        <div class="form-group">
                            <div class="col-lg-12 mb-2 mt-2">
                                <h4 class="card-title">Select the correct answer*</h4>
                                <div id="answers_container">
                                    @foreach($question->options as $index => $answer)
                                        @php
                                        $index = $index+1;
                                        @endphp
                                        <div class="answer" data-index="{{$index}}">
                                            <div class="row mb-12">
                                                <div class="col-md-2 selection-list d-flex justify-content-center align-items-center">
                                                    <label class="answer-radio-label" for="answer_status_${blankIndex}">
                                                        <p style="background-color: yellow;padding:5px;">Blank {{$index}}</p>
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" class="answer_status" id="answer_status_{{$index}}" name="answer_status[Blank_{{$index}}]" value="1">
                                                    <input required type="text" value="{{$answer->name}}" name="answer[Blank_{{$index}}]]]" class="form-control" id="answer_{{$index}}" placeholder="Enter a possible answer" autocomplete="off">
                                                </div>
                                                <div class="col-md-2 answer-action-icons text-right">
                                                    <i class="move-handle fa fa-arrows" aria-hidden="true"></i>
                                                    <i class="delete fa fa-trash" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Answer fields will be added here dynamically -->
                                </div>
                                @error('answer.0')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                                @error('answer_status.0')
                                <p class="has-error red">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Add Blank Button -->
                            <div class="col-lg-12 mb-2 mt-2">
                                <button type="button" class="btn btn-white btn-cancel btn-sm" id="add_blank_btn">
                                    <i class="fa fa-plus"></i>&nbsp; Add blank
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
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
            // Initialize the blank counter
            let blankIndex = {{$question->options()->count() > 0 ? $question->options()->count()+1:1}};

            // Add blank field and text in the editor
            const addBlankButton = document.getElementById('add_blank_btn');
            const answersContainer = document.getElementById('answers_container');

            // Function to insert blank into editor and form
            function addBlankToEditorAndForm(editor) {
                const blankText = `[[Blank_${blankIndex}]]`;
                const highlightedText = `<span style="background-color: yellow; padding: 2px;">${blankText}</span>&nbsp;`;  // Add non-breaking space

                // Insert into TinyMCE editor
                editor.execCommand('mceInsertContent', false, highlightedText);

                // Add corresponding input field in form
                const fieldHtml = `
                <div class="answer" data-index="${blankIndex}">
                    <div class="row mb-12">
                        <div class="col-md-2 selection-list d-flex justify-content-center align-items-center">
                            <label class="answer-radio-label" for="answer_status_${blankIndex}">
                                <p style="background-color: yellow;padding:5px;">Blank ${blankIndex}</p>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" class="answer_status" id="answer_status_${blankIndex}" name="answer_status[Blank_${blankIndex}]" value="1">
                            <input required type="text" name="answer[Blank_${blankIndex}]]]" class="form-control" id="answer_${blankIndex}" placeholder="Enter a possible answer" autocomplete="off">
                        </div>
                        <div class="col-md-2 answer-action-icons text-right">
                            <i class="move-handle fa fa-arrows" aria-hidden="true"></i>
                            <i class="delete fa fa-trash" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            `;
                // Append field to answers container
                answersContainer.insertAdjacentHTML('beforeend', fieldHtml);

                // Increment blank index
                blankIndex++;
            }

            // Bind button click to insert blank field
            addBlankButton.addEventListener('click', function (e) {
                e.preventDefault();
                addBlankToEditorAndForm(tinymce.activeEditor);
            });

            // Remove the blank from form and TinyMCE editor
            answersContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('delete')) {
                    const answerElement = e.target.closest('.answer');
                    const blankIndexToRemove = answerElement.getAttribute('data-index');

                    // Remove the answer field from form
                    answerElement.remove();

                    // Remove the corresponding [[Blank_X]] from TinyMCE editor
                    const editor = tinymce.activeEditor;
                    const content = editor.getContent();

                    // Use regex to remove the corresponding Blank_X tag
                    const regex = new RegExp(`\\[\\[Blank_${blankIndexToRemove}\\]\\]`, 'g');
                    const updatedContent = content.replace(regex, '');

                    // Update the TinyMCE content without the removed blank
                    editor.setContent(updatedContent);
                }
            });

        });
    </script>

@endpush
