<?php

namespace App\Admin\Assignments\Controllers;

use App\Http\Controllers\BaseController;
use Domain\Assignment\Enums\ExtendRequestStatusEnum;
use Domain\Assignment\Models\AssignmentExtendRequest;
use Illuminate\Http\JsonResponse;

class RejectExtendAssignmentRequestController extends BaseController
{
    public function __invoke(AssignmentExtendRequest $assignment_extend_request): JsonResponse
    {

        $assignment_extend_request->update(['status' => ExtendRequestStatusEnum::REJECTED()]);

        return response()->json([
            'success' => true,
            'message' => 'Assignment due date extended successfully.',
        ]);
    }
}
