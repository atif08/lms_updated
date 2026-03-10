<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Courses\Models\Topic;
use Domain\Quizzes\Enums\QuestionTypeEnum;
use Domain\Quizzes\Models\Quiz;
use Domain\Quizzes\Models\QuizAttempt;
use Domain\Quizzes\Models\QuizAttemptAnswer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StudentQuizController extends BaseController
{
    public function getQuizAttempts(Request $request): Response
    {
        $quiz_attempts = $request->user()->quiz_attempts()->latest()->get()->map(fn ($a) => [
            'id' => $a->id,
            'quiz_name' => $a->quiz_name,
            'topic_name' => $a->topic?->name,
            'total_questions' => $a->total_questions,
            'total_points' => $a->total_points,
            'correct_answers' => $a->correct_answers,
            'incorrect_answers' => $a->incorrect_answers,
            'earned_points' => $a->earned_points,
            'percentage' => get_points_percentage($a->total_points, $a->earned_points),
            'date' => $a->created_at->format(config('constants.date_format')),
        ]);

        return Inertia::render('Students/QuizAttempts', compact('quiz_attempts'));
    }

    public function show($topic_id, $id, Request $request): Response
    {
        $topic = Topic::find($topic_id) ?? new Topic;
        $quiz = Quiz::with('quiz_sections.questions.options')->findOrFail($id);

        $quiz_data = [
            'id' => $quiz->id,
            'name' => $quiz->name,
            'total_questions' => $quiz->quiz_questions()->count(),
            'sections' => $quiz->quiz_sections->map(fn ($section) => [
                'id' => $section->id,
                'title' => $section->title,
                'description' => $section->description,
                'questions' => $section->questions->map(fn ($q) => [
                    'id' => $q->id,
                    'name' => $q->name,
                    'type' => $q->type,
                    'points' => $q->points,
                    'options' => $q->options->map(fn ($o) => [
                        'id' => $o->id,
                        'name' => $o->name,
                        'answer' => $o->answer,
                    ]),
                ]),
            ]),
        ];

        return Inertia::render('Quizzes/TakeQuiz', [
            'quiz' => $quiz_data,
            'topic' => ['id' => $topic->id, 'name' => $topic->name],
        ]);
    }

    public function quizResult(QuizAttempt $quiz_attempt): Response
    {
        $quiz_attempt->load('quiz.quiz_sections.questions.options', 'answers');
        $answers = collect($quiz_attempt->answers);

        $sections = $quiz_attempt->quiz->quiz_sections->map(fn ($section) => [
            'id' => $section->id,
            'title' => $section->title,
            'description' => $section->description,
            'questions' => $section->questions->map(function ($q) use ($answers) {
                $submitted = $answers->where('quiz_question_id', $q->id)->values();

                $is_correct = match ($q->type) {
                    QuestionTypeEnum::ONE_CORRECT()->value,
                    QuestionTypeEnum::MULTIPLE_CORRECT()->value => $q->isCorrect($submitted->pluck('question_option_id')->toArray()),
                    default => $q->isCorrect($submitted->pluck('answer_text')->toArray()),
                };

                return [
                    'id' => $q->id,
                    'name' => $q->name,
                    'type' => $q->type,
                    'points' => $q->points,
                    'is_correct' => $is_correct,
                    'options' => $q->options->map(fn ($o) => [
                        'id' => $o->id,
                        'name' => $o->name,
                        'answer' => $o->answer,
                        'is_correct' => $o->is_correct,
                        'submitted' => $submitted->contains('question_option_id', $o->id),
                        'answer_text' => $submitted->where('question_option_id', $o->id)->first()?->answer_text,
                    ]),
                    'submitted_answers' => $submitted->map(fn ($a) => [
                        'question_option_id' => $a->question_option_id,
                        'answer_text' => $a->answer_text,
                    ]),
                ];
            }),
        ]);

        $attempt = [
            'id' => $quiz_attempt->id,
            'quiz_name' => $quiz_attempt->quiz->name,
            'participant_name' => $quiz_attempt->participant->name,
            'participant_email' => $quiz_attempt->participant->email,
            'correct_answers' => $quiz_attempt->correct_answers,
            'incorrect_answers' => $quiz_attempt->incorrect_answers,
            'total_questions' => $quiz_attempt->total_questions,
            'total_points' => $quiz_attempt->total_points,
            'earned_points' => $quiz_attempt->earned_points,
            'percentage' => get_points_percentage($quiz_attempt->total_points, $quiz_attempt->earned_points),
            'sections' => $sections,
        ];

        return Inertia::render('Quizzes/Result', ['attempt' => $attempt]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'topic_id' => 'required|exists:topics,id',
        ]);

        $user = $request->user();
        $quiz = Quiz::query()->with('quiz_questions.options')->findOrFail($request->get('quiz_id'));

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

        foreach ($request->get('answers', []) as $questionId => $optionId) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);
            $question->isCorrect([$optionId])
                ? $quiz_attempt->increment('correct_answers') && $quiz_attempt->increment('earned_points', $question->points)
                : $quiz_attempt->increment('incorrect_answers');

            QuizAttemptAnswer::query()->create([
                'quiz_attempt_id' => $quiz_attempt->id,
                'quiz_question_id' => $questionId,
                'question_option_id' => $optionId,
            ]);
        }

        foreach ($request->get('multi_answers', []) as $questionId => $selectedOptions) {
            $question = $quiz->quiz_questions->firstWhere('id', $questionId);
            $question->isCorrect($selectedOptions)
                ? $quiz_attempt->increment('correct_answers') && $quiz_attempt->increment('earned_points', $question->points)
                : $quiz_attempt->increment('incorrect_answers');

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
            $question->options->pluck('answer')->toArray() == $selectedOptions
                ? $quiz_attempt->increment('correct_answers') && $quiz_attempt->increment('earned_points', $question->points)
                : $quiz_attempt->increment('incorrect_answers');

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
            $question->isCorrect($submited_blanks)
                ? $quiz_attempt->increment('correct_answers') && $quiz_attempt->increment('earned_points', $question->points)
                : $quiz_attempt->increment('incorrect_answers');

            foreach ($submited_blanks as $key => $blank_text) {
                QuizAttemptAnswer::query()->create([
                    'quiz_attempt_id' => $quiz_attempt->id,
                    'quiz_question_id' => $questionId,
                    'question_option_id' => $question->options[$key]->id,
                    'answer_text' => trim($blank_text),
                ]);
            }
        }

        foreach ($request->get('free_text', []) as $questionId => $answer) {
            QuizAttemptAnswer::query()->create([
                'quiz_attempt_id' => $quiz_attempt->id,
                'answer_text' => $answer,
                'quiz_question_id' => $questionId,
            ]);
        }

        FlashMessage::success('Quiz submitted successfully');

        return to_route('students.get.quiz-attempts');
    }
}
