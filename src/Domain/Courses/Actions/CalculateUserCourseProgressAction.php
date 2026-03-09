<?php

namespace Domain\Courses\Actions;

use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;

class CalculateUserCourseProgressAction
{
    public function handle(Course $course): float|int
    {
        // Initialize the lessons query
        $lessonsQuery = $course->lessons()->where('lessons.is_active', 1);

        // Apply the fast track condition if the user is FAST_TRACK
        if (auth()->user()->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
            $lessonsQuery->where('is_fast_track', 1);
        }

        // Fetch the lessons with media count
        $lessons = $lessonsQuery->withCount('media')->get();

        // Sum up the total media count
        $totalMediaCount = $lessons->sum('media_count');

        // Count lessons without media, that are active, and not of type Media
        $lessonsWithNoMediaCount = $lessons
            ->where('type', '!=', LessonTypeEnum::Media()) // Filter non-media lessons
            ->count();

        // Calculate the total lessons (media + non-media lessons)
        $lesson_total = $totalMediaCount + $lessonsWithNoMediaCount;

        // Return the calculated points percentage based on total lessons and progress
        return get_points_percentage($lesson_total, $course->user_course_progress()->count());
    }
}
