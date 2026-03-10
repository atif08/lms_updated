<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class StudentProfileController extends BaseController
{
    public function index(Request $request): Response
    {
        return Inertia::render('Students/Profile');
    }

    public function dashboard(Request $request): Response
    {
        $calendar_events = CalendarEvent::where('is_active', 1)->get()->map(fn ($e) => [
            'id' => $e->id,
            'title' => $e->title,
            'description' => $e->description,
            'url' => $e->url,
            'start' => $e->start_datetime,
            'end' => $e->end_datetime,
        ]);

        $latest_announcement = $request->user()
            ->enrolled_courses()
            ->active()
            ->latest()
            ->first()
            ?->announcement;

        return Inertia::render('Students/Dashboard', [
            'calendar_events' => $calendar_events,
            'latest_announcement' => $latest_announcement,
        ]);
    }

    public function getSettings(Request $request): Response
    {
        return Inertia::render('Students/Settings');
    }

    public function postSettings(Request $request): RedirectResponse
    {
        $request->user()->update($request->only([
            'first_name', 'last_name', 'name', 'mobile', 'country_code',
            'qualification_name', 'institution', 'graduation_year',
            'major', 'national_id', 'gender',
        ]));

        FlashMessage::success('Profile updated successfully');

        return redirect()->back();
    }

    public function getChangePassword(Request $request): Response
    {
        return Inertia::render('Students/ChangePassword');
    }

    public function postChangePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (! Hash::check($request->input('current_password'), Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        Auth::user()->update([
            'password' => Hash::make($request->input('password')),
        ]);

        FlashMessage::success('Password changed successfully!');

        return redirect()->back();
    }
}
