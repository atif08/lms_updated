<?php

namespace App\Frontend\Assignments\Controllers;

use App\Admin\Forms\Assignment\AssignmentUploadForm;
use App\Http\Controllers\BaseController;
use Domain\Assignment\Enums\ExtendRequestStatusEnum;
use Domain\Assignment\Models\AssignmentExtendRequest;
use Domain\Assignment\Models\SubmittedAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Kris\LaravelFormBuilder\FormBuilder;

class AssignmentController extends BaseController
{
    public function index() {}

    public function getAssignment(FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(AssignmentUploadForm::class, [
            'method' => 'POST',
            'url' => route('assignment.store'),
            'role' => 'form',
            'class' => 'row',
            'id' => 'submit-assignment',
        ], [
            'class' => get_class($this),
        ]);

        return view('frontend.courses.assignment-form', compact('form'));
    }

    public function show(SubmittedAssignment $assignment)
    {
        if ($assignment->user_id !== Auth::id()) {
            abort(403);
        }

        return view('assignments.show', compact('assignment'));
    }

    public function destroy(SubmittedAssignment $assignment)
    {
        if ($assignment->user_id !== Auth::id()) {
            abort(403);
        }

        Storage::disk('public')->delete($assignment->file_path);
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully.');
    }

    public function storeDateExtend(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
        ]);

        $studentId = auth()->id();
        $assignmentId = $request->assignment_id;

        $requestCount = AssignmentExtendRequest::query()
            ->where('user_id', $studentId)
            ->count();

        if ($requestCount >= 3) {
            // Deactivate user
            $user = $request->user();
            $user->update(['is_active' => false]);
            // Log out the user properly
            auth()->logout();

            return response()->json([
                'message' => 'You have already requested an assignment extension 3 times. Your account has been deactivated.',
            ], 403);
        }

        if (AssignmentExtendRequest::query()->where('assignment_id', $assignmentId)->where('user_id', $studentId)->exists()) {

            return response()->json([
                'message' => 'Your already request for extenstion for this assignment.',
            ], 422);
        }

        AssignmentExtendRequest::create([
            'assignment_id' => $assignmentId,
            'user_id' => $studentId,
            'status' => ExtendRequestStatusEnum::PENDING(),
        ]);

        return response()->json([
            'message' => 'Your request for assignment extension has been submitted successfully.',
        ]);
    }
}
