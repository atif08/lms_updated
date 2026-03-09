<?php

namespace App\Admin\Assignments\Controllers;

use App\Admin\DataTables\SubmittedAssignmentsDataTable;
use App\Admin\DataTables\SubmittedAssignmentsDetailDataTable;
use App\Admin\Forms\Assignment\AssignmentCommentForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Notifications\AssignmentApprovedNotification;
use App\Notifications\AssignmentRejectNotification;
use App\Services\FlashMessage;
use Domain\Assignment\Enums\AssignmentStatusEnum;
use Domain\Assignment\Models\SubmittedAssignment;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Topic;
use Domain\Users\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class SubmittedAssignmentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course, Request $request)
    {
        $data_table = new SubmittedAssignmentsDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {
            return $data_table->getData();
        }

//        $data_table->setFilterData([
//            'batches' => Batch::all(),
//            'courses' => Course::query()->active()->get(),
//        ]);

        return $this->renderView('admin.assignments.submitted_assignments', compact('data_table'));
    }

    public function detail(User $student, Topic $topic, Request $request)
    {

        $request->merge(['user_id' => $student->id, 'topic_id' => $topic->id]);

        $data_table = new SubmittedAssignmentsDetailDataTable(user: $this->user, request: $request);

        $batches = Batch::all();
        $courses = Course::query()->active()->get();

        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.assignments.submitted_assignments_detail', compact('data_table', 'courses', 'batches'));

    }

    public function edit(SubmittedAssignment $submittedAssignment, FormBuilder $formBuilder)
    {

        $createForm = $this->_getForm($formBuilder, $submittedAssignment);

        return $this->renderView('components.admin.modals.modal_form', compact('createForm'));
    }

    public function update(SubmittedAssignment $submittedAssignment, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $submittedAssignment);

        $form->redirectIfNotValid();

        $submittedAssignment->update($form->getFieldValues());

        if ($submittedAssignment->status == AssignmentStatusEnum::APPROVED()) {
            $submittedAssignment->user->notify(new AssignmentApprovedNotification($request->get('comments'), $submittedAssignment, $submittedAssignment->submissionable->name));
        } else {
            $submittedAssignment->user->notify(new AssignmentRejectNotification($request->get('comments'), $submittedAssignment, $submittedAssignment->submissionable->name));
        }

        FlashMessage::success('Comment added successfully !');

        return to_route('submitted-assignments.index');
    }

    private function _getForm(FormBuilder $form_builder, $assignment = null)
    {

        return $form_builder->create(AssignmentCommentForm::class, [
            'method' => $assignment ? 'PUT' : 'POST',
            'url' => $assignment ? route('submitted-assignments.update', $assignment->id) : route('submitted-assignments.store'),
            'role' => 'form',
            'class' => 'row',
            'id' => 'update-submitted-assignment',
        ], [
            'item' => $assignment,
            'class' => get_class($this),

        ]);
    }
}
