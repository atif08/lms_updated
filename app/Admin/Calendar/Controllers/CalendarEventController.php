<?php

namespace App\Admin\Calendar\Controllers;

use App\Admin\Forms\Calender\CalendarEventForm;
use App\Http\Controllers\BaseController;
use App\Models\Batch;
use App\Notifications\CalendarAnnouncementNotification;
use App\Notifications\CalendarAssignmentNotification;
use App\Notifications\CalendarBatchNotification;
use App\Notifications\CalendarClassesNotification;
use App\Notifications\CalendarCourseNotification;
use App\Notifications\CalendarEventNotification;
use App\Notifications\CalendarNoticeNotification;
use App\Services\FlashMessage;
use Domain\Calendar\Enums\CalendarTopicEnum;
use Domain\Calendar\Models\CalendarEvent;
use Domain\Courses\Models\Topic;
use Domain\Users\Enums\PermissionsEnum;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class CalendarEventController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    //    protected function hasControllerAccess(Request $request): bool {
    //        return $this->user->can(PermissionsEnum::CALENDARS()->value);
    //    }

    public function index(Request $request)
    {
        $calendarEvents = CalendarEvent::where('is_active', 1)->get();

        return $this->renderView('admin.calender.index', compact('calendarEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(FormBuilder $formBuilder): View
    {
        $createForm = $this->_getForm($formBuilder);

        return view('admin.calender.form_ajax', compact('createForm'));
    }

    public function show($id)
    {
        return CalendarEvent::find($id);
    }

    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();

        // Retrieve the batch and users
        $batch = Batch::findOrFail($request->input('batch_id'));
        $users = $request->get('students')
            ? User::whereIn('id', $request->get('students'))->get()
            : $batch->students;

        // Create the calendar event
        $calendar = CalendarEvent::create([
            ...$form->getFieldValues(),
            'user_id' => auth()->id(),
            'user_type' => auth()->user()->user_type,
        ]);

        // Determine the notification class based on the topic
        $notificationClass = $this->getNotificationClass($calendar->topic);
        // Send notifications if users exist
        if ($users) {
            Notification::send($users, new $notificationClass($calendar));
        }

        FlashMessage::success('Calendar created successfully!');

        return redirect()->back();
    }

    // Helper method to get the appropriate notification class
    private function getNotificationClass($topic): string
    {
        return match ($topic) {
            CalendarTopicEnum::BATCHES() => CalendarBatchNotification::class,
            CalendarTopicEnum::NOTICES() => CalendarNoticeNotification::class,
            CalendarTopicEnum::COURSES() => CalendarCourseNotification::class,
            CalendarTopicEnum::ANNOUNCEMENTS() => CalendarAnnouncementNotification::class,
            CalendarTopicEnum::ASSIGNMENTS() => CalendarAssignmentNotification::class,
            CalendarTopicEnum::CLASSES() => CalendarClassesNotification::class,
            default => CalendarEventNotification::class,
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CalendarEvent $calendarEvent, $id, FormBuilder $formBuilder): View
    {
        $calendarEvent = CalendarEvent::find($id);
        $createForm = $this->_getForm($formBuilder, $calendarEvent);

        return $this->renderView('admin.calender.form_ajax', compact('createForm', 'calendarEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalendarEvent $calendarEvent, $id, FormBuilder $formBuilder): RedirectResponse
    {
        $calendarEvent = CalendarEvent::find($id);
        $form = $this->_getForm($formBuilder, $calendarEvent);
        $form->redirectIfNotValid();
        $calendarEvent->update($form->getFieldValues());
        FlashMessage::success('Calendar updated successfully!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $calendarEvent = CalendarEvent::find($id);
        $calendarEvent->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $calendarEvent]);
    }

    private function _getForm(FormBuilder $form_builder, $item = null): Form
    {
        // $route=$item ? route('calendars.update', ['calendar' => $item->id]) : route('calendars.store');
        // dd($route);
        return $form_builder->create(CalendarEventForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? url('admin/calendars', $item->id) : route('calendars.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }
}
