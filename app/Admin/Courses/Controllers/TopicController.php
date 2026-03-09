<?php

namespace App\Admin\Courses\Controllers;

use App\Admin\DataTables\Courses\TopicDataTable;
use App\Admin\Forms\Courses\TopicForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Assignment\Actions\ConvertLessonMediaToPdfAction;
use Domain\Assignment\Models\Assignment;
use Domain\Assignment\Models\AssignmentUser;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Domain\Courses\Models\Topic;
use Domain\Courses\Models\Topicable;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Domain\Quizzes\Models\Quiz;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class TopicController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course, Request $request)
    {
        $data_table = new TopicDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.courses.topics.index', compact('data_table', 'course'));
    }

    public function create(Course $course, FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder, $course);

        return $this->renderView('admin.courses.topics.form_ajax', compact('createForm'));
    }

    public function store(Course $course, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $course);

        $form->redirectIfNotValid();

        /** @var Topic $topic */
        $topic = $course->topics()->create($form->getFieldValues() + ['order' => Topic::max('order') + 1]);

        $this->createAssignment($topic, $request);

        FlashMessage::success('Course topic created successfully !');

        return redirect('admin/courses/'.$course->id.'/edit');
    }

    public function edit(Topic $topic, FormBuilder $formBuilder): View
    {
        $existingDueDates = $this->getExistingDueDates($topic->load('assignment'));

        $createForm = $this->_getForm($formBuilder, $topic->course, $topic, $existingDueDates);

        return $this->renderView('admin.courses.topics.form_ajax', compact('createForm'));
    }

    public function update(Course $course, Topic $topic, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $request->validate([
            'students' => ['required', 'array'], // students array required
            'students.*.due_date' => ['required', 'date'],
            'students.*.student_ids' => ['required', 'array', 'min:1'],
            'students.*.student_ids.*' => ['required', 'distinct', 'integer', 'exists:users,id'],
        ]);

        $form = $this->_getForm($formBuilder, $course, $topic, []);

        $form->redirectIfNotValid();

        $topic->update($form->getFieldValues());

        $this->createAssignment($topic, $request);

        return redirect()->back();
    }

    public function destroy(Topic $topic): JsonResponse
    {
        /** remove lessons of topics */
        if (count($topic->topicables) > 0) {
            foreach ($topic->topicables as $topicable) {
                $this->detachTopicable($topicable);
            }
        }
        $topic->clearMediaCollection(MediaCollectionEnum::ASSIGNMENT());
        $topic->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $topic]);
    }

    public function saveOrder(Request $request): JsonResponse
    {
        $order = $request->input('order'); // Assuming 'order' is sent as an array of IDs

        // Example: Update order in database
        foreach ($order as $index => $itemId) {

            $item = Topic::findOrFail($itemId); // Replace with your actual model and ID field
            $item->order = $index + 1; // +1 if your order starts from 1, otherwise adjust as needed
            $item->save();
        }

        return response()->json(['message' => 'Order saved successfully']); // Response example
    }

    public function saveTopicOrder(Request $request, $courseId): JsonResponse
    {
        $order = $request->input('order');
        foreach ($order as $index => $topicId) {
            Topic::where('id', $topicId)->update(['order' => $index]);
        }

        return response()->json(['status' => 'success']);
    }

    public function saveTopicQuiz(Topic $topic, Quiz $quiz, Request $request): JsonResponse
    {
        $quiz->topics()->attach($topic->id);

        return response()->json(['message' => 'Quiz added successfully']);
    }

    public function detachTopicable(Topicable $topicable): JsonResponse
    {

        if ($topicable->topicable instanceof Lesson) {

            $topicable->topicable->clearMediaCollection(MediaCollectionEnum::IMAGES());
            $topicable->topicable->delete();
        }
        $topicable->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $topicable]);
    }

    private function _getForm(FormBuilder $form_builder, $course, $item = null, $existingDueDates = []): Form
    {
        return $form_builder->create(TopicForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('courses.topics.update', ['course' => $course->id, 'topic' => $item->id, 'item' => $item]) : route('courses.topics.store', ['course' => $course->id]),
            'role' => 'form',
            'class' => 'row',
            'id' => 'topicForm',

        ], [
            'existing_due_dates' => $existingDueDates,
            'course' => $course,
            'item' => $item,
            'class' => get_class($this),
        ]);
    }

    /**
     * Helper to group individual TopicDueDate records into the structure needed by the form.
     */
    protected function getExistingDueDates(Topic $topic): array
    {
        $dueDates = AssignmentUser::where('assignment_id', $topic->assignment?->id)
            ->get(['id', 'user_id', 'due_date'])
            // Group the collection by the due_date string
            ->groupBy('due_date');

        $existingDueDates = [];

        foreach ($dueDates as $dueDateString => $records) {

            $studentIds = $records->pluck('user_id')->toArray();

            $existingDueDates[$dueDateString] = [
                'due_date' => $dueDateString,
                'student_ids' => $studentIds,
            ];
        }

        return $existingDueDates;
    }

    protected function createAssignment(Topic $topic, Request $request)
    {
        $assignment = Assignment::updateOrCreate(
            ['topic_id' => $topic->id],
            [
                'course_id' => $topic->course_id,
                'name' => $request->assignment_title,
                'due_date' => $request->default_due_date,
            ]
        );

        if ($request->has('media')) {
            $assignment->syncFromMediaLibraryRequest($request->media)
                ->toMediaCollection(MediaCollectionEnum::ASSIGNMENT());
        }

        app(ConvertLessonMediaToPdfAction::class)
            ->execute($assignment, MediaCollectionEnum::ASSIGNMENT()->value);

        // Skip if no students submitted
        if (empty($request->students)) {
            AssignmentUser::where('assignment_id', $assignment->id)->delete();

            return;
        }

        $syncData = [];

        foreach ($request->students as $row) {
            $dueDate = $row['due_date'] ?? null;
            foreach ($row['student_ids'] ?? [] as $studentId) {
                $syncData[$studentId] = ['due_date' => $dueDate];
            }
        }

        $assignment->users()->sync($syncData);
    }
}
