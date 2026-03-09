<?php

namespace App\Admin\Assignments\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Assignment\Enums\ExtendRequestStatusEnum;
use Domain\Assignment\Models\AssignmentExtendRequest;
use Domain\Assignment\Models\AssignmentUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApproveExtendAssignmentRequestController extends BaseController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'assignment_id' => 'required|exists:assignments,id',
            'extended_due_date' => 'required|date|after_or_equal:today',
        ]);

        // Update the due date
        AssignmentUser::query()
            ->where('user_id', $request->user_id)
            ->where('assignment_id', $request->assignment_id)
            ->update([
                'due_date' => $request->extended_due_date,
            ]);

        AssignmentExtendRequest::query()->where('id', $request->request_id)->update(['status' => ExtendRequestStatusEnum::APPROVED()]);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Assignment due date extended successfully.',
        ]);
    }
}
