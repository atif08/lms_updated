<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Attendance\Model\Attendance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends BaseController
{
    public function index(Request $request): Response
    {
        $attendance = Attendance::query()
            ->where('user_id', $this->user->id)
            ->latest()
            ->get()
            ->map(fn ($a) => [
                'id' => $a->id,
                'date' => $a->date,
                'check_in' => $a->check_in ? \Carbon\Carbon::parse($a->check_in)->format('H:i') : null,
                'check_out' => $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('H:i') : null,
                'hours' => $a->hours,
                'status' => $a->status,
            ]);

        return Inertia::render('Students/Attendance', compact('attendance'));
    }

    public function saveHours(Attendance $attendance, Request $request): JsonResponse
    {
        $attendance->user_id = auth()->user()->id;
        $attendance->hours = $request->get('hours');
        $attendance->save();

        return response()->json(['success' => true, 'message' => 'Hours saved successfully']);
    }
}
