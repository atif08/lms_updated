<?php

namespace App\Admin\Courses\Controllers;

use App\Admin\DataTables\Courses\CoursesDataTable;
use App\Admin\DataTables\Courses\TopicDataTable;
use App\Admin\Forms\Courses\CourseForm;
use App\Http\Controllers\BaseController;
use App\Notifications\CourseAnnouncementNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Topic;
use Domain\Users\Enums\PermissionsEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class CoursesController extends BaseController
{
    public function index(Request $request): View|JsonResponse
    {
        if (! auth()->user()->can(PermissionsEnum::COURSES()->value)) {
            abort(403, 'Unauthorized action.');
        }
        $data_table = new CoursesDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.courses.index', compact('data_table'));

    }

    public function create(FormBuilder $formBuilder): View
    {
        $course = new Course;
        $createForm = $this->_getForm($formBuilder);

        return $this->renderView('admin.courses.form', compact('createForm', 'course'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        $course = $request->user()->courses()->create($form->getFieldValues());
        $course->teachers()->attach($form->getFieldValues()['teachers'] ?? []);
        if ($request->has('media')) {
            $course->syncFromMediaLibraryRequest($request->media)->toMediaCollection('avatar');
        }
        FlashMessage::success('Course created successfully !');

        return redirect('admin/courses/'.$course->id.'/edit');
    }

    public function edit(Course $course, FormBuilder $formBuilder): View
    {

        $createForm = $this->_getForm($formBuilder, $course);

        return $this->renderView('admin.courses.form', compact('createForm', 'course'));
    }

    public function update(Course $course, Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $course);

        $form->redirectIfNotValid();

        if (! empty($request->get('announcement')) && $request->get('announcement') !== $course->announcement) {
            Notification::send($course->students, new CourseAnnouncementNotification($request->get('announcement')));

        }

        $course->update($form->getFieldValues());

        $course->teachers()->sync($form->getFieldValues()['teachers'] ?? []);

        $course->syncFromMediaLibraryRequest($request->get('media'))->toMediaCollection('avatar');

        FlashMessage::success('Course updated successfully !');

        return to_route('courses.index');
    }

    public function getTopics(Course $course, Request $request)
    {
        $data_table = new TopicDataTable(user: $this->user, request: $request);

        if ($request->ajax()) {

            return $data_table->getData();
        }

        return $this->renderView('admin.courses.topics.index', compact('data_table', 'course'));
        // create topic datatable here
    }

    public function changeStatus(Course $course): JsonResponse
    {
        $course->changeStatus();

        return $this->resJson('Successfully changed status');
    }

    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $course]);
    }

    private function _getForm(FormBuilder $form_builder, $item = null): Form
    {
        return $form_builder->create(CourseForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('courses.update', $item) : route('courses.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }
}
