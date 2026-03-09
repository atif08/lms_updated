<?php

namespace Domain\Assignment\Actions;

use Domain\Assignment\Models\SubmittedAssignment;

class HandleAssignmentFileUploadAction
{
    public function execute(SubmittedAssignment $submission, $file)
    {
        $ext = strtolower($file->getClientOriginalExtension());

        if (in_array($ext, ['doc', 'docx', 'ppt', 'pptx'])) {

            $pdfFile = convertFileToPdf($file);

            if ($pdfFile && file_exists($pdfFile)) {
                $submission->addMedia($pdfFile)
                    ->toMediaCollection('assignment');

                return;
            }
        }

        // fallback: normal upload
        $submission->addMedia($file)
            ->toMediaCollection('assignment');
    }
}
