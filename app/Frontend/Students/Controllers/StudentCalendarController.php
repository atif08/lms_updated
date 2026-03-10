<?php

namespace App\Frontend\Students\Controllers;

use App\Admin\Forms\Calender\CalendarEventForm;
use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class StudentCalendarController extends BaseController
{
    public function index(Request $request): Response
    {
        $calendar_events = CalendarEvent::where('is_active', 1)->get()->map(fn ($e) => [
            'id' => $e->id,
            'title' => $e->title,
            'description' => $e->description,
            'url' => $e->url,
            'start' => $e->start_datetime,
            'end' => $e->end_datetime,
        ]);

        return Inertia::render('Calendar/Index', compact('calendar_events'));
    }

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
        CalendarEvent::query()->create($form->getFieldValues() + ['user_id' => auth()->user()->id, 'user_type' => auth()->user()->user_type]);
        FlashMessage::success('Calendar created successfully !');

        return redirect()->back();
    }

    public function edit(CalendarEvent $calendarEvent, $id, FormBuilder $formBuilder): View
    {
        $calendarEvent = CalendarEvent::find($id);
        $createForm = $this->_getForm($formBuilder, $calendarEvent);

        return $this->renderView('admin.calender.form_ajax', compact('createForm', 'calendarEvent'));
    }

    public function update(CalendarEvent $calendarEvent, $id, FormBuilder $formBuilder): RedirectResponse
    {
        $calendarEvent = CalendarEvent::find($id);
        $form = $this->_getForm($formBuilder, $calendarEvent);
        $form->redirectIfNotValid();
        $calendarEvent->update($form->getFieldValues());
        FlashMessage::success('Calendar updated successfully!');

        return redirect()->back();
    }

    public function destroy($id): JsonResponse
    {
        $calendarEvent = CalendarEvent::find($id);
        $calendarEvent->delete();

        return response()->json(['message' => 'item deleted successfully', 'item' => $calendarEvent]);
    }

    private function _getForm(FormBuilder $form_builder, $item = null): Form
    {
        return $form_builder->create(CalendarEventForm::class, [
            'method' => $item ? 'PUT' : 'POST',
            'url' => $item ? url('calendars', $item->id) : route('calendars.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }
}
