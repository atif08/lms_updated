<?php

namespace App\Frontend\Students\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Users\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends BaseController
{
    public function __invoke(Course $course, User $user)
    {

        // Check if the user is a student
        //        if ($user->user_type !== 'student') {
        //            return redirect()->back();
        //        }

        // Enroll the student in the course
        $user->enrolled_courses()->syncWithoutDetaching($course);
        FlashMessage::success('You are enrolled successfully');

        return redirect()->back();
    }

    public function unenroll(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = User::find($request->user_id);
        $course = Course::find($request->course_id);

        $user->courses()->detach($course);

        return response()->json(['message' => 'Student unenrolled from course successfully']);
    }
}
