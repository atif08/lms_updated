<?php

namespace App\Admin\Quizzes\Controllers;

use App\Admin\DataTables\Quizzes\AjaxQuizDataTable;
use App\Admin\DataTables\Quizzes\QuizDataTable;
use App\Admin\Forms\Quizzes\QuizForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Services\FlashMessage;
use Domain\Quizzes\Models\Quiz;
use Domain\Users\Enums\PermissionsEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Support\Traits\GeneratesUniqueSlug;

class QuizController extends BaseController
{
    use GeneratesUniqueSlug;

    /**
     * Display a listing of the resource.
     */
    protected function hasControllerAccess(Request $request): bool
    {
        return $this->user->can(PermissionsEnum::QUIZ_REPOSITORY()->value);
    }

    public function index(Request $request)
    {
        $data_table = new QuizDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

//        $data_table->setFilterData(['batches' => Batch::all()]);

        return $this->renderView('admin.quizzes.index', compact('data_table'));
    }

    public function getQuiz(Request $request)
    {
        $data_table = new AjaxQuizDataTable(user: $this->user, request: $request);
        if ($request->ajax() && $request->has('date_range')) {
            return $data_table->getData();
        }

        return $this->renderView('admin.quizzes.ajax_index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $quiz = new Quiz;
        $createForm = $this->_getForm($formBuilder);

        return $this->renderView('admin.quizzes.form', compact('createForm', 'quiz'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $form = $this->_getForm($formBuilder);
            $form->redirectIfNotValid();

            $formValues = $form->getFieldValues();

            // Generate a unique slug
            $formValues['slug'] = $this->generateUniqueSlug($formValues['name'], Quiz::class);
            $formValues['user_id'] = $this->user->id;
            // dd($formValues);
            // Create the quiz
            $quiz = Quiz::create($formValues);

            DB::commit();

            FlashMessage::success('Quiz created successfully!');

            return redirect('admin/quizzes/'.$quiz->id.'/edit');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Quiz $quiz, FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder, $quiz);

        return $this->renderView('admin.quizzes.form', compact('createForm', 'quiz'));
    }

    public function update(Quiz $quiz, Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $quiz);
        $form->redirectIfNotValid();
        $quiz->update($form->getFieldValues());
        FlashMessage::success('Quiz updated successfully !');

        return to_route('quizzes.index');
    }

    public function changeStatus(Quiz $quiz): JsonResponse
    {
        $quiz->changeStatus();

        return $this->resJson('Successfully changed status');
    }

    private function _getForm(FormBuilder $form_builder, $item = null): Form
    {
        return $form_builder->create(QuizForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('quizzes.update', $item) : route('quizzes.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }

    public function destroy(Quiz $quiz): JsonResponse
    {
        $quiz->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $quiz]);
    }
}
