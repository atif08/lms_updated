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
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class StudentCalendarController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $calendarEvents = CalendarEvent::where('is_active', 1)->get();

        return view('frontend/calender/index', ['calendarEvents' => $calendarEvents]);
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormBuilder $formBuilder, Request $request): RedirectResponse
    {
        $form = $this->_getForm($formBuilder);
        $form->redirectIfNotValid();
        CalendarEvent::query()->create($form->getFieldValues() + ['user_id' => auth()->user()->id, 'user_type' => auth()->user()->user_type]);
        FlashMessage::success('Calendar created successfully !');

        return redirect()->back();
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
            'url' => $item ? url('calendars', $item->id) : route('calendars.store'),
            'role' => 'form',
            'class' => 'row',
        ], [
            'item' => $item,
            'class' => get_class($this),
        ]);
    }
}
