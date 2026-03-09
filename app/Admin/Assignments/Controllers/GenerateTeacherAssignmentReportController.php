<?php

namespace App\Admin\Assignments\Controllers;

use App\Exports\SubmittedAssignmentsExport;
use App\Http\Controllers\BaseController;
use Domain\Assignment\Models\Assignment;
use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GenerateTeacherAssignmentReportController extends BaseController
{
    public function __invoke(Request $request)
    {
        // All courses assigned to this teacher
        $courseIds = $request->user()->teacher_courses->pluck('id')->toArray();

        // All assignments in those courses
        $assignmentIds = Assignment::query()
            ->whereIn('course_id', $courseIds)
            ->pluck('id')
            ->toArray();

        // All submitted assignments for those assignments
        $submittedAssignments = SubmittedAssignment::query()
            ->where('submissionable_type', Assignment::class)
            ->whereIn('submissionable_id', $assignmentIds)
            ->with(['submissionable.topic.course', 'user'])
            ->latest()
            ->get();

        // Download Excel
        return Excel::download(
            new SubmittedAssignmentsExport($submittedAssignments),
            'submitted-assignments.xlsx'
        );
    }
}
