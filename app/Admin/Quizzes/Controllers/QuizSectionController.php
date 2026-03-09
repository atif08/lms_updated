<?php

namespace App\Admin\Quizzes\Controllers;

use App\Admin\DataTables\Quizzes\QuizSectionDataTable;
use App\Admin\Forms\Quizzes\QuizSectionForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Quizzes\Models\Quiz;
use Domain\Quizzes\Models\QuizSection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class QuizSectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    //    public function index(Request $request)
    //    {
    //        $data_table = new QuizSectionDataTable(user: $this->user, request: $request);
    //        if ($request->ajax()) {
    //            return $data_table->getData();
    //        }
    //        return $this->renderView('admin.quiz_sections.index', compact('data_table'));
    //    }

    public function create(FormBuilder $formBuilder): View
    {
        $quizSection = new QuizSection;
        $createForm = $this->_getForm($formBuilder, null, $this->request->get('quiz'));

        return $this->renderView('admin.quizzes.quiz_sections.form', compact('createForm', 'quizSection'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $quiz = Quiz::query()->find($request->get('quiz_id'));
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        $quiz->quiz_sections()->create($form->getFieldValues());
        FlashMessage::success('Quiz section created successfully!');

        return redirect('admin/quizzes/'.$quiz->id.'/edit');
    }

    public function edit(QuizSection $quizSection, FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder, $quizSection, $quizSection->quiz_id);

        return $this->renderView('admin.quizzes.quiz_sections.form', compact('createForm', 'quizSection'));
    }

    public function update(QuizSection $quizSection, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $quizSection, $quizSection->quiz_id);
        $form->redirectIfNotValid();

        $quizSection->update($form->getFieldValues());
        FlashMessage::success('Quiz section updated successfully!');

        return redirect('admin/quizzes/'.$quizSection->quiz_id.'/edit');
    }

    public function changeStatus(QuizSection $quizSection): JsonResponse
    {
        $quizSection->changeStatus();

        return $this->resJson('Successfully changed status');
    }

    private function _getForm(FormBuilder $form_builder, $item = null, $quiz = null): Form
    {

        return $form_builder->create(QuizSectionForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('quiz-sections.update', $item->id) : route('quiz-sections.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'quiz_id' => $quiz,
            'class' => get_class($this),
        ]);
    }

    public function destroy(QuizSection $quizSection): JsonResponse
    {
        $id = $quizSection->quiz_id;
        $quizSection->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $quizSection]);
    }
}
