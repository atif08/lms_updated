<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Attendance\Model\Attendance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends BaseController
{
    public function index(Request $request): View
    {

        $attendance = Attendance::query()->where('user_id', $this->user->id)->latest()->get();

        return view('frontend/students/attendance', compact('attendance'));
    }

    public function saveHours(Attendance $attendance, Request $request): JsonResponse
    {
        // Get the time sent via AJAX
        // Save to database
        $attendance->user_id = auth()->user()->id; // Assuming you have logged-in users
        $attendance->hours = $request->get('hours'); // Save the time in the database
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Hours saved successfully']);
    }
}
