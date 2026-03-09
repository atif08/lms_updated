<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use App\Notifications\SendQuestionAlertTeacherNotification;
use App\Notifications\SendQuestionConfirmationStudentNotification;
use App\Services\FlashMessage;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\CourseQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CourseQuestionController extends BaseController
{
    public function __invoke(Course $course, Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $question = CourseQuestion::create($request->all() + ['user_id' => $this->user->id, 'course_id' => $course->id]);

        $this->user->notify(new SendQuestionConfirmationStudentNotification($question, $course));

        if ($course->teachers) {
            Notification::send($course->teachers, new SendQuestionAlertTeacherNotification($question, $course));
        }

        FlashMessage::success('Question posted successfully');

        return redirect()->back();
    }
}
