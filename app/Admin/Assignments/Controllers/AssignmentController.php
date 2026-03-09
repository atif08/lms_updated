<?php

namespace App\Admin\Assignments\Controllers;

use App\Admin\DataTables\AssignmentsDataTable;
use App\Admin\Forms\Assignment\AssignmentForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Services\FlashMessage;
use Domain\Assignment\Models\Assignment;
use Domain\Courses\Models\Course;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class AssignmentController extends BaseController
{
    public function index(Course $course, Request $request)
    {
        $data_table = new AssignmentsDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

//        $data_table->setFilterData([
//            'batches' => Batch::all(),
//            'courses' => Course::query()->active()->get(),
//        ]);

        return $this->renderView('admin.assignments.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $this->_getForm($formBuilder, null);

        return $this->renderView('admin.assignments.form', compact('form'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {

        $form = $this->_getForm($formBuilder, null);

        $form->redirectIfNotValid();

        $assignment = Assignment::query()->create($form->getFieldValues());

        $assignment->users()->attach($request->students);

        if ($request->has('media')) {
            $assignment->addFromMediaLibraryRequest($request->media)->toMediaCollection(MediaCollectionEnum::ASSIGNMENT());
        }

        FlashMessage::success('Assignment created successfully !');

        return to_route('assignments.index');
    }

    public function edit(Assignment $assignment, FormBuilder $formBuilder)
    {

        $form = $this->_getForm($formBuilder, $assignment);

        return $this->renderView('admin.assignments.form', compact('form'));

    }

    public function update(Assignment $assignment, FormBuilder $formBuilder, Request $request): RedirectResponse
    {

        $form = $this->_getForm($formBuilder, $assignment);

        $form->redirectIfNotValid();

        $assignment->update($form->getFieldValues());

        $assignment->users()->sync($request->students);

        if ($request->has('media')) {

            $assignment->syncFromMediaLibraryRequest($request->media)->toMediaCollection(MediaCollectionEnum::ASSIGNMENT());
        }

        FlashMessage::success('Assignment updated successfully !');

        return to_route('assignments.index');
    }

    private function _getForm(FormBuilder $form_builder, ?Assignment $assignment): Form
    {
        return $form_builder->create(AssignmentForm::class, [
            'method' => $assignment ? 'PUT' : 'POST',
            'url' => $assignment ? route('assignments.update', $assignment->id) : route('assignments.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $assignment,
            'class' => get_class($this),
        ]);
    }
}
