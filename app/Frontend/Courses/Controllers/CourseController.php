<?php

namespace App\Frontend\Courses\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Courses\Actions\CalculateUserCourseProgressAction;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;
use Illuminate\View\View;

class CourseController extends BaseController
{
    public function __invoke(Course $course): View
    {

        $topics = $course->topics()->with(['topicables' => function ($q) {
            $q->whereHas('topicable', function ($query) {
                $query->where('is_active', 1);
                if (auth()->user()->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
                    $query->where('is_fast_track', 1);
                }
            });
        }])->active()->get();

        return view('frontend/courses/details', [
            'course' => $course->load([
                'topics' => fn ($q) => $q->active(),
                'teachers',
            ]),
            'topics' => $topics,
            'course_assignments' => $this->user->assignments()->where('course_id', $course->id)->get(),
            'course_progress' => (new CalculateUserCourseProgressAction)->handle($course),
        ]);
    }
}
