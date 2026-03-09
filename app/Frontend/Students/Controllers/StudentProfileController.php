<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Calendar\Models\CalendarEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudentProfileController extends BaseController
{
    public function index(Request $request): View
    {

        return view('frontend/students/student-profile');
    }

    public function dashboard(Request $request): View
    {
        $calendar_events = CalendarEvent::where('is_active', 1)->get();
        $latest_announcement = $request->user()->enrolled_courses()->active()->latest()->first();

        return view('frontend/students/student-dashboard', compact('calendar_events', 'latest_announcement'));
    }

    public function getSettings(Request $request): View
    {

        return view('frontend/students/student-settings');
    }

    public function postSettings(Request $request): RedirectResponse
    {

        $request->user()->update($request->all());

        $request->user()->syncFromMediaLibraryRequest($request->media)->toMediaCollection('default');

        FlashMessage::success('Profile update successfully');

        return redirect()->back();
    }

    public function postChangePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches the user's password
        if (! Hash::check($request->input('current_password'), Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect with a success message
        FlashMessage::success('Password changed successfully!');

        return redirect()->back();
    }

    public function getChangePassword(Request $request): View
    {

        return view('frontend/students/student-change-password');
    }
}
