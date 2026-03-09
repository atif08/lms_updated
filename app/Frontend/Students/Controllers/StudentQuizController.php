<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Notifications\QuizResultStudentNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\Topic;
use Domain\Quizzes\Models\Quiz;
use Domain\Quizzes\Models\QuizAttempt;
use Domain\Quizzes\Models\QuizAttemptAnswer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentQuizController extends BaseController
{
    public function getQuizAttempts(Request $request)
    {

        $quiz_attempts = $request->user()->quiz_attempts()->latest()->get();

        return view('frontend/students/student-quiz', compact('quiz_attempts'));
    }

    public function show($topic_id, $id, Request $request)
    {

        $topic = Topic::find($topic_id) ?? new Topic;
        $quiz = Quiz::with('quiz_sections.questions.options')->findOrFail($id);
        $isPreview = $request->query('preview', false);

        return view('frontend/quizzes/form', compact('quiz', 'isPreview', 'topic'));
    }

    public function quizResult(QuizAttempt $quiz_attempt)
    {
        $quiz_attempt_answers = collect($quiz_attempt->answers);
        $user = Auth::user();
        //        return view('frontend/quizzes/quiz-result', compact('quiz_result'));

        return view('frontend/quizzes/quiz-result', compact('quiz_attempt', 'quiz_attempt_answers', 'user'));
    }

    public function submit(Request $request)
    {
        //        dd($request->all());

        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'topic_id' => 'required|exists:topics,id',
            //            'answers'  => 'required|array',
        ]);

        $user = $request->user();
        $quiz = Quiz::query()->with('quiz_questions.options')->findOrFail($request->get('quiz_id'));

        // Create quiz attempt
        $quiz_attempt = $user->quiz_attempts()->create([
            'quiz_name' => $quiz->name,
            'total_questions' => $quiz->quiz_questions()->count(),
            'total_points' => $quiz->totalPoints(),
            'quiz_id' => $request->get('quiz_id'),
            'topic_id' => $request->get('topic_id'),
            'is_re_attempt' => ordinal($user->quiz_attempts()
                ->where('topic_id', $request->get('topic_id'))
                ->where('quiz_id', $request->get('quiz_id'))
                ->count() + 1),
        ]);

        // Handle single-answer questions
        foreach ($request->get('answers', []) as $questionId => $optionId) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);
            // Increment correct/incorrect answers and points
            if ($question->isCorrect([$optionId])) {
                $quiz_attempt->increment('correct_answers');
                $quiz_attempt->increment('earned_points', $question->points);
            } else {
                $quiz_attempt->increment('incorrect_answers');
            }

            // Record each answer
            QuizAttemptAnswer::query()->create([
                'quiz_attempt_id' => $quiz_attempt->id,
                'quiz_question_id' => $questionId,
                'question_option_id' => $optionId,
            ]);
        }

        // Handle multi-select questions
        foreach ($request->get('multi_answers', []) as $questionId => $selectedOptions) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);

            // Compare selected options with correct options
            if ($question->isCorrect($selectedOptions)) {
                $quiz_attempt->increment('correct_answers');
                $quiz_attempt->increment('earned_points', $question->points);
            } else {
                $quiz_attempt->increment('incorrect_answers');
            }

            // Record each selected option
            foreach ($selectedOptions as $optionId) {
                QuizAttemptAnswer::create([
                    'quiz_attempt_id' => $quiz_attempt->id,
                    'question_option_id' => $optionId,
                    'quiz_question_id' => $questionId,
                ]);
            }
        }

        foreach ($request->get('matching_answers', []) as $questionId => $selectedOptions) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);

            // Compare selected options with correct options
            if ($question->options->pluck('answer')->toArray() == $selectedOptions) {
                $quiz_attempt->increment('correct_answers');
                $quiz_attempt->increment('earned_points', $question->points);
            } else {
                $quiz_attempt->increment('incorrect_answers');
            }

            // Record each selected option
            foreach ($selectedOptions as $answer) {
                QuizAttemptAnswer::create([
                    'quiz_attempt_id' => $quiz_attempt->id,
                    'quiz_question_id' => $questionId,
                    'question_option_id' => $question->options()->where('answer', trim($answer))->first()->id,
                    'answer_text' => trim($answer),
                ]);
            }
        }

        foreach ($request->get('fill_blank', []) as $questionId => $submited_blanks) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);
            // Compare selected options with correct options
            if ($question->isCorrect($submited_blanks)) {
                $quiz_attempt->increment('correct_answers');
                $quiz_attempt->increment('earned_points', $question->points);
            } else {
                $quiz_attempt->increment('incorrect_answers');
            }
            // Record each selected option
            foreach ($submited_blanks as $key => $blank_text) {
                QuizAttemptAnswer::query()->create([
                    'quiz_attempt_id' => $quiz_attempt->id,
                    'quiz_question_id' => $questionId,
                    'question_option_id' => $question->options[$key]->id,
                    'answer_text' => trim($blank_text),
                ]);
            }
        }

        // Handle free-text answers
        foreach ($request->get('free_text', []) as $questionId => $answer) {
            QuizAttemptAnswer::query()->create([
                'quiz_attempt_id' => $quiz_attempt->id,
                'answer_text' => $answer,
                'quiz_question_id' => $questionId,
            ]);
        }

        // Notify user of quiz submission
        // $user->notify(new QuizResultStudentNotification($quizAttempt));

        FlashMessage::success('Quiz submitted successfully');

        return to_route('students.get.quiz-attempts');
    }
}
