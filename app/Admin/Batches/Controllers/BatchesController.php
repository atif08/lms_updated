<?php

namespace App\Admin\Batches\Controllers;

use App\Admin\DataTables\BatchesDataTable;
use App\Admin\Forms\BatchForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class BatchesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_table = new BatchesDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.batches.index', compact('data_table'));
    }

    public function create(FormBuilder $formBuilder): View
    {
        $form = $this->_getForm($formBuilder);

        return $this->renderView('admin.batches.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        Batch::query()->create($form->getFieldValues());
        FlashMessage::success('Batch created successfully !');

        return to_route('batches.index');
    }

    public function edit(Batch $batch, FormBuilder $formBuilder): View
    {
        $form = $this->_getForm($formBuilder, $batch);

        return $this->renderView('admin.batches.form', compact('form'));
    }

    public function update(Batch $batch, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $batch);

        $form->redirectIfNotValid();

        $batch->update($form->getFieldValues());

        FlashMessage::success('Batch updated successfully !');

        return to_route('batches.index');
    }

    public function destroy(Batch $batch): JsonResponse
    {
        $batch->delete();

        return response()->json(['message' => 'item deleted successfully']);
    }

    private function _getForm(FormBuilder $form_builder, $batch = null): Form
    {
        return $form_builder->create(BatchForm::class, [
            'method' => $batch ? 'PUT' : 'POST',
            'url' => $batch ? route('batches.update', $batch->id) : route('batches.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'batch' => $batch,
            'class' => get_class($this),
        ]);
    }

    public function getUsers(Batch $batch, Request $request)
    {
        return $batch->students()
            ->active()
            ->student()
            ->whereHas('enrolled_courses', function ($q) use ($request) {
                $q->where('course_id', $request->get('course_id'));
            })
            ->get();
    }
}
