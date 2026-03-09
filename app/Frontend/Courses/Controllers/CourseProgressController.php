<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Progress;
use Domain\Courses\Actions\CalculateUserCourseProgressAction;
use Domain\Courses\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseProgressController extends BaseController
{
    public function markComplete(Course $course, Request $request): JsonResponse
    {
        // Check if the checkbox is checked or unchecked
        if ($request->get('is_checked') == 'true') {
            // If checked, create or update the record
            Progress::query()->updateOrCreate(
                [
                    'user_id' => $this->user->id,
                    'course_id' => $course->id,
                    'topic_id' => $request->get('topic_id'),
                    'lesson_id' => $request->get('lesson_id'),
                    'progressable_id' => $request->get('progressable_id'),
                    'progressable_type' => $request->get('progressable_type'),
                ],
                ['completed' => true] // Mark as completed
            );

            return response()->json([
                'message' => 'Lesson marked completed',
                'course_progress' => (new CalculateUserCourseProgressAction)->handle($course),
            ]);

        } else {
            // If unchecked, delete the record
            Progress::query()
                ->where([
                    'user_id' => $this->user->id,
                    'course_id' => $course->id,
                    'topic_id' => $request->get('topic_id'),
                    'lesson_id' => $request->get('lesson_id'),
                    'progressable_id' => $request->get('progressable_id'),
                    'progressable_type' => $request->get('progressable_type'),
                ])
                ->delete();

            return response()->json([
                'message' => 'Lesson unmarked (deleted from progress)',
                'course_progress' => (new CalculateUserCourseProgressAction)->handle($course),
            ]);
        }
    }
}
