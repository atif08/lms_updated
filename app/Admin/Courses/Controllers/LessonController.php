<?php

namespace App\Admin\Courses\Controllers;

use App\Admin\DataTables\Courses\LessonDataTable;
use App\Admin\DataTables\Courses\MediaLibraryDataTable;
use App\Admin\Forms\Courses\LessonForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Assignment\Actions\ConvertLessonMediaToPdfAction;
use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Domain\Courses\Models\Topic;
use Domain\Courses\Models\Topicable;
use Domain\FileLibrary\Enums\MediaCollectionEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LessonController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course, Topic $topic, Request $request)
    {

        $data_table = new LessonDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }

        return $this->renderView('admin.courses.lessons.index', compact('data_table', 'course', 'topic'));
    }

    public function getMedia(Request $request)
    {

        /*$data_table = new MediaLibraryDataTable(user: $this->user, request: $request);
        if ($request->ajax()) {
            return $data_table->getData();
        }
        dd($data_table->table());
        return $data_table;*/
        $medias = Media::all();

        return $this->renderView('admin.courses.lessons.media_listing', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course, Topic $topic, Request $request, FormBuilder $formBuilder): View
    {
        $mediaDataTable = new MediaLibraryDataTable(user: $this->user, request: $request);
        $createForm = $this->_getForm($formBuilder, $course, $topic);
        $lesson = [];
        if ($request->ajax()) {
            return view('components.admin.modals.modal_form', compact('createForm', 'lesson', 'mediaDataTable'));
        }

        return $this->renderView('admin.courses.lessons.form', compact('createForm', 'lesson', 'mediaDataTable'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Course $course, Topic $topic, FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder, $course, $topic);

        $form->redirectIfNotValid();

        $formData = $form->getFieldValues();

        if (! empty($formData['external_link'])) {
            $formData['external_link'] = convertGoogleDriveLink($formData['external_link']);
        } else {
            $formData['external_link'] = $request->get('iframe');
        }

        $lesson = Lesson::query()->create($formData + ['topic_id' => $topic->id]);

        $lesson->users()->attach($request->get('user_ids'));

        $lesson->topics()->attach($topic);

        if ($request->has('media')) {
            $lesson->addFromMediaLibraryRequest($request->media)
                ->toMediaCollection(MediaCollectionEnum::IMAGES());
        }

        app(ConvertLessonMediaToPdfAction::class)
            ->execute($lesson);

        FlashMessage::success('Lesson created successfully !');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Topic $topic, Lesson $lesson, FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder, $course, $topic, $lesson);

        return $this->renderView('admin.courses.lessons.form_ajax', compact('createForm', 'lesson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Course $course, Topic $topic, Lesson $lesson, FormBuilder $formBuilder, Request $request): RedirectResponse
    {

        $form = $this->_getForm($formBuilder, $course, $topic);

        $form->redirectIfNotValid();

        $formData = $form->getFieldValues();

        if ($request->get('type') == LessonTypeEnum::ExternalLink()) {
            $formData['external_link'] = convertGoogleDriveLink($formData['external_link']);
        } else {
            $formData['external_link'] = $request->get(Str::lower($request->get('type')));
        }

        $lesson->update($formData);

        $lesson->users()->sync($request->get('user_ids'));

        $lesson->syncFromMediaLibraryRequest($request->media ?? [])
            ->toMediaCollection(MediaCollectionEnum::IMAGES());

        app(ConvertLessonMediaToPdfAction::class)
            ->execute($lesson);

        FlashMessage::success('Lesson updated successfully!');

        return redirect('admin/courses/'.$course->id.'/edit');
    }

    public function saveOrder(Request $request): JsonResponse
    {
        $order = $request->input('order');
        foreach ($order as $index => $lessonId) {
            Topicable::where('id', $lessonId)->update(['order' => $index]);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson): JsonResponse
    {

        $lesson->clearMediaCollection(MediaCollectionEnum::IMAGES());
        $lesson->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $lesson]);
    }

    private function _getForm(FormBuilder $form_builder, $course, $topic, $item = null): Form
    {
        return $form_builder->create(LessonForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? route('courses.topics.lessons.update',
                ['course' => $course->id, 'topic' => $topic->id, 'lesson' => $item->id, 'item' => $item]) :
                route('courses.topics.lessons.store', ['course' => $course->id, 'topic' => $topic->id]),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'course' => $course,
            'topic' => $topic,
            'class' => get_class($this),
        ]);
    }
}
