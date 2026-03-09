<?php

namespace Domain\Assignment\Actions;

use Domain\Assignment\Enums\AssignmentStatusEnum;
use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Support\Facades\Auth;

class CreateAssignmentSubmissionAction
{
    public function execute($request)
    {
        $studentId = Auth::id();

        $lastSubmission = SubmittedAssignment::where('user_id', $studentId)
            ->where('submissionable_id', $request->submissionable_id)
            ->where('submissionable_type', $request->submissionable_type)
            ->orderByDesc('attempt_number')
            ->first();

        if ($lastSubmission && $lastSubmission->status !== AssignmentStatusEnum::REJECTED()) {
            abort(403, 'You cannot resubmit until the previous submission is reviewed.');
        }

        $attempt = ($lastSubmission?->attempt_number ?? 0) + 1;

        return SubmittedAssignment::create([
            'user_id' => $studentId,
            'submissionable_id' => $request->submissionable_id,
            'submissionable_type' => $request->submissionable_type,
            'score' => $request->score,
            'description' => $request->description,
            'status' => AssignmentStatusEnum::PENDING(),
            'attempt_number' => $attempt,
        ]);
    }
}
