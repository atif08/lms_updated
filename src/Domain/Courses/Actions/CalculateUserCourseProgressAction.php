<?php

namespace Domain\Courses\Actions;

use Domain\Courses\Enums\LessonTypeEnum;
use Domain\Courses\Models\Course;
use Domain\Users\Enums\UserTypeEnum;

class CalculateUserCourseProgressAction
{
    /**
     * @return array{percentage: int, completed: int, total: int}
     */
    public function handle(Course $course): array
    {
        // Initialize the lessons query — only lessons from active topics
        $lessonsQuery = $course->lessons()
            ->where('topics.is_active', 1)
            ->where('lessons.is_active', 1);

        // Apply the fast track condition if the user is FAST_TRACK
        if (auth()->user()->user_type == UserTypeEnum::ACCELERATED_STUDENT()) {
            $lessonsQuery->where('is_fast_track', 1);
        }

        // Fetch the lessons with media count
        $lessons = $lessonsQuery->withCount('media')->get();

        // Sum up the media count from Media-type lessons only
        $totalMediaCount = $lessons
            ->where('type', LessonTypeEnum::Media())
            ->sum('media_count');

        // Count non-Media type lessons (each counts as one completable unit)
        $lessonsWithNoMediaCount = $lessons
            ->where('type', '!=', LessonTypeEnum::Media())
            ->count();

        // Total completable units = individual media items + non-media lessons
        $total = $totalMediaCount + $lessonsWithNoMediaCount;

        // Count only completed progress records for this user and course
        $completed = $course->user_course_progress()->where('completed', true)->count();

        if ($total === 0 || $completed === 0) {
            return ['percentage' => 0, 'completed' => $completed, 'total' => $total];
        }

        // Round to whole number, but guarantee at least 1% when any progress exists
        $percentage = max(1, (int) round(($completed / $total) * 100));

        return ['percentage' => $percentage, 'completed' => $completed, 'total' => $total];
    }
}
