<?php

namespace App\Admin\Quizzes\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Quizzes\Enums\QuestionTypeEnum;
use Domain\Quizzes\Models\Question;
use Domain\Quizzes\Models\QuestionOption;
use Domain\Quizzes\Models\Quiz;
use Domain\Quizzes\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class QuestionController extends BaseController
{
    public function create(Quiz $quiz, FormBuilder $formBuilder): View
    {
        $question = new Question;
        $quiz_sections = $quiz->quiz_sections;
        $question_type = $this->request->get('type');

        return $this->renderView('admin.quizzes.questions.form_'.Str::lower($question_type), compact('quiz', 'question', 'quiz_sections', 'question_type'));
    }

    public function store(Quiz $quiz, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required',
            'points' => 'required|numeric',
            'quiz_section_id' => 'required|integer',
            'answer' => 'required|array|min:1',
            'answer.*' => 'required|string',
            'answer_status' => 'required|array|min:1',
            'answer_status.*' => 'required|integer',

        ]);
        // Create the question
        $question = Question::query()->create($validatedData);
        $quizSection = QuizSection::query()->find($validatedData['quiz_section_id']);

        $quizSection->questions()->attach($question->id);
        // Prepare the options data
        $options = [];

        foreach ($validatedData['answer'] as $index => $answerText) {
            $options[] = [
                'question_id' => $question->id,
                'name' => $answerText,
                'answer' => $request->get('type') == QuestionTypeEnum::MATCHING() ? $request->get('option')[$index] : '',
                'is_correct' => in_array($index, $validatedData['answer_status']),
            ];
        }

        // Create the options
        QuestionOption::query()->insert($options);
        // Flash success message and redirect
        FlashMessage::success('Question created successfully!');

        return redirect('admin/quizzes/'.$quiz->id.'/edit');
    }

    public function edit(Quiz $quiz, Question $question): View
    {
        $quiz_sections = QuizSection::where('quiz_id', $quiz->id)->get();

        return $this->renderView('admin.quizzes.questions.form_'.Str::lower($question->type), compact('quiz', 'question', 'quiz_sections'));

    }

    public function update(Quiz $quiz, Question $question, Request $request): RedirectResponse
    {
        //        dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'type' => 'required',
            'points' => 'required|numeric',
            'quiz_section_id' => 'required|integer',
            'answer' => 'required|array|min:1',
            'answer.*' => 'required|string',
            'answer_status' => 'required|array|min:1',
            'answer_status.*' => 'required|integer',
        ]);

        // Update the question
        $question->update($validatedData);
        $quizSection = QuizSection::query()->find($validatedData['quiz_section_id']);

        // If the question is not already attached to the quiz section, attach it
        if (! $quizSection->questions()->where('questions.id', $question->id)->exists()) {
            $quizSection->questions()->attach($question->id);
        }

        // Prepare the options data
        $options = [];

        foreach ($validatedData['answer'] as $index => $answerText) {
            $options[] = [
                'question_id' => $question->id,
                'answer' => $question->type == QuestionTypeEnum::MATCHING() ? $request->get('option')[$index] : '',
                'name' => $answerText,
                'is_correct' => in_array($index, $validatedData['answer_status']),
            ];
        }

        // Delete existing options
        $question->options()->delete();

        // Create new options
        QuestionOption::query()->insert($options);

        // Flash success message and redirect
        FlashMessage::success('Question updated successfully!');

        return redirect('admin/quizzes/'.$quiz->id.'/edit');
    }

    public function changeStatus(Question $question): JsonResponse
    {
        $question->changeStatus();

        return $this->resJson('Successfully changed status');
    }

    private function _getForm(FormBuilder $form_builder, $quiz, $item = null): Form
    {
        return $form_builder->create(QuestionForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            //            'url' => $item ? route('quiz-sections.update', $item) : route('quiz-sections.store'),
            'url' => $item ? route('quizzes.questions.update', ['quiz' => $quiz->id, 'question' => $item->id]) : route('quizzes.questions.store', ['quiz' => $quiz->id]),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }

    public function destroy(Quiz $quiz, Question $question): JsonResponse
    {
        $question->delete();

        return response()->json(['message' => 'Item deleted successfully', 'item' => $question]);
    }
}
