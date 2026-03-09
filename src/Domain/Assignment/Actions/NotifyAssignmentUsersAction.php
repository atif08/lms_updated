<?php

namespace Domain\Assignment\Actions;

use Domain\Assignment\Notifications\AssignmentNotifyTeacherNotification;
use Domain\Assignment\Notifications\AssignmentSubmitNotification;

class NotifyAssignmentUsersAction
{
    public function execute($submission, $description): void
    {
        // Notify Student
        $submission->user->notify(
            new AssignmentSubmitNotification(
                $description,
                $submission->submissionable->name
            )
        );

        // Notify Teachers
        $course = $submission->submissionable->course;
        foreach ($course->teachers ?? [] as $teacher) {
            $teacher->notify(
                new AssignmentNotifyTeacherNotification(
                    $description,
                    $course,
                    $submission->user
                )
            );
        }
    }
}
