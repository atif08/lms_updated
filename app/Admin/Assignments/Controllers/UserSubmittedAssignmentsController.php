<?php

namespace App\Admin\Assignments\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Assignment\Models\Assignment;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\View;

class UserSubmittedAssignmentsController extends BaseController
{
    public function __invoke(Assignment $assignment, User $user): View
    {
        $submissions = $assignment->submitted_assignments()->where('user_id', $user->id)
            ->with(['submissionable.topic.course', 'submissionable.users'])
            ->orderBy('attempt_number', 'desc')->get();

        return $this->renderView('admin.users.partial_submitted_assignments', compact('submissions'));
    }
}
