<?php $page = 'course-grid'; ?>
@extends('frontend.layouts.mainlayout')

@section('style')
    <style>

        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        header {
            display: none;
        }

        footer {
            display: none;
        }

        .questionSect h5 {
            display: flex;
            align-items: center;
        }

        .question-number,
        .question-text {
            display: inline-block;
            margin-right: 10px;
            /* Adjust the space between the number and the question text */
        }

        /* .question-text {
            white-space: nowrap;
        } */

        .question-text p {
            margin-top: 0.9em;
        }

        /* latest-quiz-styles */
        .quiz-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
            padding: 10px 0;
        }

        .quiz-header div {
            text-align: center;
        }

        .quiz-header h4 {
            margin: 5px 0;
            font-size: 1.25rem;
        }

        .custom-input-check {
            float: none !important;
            margin-left: 0 !important;
        }

        .center {
            text-align: center;
        }

        .form-check {
            cursor: pointer;
        }

        /* quiz css */
        .custom-container-h {
            padding: 8rem;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background-color: white;
        }

        .quiz-card {
            text-align: center;
            margin: auto;
        }

        .quiz-card img {
            width: 100px;
            margin-bottom: 15px;
        }

        .quiz-card h5 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quiz-card p {
            color: #666;
            font-size: 1.9rem;
            margin-bottom: 20px;
        }

        .quiz-card button {
            background-color: #6C63FF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            box-shadow: 0 4px #4e4bd1;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .quiz-card button:hover {
            background-color: #4e4bd1;
            box-shadow: 0 2px #4e4bd1;
        }

        .quizHideSection {
            height: 100vh;
            background-color: #F8F8F8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-font-weight {
            font-weight: bold;
        }

        .full-width-textarea {
            width: 100%; /* Makes the textarea full width */
            resize: none; /* Disables resizing */
            box-sizing: border-box; /* Ensures padding is included in width */
            height: 100px;
        }

        .drop {
            /*margin: 20px 0;*/
            /* padding: 5px; */
            border: 2px dotted orange;
            border-radius: 5px;
            /* height: 56px; */
        }

        .drop p {
            text-align: center;
        }

        .custom-height-drop {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 56px;
        }

        @media (max-width: 992px) {
          .quiz-header{
             gap: 15px;
           }

           .custom-img-h{
            height: 70px;
           }
        }

    </style>
@endsection

@section('content')

    <div class="quizHideSection center">
        <div class="custom-container-h">
            <div class="quiz-card">
                <img src="{{\Illuminate\Support\Facades\URL::asset('assets/images/quiz.png')}}" alt="Quiz Image"
                     class="img-fluid">
                <h5 class="custom-font">{{ $quiz->name }}</h5>
                <p class="custom-font"><strong>{{ $quiz->quiz_questions->count() }} Questions</strong></p>
                <button type="button" class="btn btn-primary" id="startQuiz">Start Quiz</button>
            </div>
        </div>
    </div>
    <div class="container">

        @include('frontend.quizzes.partials.quiz-form-header')

        <form action="{{ route('students.quiz.submit') }}" method="POST" class="quiz-form">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <input type="hidden" name="topic_id" value="{{ $topic->id }}">
            <div id="quiz_sections" class="p-2" style="display:none;">
                @foreach($quiz->quiz_sections as $section)
                    <div class="card my-4">
                        <div class="card-header">
                            <h4>{{ $section->title }}</h4>
                            <p>{!! $section->description !!}</p>
                        </div>
                        <div class="card-body">
                            @foreach($section->questions as $question)
                                <div class="mb-4 questionSect border p-3 rounded">
                                    <h5>
                                        <span class="question-number">{!! $loop->iteration.'.' !!}</span>
                                        @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FILL_BLANK())
                                            <span class="blank"
                                                  data-question-id="{{$question->id}}">{!! $question->name !!}</span>
                                        @else
                                            <span class="question-text">{!! $question->name !!}</span>
                                        @endif
                                    </h5>
                                    <div class="row">
                                        @if($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::ONE_CORRECT())

                                            @include('frontend.quizzes.partials.one_correct')

                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MULTIPLE_CORRECT())

                                            @include('frontend.quizzes.partials.multi_correct')

                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::FREE_TEXT())

                                            @include('frontend.quizzes.partials.free_text')

                                        @elseif($question->type == \Domain\Quizzes\Enums\QuestionTypeEnum::MATCHING())

                                            @include('frontend.quizzes.partials.matching')

                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Submit Answers</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- SweetAlert2 JS -->
{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>--}}
    <script src="{{ URL::asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ URL::asset('/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/plugins/drag/draganddrop.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Select all elements with class "blank"
            const blankElements = document.querySelectorAll('.blank');

            blankElements.forEach(blankElement => {
                // Get the paragraph element inside the current blank element
                const paragraph = blankElement.querySelector('p');
                let paragraphHTML = paragraph.innerHTML;

                // Regex to match all [[Blank_X]] occurrences (X being a number)
                const blankRegex = /\[\[Blank_(\d+)\]\]/g;
                let match;
                let blankIndex = 1;  // Start blank counter

                // Replace all matches of [[Blank_X]] with corresponding input fields
                while ((match = blankRegex.exec(paragraphHTML)) !== null) {
                    // Create a new input field
                    const input = document.createElement('input');
                    input.placeholder = 'Type answer ...'; // Adjust type as necessary
                    input.type = 'text'; // Adjust type as necessary
                    input.name = `fill_blank[${blankElement.dataset.questionId}][]`; // Dynamic name
                    input.style.border = 'none';
                    input.style.background = 'none';
                    input.style.display = 'inline-block'; // Keep it inline with text

                    // Replace the current [[Blank_X]] with the input field's outerHTML
                    paragraphHTML = paragraphHTML.replace(`[[Blank_${match[1]}]]`, input.outerHTML);

                    blankIndex++; // Increment blank counter
                }
                // Set the updated HTML back to the paragraph element
                paragraph.innerHTML = paragraphHTML;
            });
        });

        $(document).ready(function () {
            $('#startQuiz').on('click', function () {
                $('.quizHideSection').hide();
                $('#quiz_sections').show();
                $('.quiz-header').show(); // Show the header container
                $('.alert.alert-primary').show();
            });
        });

        // Function For Timer
        const timerElement = document.getElementById('timer');
        let timeLeft = 600; // 10 minutes in seconds
        function startTimer() {
            const timerInterval = setInterval(() => {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    // Auto-submit form when time runs out
                    document.getElementsByClassName('quiz-form').submit();
                }
            }, 1000);
        }

        startTimer();

        // Function for the redirection to dashboard button
        function redirectToDashboard() {
            // window.location.href = '/students/profile';
            window.history.back();
        }

        function validateAnswers() {
            let allAnswered = true;
            return true;

            $('.questionSect').each(function () {
                const questionId = $(this).find('input[type=radio]').attr('name').match(/\d+/)[0];
                if ($(`input[name="answers[${questionId}]"]:checked`).length === 0) {
                    allAnswered = false;
                    return false; // Exit the loop
                }
            });
            return allAnswered;
        }

        $('form').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            if (validateAnswers()) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to change your answers once submitted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).off('submit').submit(); // Submit the form if confirmed
                    }
                });
            } else {
                Swal.fire({
                    title: 'Incomplete',
                    text: "Please answer all questions before submitting.",
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    </script>

@endpush
