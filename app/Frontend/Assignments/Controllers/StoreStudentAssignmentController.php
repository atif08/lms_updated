<?php

namespace App\Frontend\Assignments\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\FlashMessage;
use Domain\Assignment\Actions\CreateAssignmentSubmissionAction;
use Domain\Assignment\Actions\HandleAssignmentFileUploadAction;
use Domain\Assignment\Actions\NotifyAssignmentUsersAction;
use Illuminate\Http\Request;

class StoreStudentAssignmentController extends BaseController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'media' => 'required|file',
        ]);

        $submission = app(CreateAssignmentSubmissionAction::class)
            ->execute($request);

        // fallback: normal upload
        $submission->addMedia($request->file('media'))
            ->toMediaCollection('assignment');

        //        upload and convert assignment into PDF
        //        app(HandleAssignmentFileUploadAction::class)
        //            ->execute($submission, $request->file('media'));

        app(NotifyAssignmentUsersAction::class)
            ->execute($submission, $request->get('description'));

        FlashMessage::success('Assignment submitted successfully!');

        return redirect()->back();
    }
}
